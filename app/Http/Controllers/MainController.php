<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\EmailVerification;
use App\Mail\ForgotPasswordMail;
use App\Mailing;
use App\User;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class MainController extends Controller
{
    public function home()
    {
        $category = Category::all();

        $pics = Product::all();
        foreach ($pics as $pic) {
            $pic['image_name'] = json_decode($pic['image_name'], true);
        }
        return view("main.index", compact("pics", "category"));
    }
    public function about()
    {
        return view("main.about");
    }
    public function contact()
    {
        return view("main.contact");
    }
    public function search()
    {
        $q = Input::get('q');
        $user = Product::where('name','LIKE','%'.$q.'%')->orWhere('description','LIKE','%'.$q.'%')->get();
        if(count($user) > 0)
            return view('main.search')->withDetails($user)->withQuery($q);
        else 
        return view ('welcome')->withMessage('No Details found. Try to search again !');
    }
    public function registerPage()
    {
        return view("main.signup");
    }
    public function register()
    {
        $data = request()->validate([
            'username' => "required",
            'fullname' => "required",
            'phone' => "required",
            'address' => "required",
            'email' => "required|unique:users",
            'password' => "required|min:5",
            'confPass' => "required|same:password",
        ]);

        $item['username'] = request("username");
        $item['fullname'] = request("fullname");
        $item['gender'] = request("gender");
        $item['phone'] = request("phone");
        $item['address'] = request("address");
        $item['email'] = request("email");
        $item['password'] = Hash::make(request("password"));
        $user = User::create($item);
        $id = $user->id;

        $hash = md5( rand(0,1000));
        session()->put("hash", $hash);
        session()->put("permit", "hasPermission");
        $email = request("email");
        $password = request("password");

        $check = Mailing::where("email", $email)->first();
        if(request("emailme") == "on"){
            if($check == null){
                $mail['email'] = request("email");
                $mail['email_status'] = "no";
                $mail['user_id'] = $id;
                Mailing::create($mail);
            }else{
               
            }
        }
        Auth::attempt(['email' => $email, 'password' => $password]);
        Mail::to($email)->send(new EmailVerification($user));
        return redirect("/main/verify");
    }
    public function verifyPage()
    {
        $session = session()->get("permit");
        if($session == null){
            return redirect("/main/login")->with("msgNopermit", "You have no access there!");
        }else{
            return view("main.verify");
        }
    }
    public function verify($hash)
    {
        $sess = session()->get("permit");
        if($sess == null){
            return redirect("/main/login")->with("msgNopermit", "You have no access there!");

        }else{
            
            $session = session()->get("hash");
            $id = Auth::user()->id;
            if ($session == $hash) {
                User::where("id", $id)->update(['email_verified_at' => Carbon::now()]);
                Mailing::where("user_id", $id)->update(['email_status' => "yes"]);
                session()->forget("hash");
                session()->forget("permit");
                return redirect("/main/profile")->with("msg", "Your account has been verified Successfully");
            }elseif($session == null){
                return redirect("/main/login")->with("msgNopermit", "You have no access there!");
            }else{
                return redirect("/main/register");
            }
        }
    }
    public function loginPage()
    {
        return view("main\login");
    }
    public function login()
    {
        $data = request()->validate([
            'email' => "required",  
            'password' => "required",
        ]);

        if (Auth::attempt($data)) {
            if (Auth::user()->user_type == "user") {
                return redirect("/account");
            }else{
                return redirect("/main/login")->with("notExist", "These credentials do not match our records.");
            }
        }else{
            return redirect("/main/login")->with("notExist", "These credentials do not match our records.");
        }
    }
    public function forgotPage()
    {
        $email = request('email');
       
        if (request("email") == null) {
            return view("main/forgot");
        }else{
            $user = User::where("email", $email)->first();
            if($user != null){
                $hash = md5( rand(0,1000));
                session()->put("hash", $hash);
                session()->put("reset", "hasPermission");
        
                Mail::to($email)->send(new ForgotPasswordMail($user));
                return redirect("/main/forgot-password/reset-pass")->with("wrongInfo", "Wrong Email Provided!");
            }else{
                return redirect("/main/forgot-password")->with("wrongInfo", "Wrong Email Provided!");
            }
        }
       
        // dd($email);
    }
    public function resetPass()
    {
        $session = session()->get("reset");
        if($session == null){
            return redirect("/main/login")->with("msgNopermit", "You have no access there!");
        }else{
            return view("main/resetpass");
        }
    }
    public function resetPassword($id)
    {
        $sess = session()->get("reset");
        if($sess == null){
            return redirect("/main/login")->with("msgNopermit", "You have no access there!");
        }else{
        return view("main/reset");
        }
    }
    public function reset($email)
    {
        $sess = session()->get("reset");
        if($sess == null){
            return redirect("/main/login")->with("msgNopermit", "You have no access there!");
        }else{
            $password = Hash::make(request("password"));
        
            User::where("email", $email)->update(["password"=> $password]);
            session()->forget("hash");
            session()->forget("reset");
    
            return redirect("/main/login")->with("changedPass", "Your password was changed Successfully! You can now login with the new Password");
        }
    }
    public function index()
    {
        return view("main.profile.fav");
    }
    public function profile()
    {
        $id = Auth::user()->id;

        $user = User::where("id", $id)->first();
        return view("main.profile.profile",compact("user"));
    }
    public function orderHistory()
    {
        return view("main.profile.order_history");
    }
    public function addressPage()
    {
        return view("main.profile.address");
    }
    public function paymentPage()
    {
        return view("main.profile.payment");
    }
    public function comprePage()
    {
        return view("main.profile.com_preference");
    }

    public function catSlug($slug)
    {        
     
        $cat_id = Category::where('category_slug', $slug)->first('id');
        $catproduct = Product::all()->where('category_id', $cat_id->id);
        
        $pics = Product::where('category_id', $cat_id->id)->get('image_name');

        foreach ($pics as $pic) {
            $pic['image_name'] = json_decode($pic['image_name'], true);
        }

        return view("main/category", compact("slug", "catproduct", "pics"));
    }
    public function cart()
    {
        if (session('cart') != null) {
            $session = session('cart');
            foreach ($session as $value) {
                $val = $value['id'];
            }
            $prod = Product::where('id', $val)->get();
        return view("main/cart", compact('prod'));

        }else{
            return view("main/cart");
        }
    }
    public function addToCart($id)
    {
        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        
        $pic['image_name'] = json_decode($product['image_name'], true);
        
        $car = $pic['image_name'][0];
        if(!$cart) {
            $cart = [
                    $id => [
                        "id" => $id,
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "size" => 'S',
                        "image_name" => $car
                    ]
            ];

            session()->put('cart', $cart);
            return redirect('/main/cart')->with('msg', ' Product Added to Cart Successfully. You can remove, update or Proceed with the buying Below. Thanks!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity'];
            session()->put('cart', $cart);
            return redirect('/main/cart')->with('msg', ' Product Added to Cart Successfully. You can remove, update or Proceed with the buying Below. Thanks!');
        }
        
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "id" => $id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "size" => 'S',
            "image_name" => $car,
        ];
        
        session()->put('cart', $cart);
        return redirect('/main/cart')->with('msg', ' Product Added to Cart Successfully. You can remove, update or Proceed with the buying Below. Thanks!');
    }
    public function editCart(Request $request)
    {        
        if($request->id and $request->quantity and $request->quantity)
        {
            $getProductPrice = Product::where('id', $request->id)->first(['price']);
            dd($getProductPrice);
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            $cart[$request->id]["price"] = $getProductPrice->price * $request->quantity;
            session()->put('cart', $cart);
            // dd(session()->get('cart'));
            session()->flash('success', 'Cart updated successfully');

            // return redirect("/pages/cart")->with('msasg', "Product Updated successfully!");
        }
    }
}
