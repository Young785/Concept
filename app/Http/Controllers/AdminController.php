<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\VendorAcceptedNotification;
use App\Notifications\CategoryNotification;
use App\Notifications\ProfileUpdatedNotification;
use App\Notifications\UserAsVendorNotification;
use App\Notifications\UserDeletedNotification;
use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {   
        $order_products = Product::rightjoin("orders", "orders.product_id", "=", "products.id")->join("users", "orders.user_id", "=", "users.id")->get();
        $orders = Order::all();
        // get record for the last 6 month
        $month_amount = [];
        $month_count = [];
        for ($i = 12; $i > -1; $i--) {
            $dt = Order::
                whereYear('created_at', Carbon::now()->subMonths($i)->format('Y'))
                ->whereMonth('created_at', Carbon::now()->subMonths($i)->format('m'))
                ->get()->sum('paid_amount');
            array_push($month_amount, $dt);
            array_push($month_count, Carbon::now()->subMonths($i)->format('M'));
        }
        $sales = [];
        for ($i = 0; $i > -1; $i--) {
            $dt = Order::
                whereYear('created_at', Carbon::now()->subMonths($i)->format('Y'))
                ->whereMonth('created_at', Carbon::now()->subMonths($i)->format('m'))
                ->get()->sum('paid_amount');
            array_push($sales, $dt);
        }
        // dd($sales);
        $number_of_users = [];
        for ($i = 0; $i > -1; $i--) {
            $user = User::
                whereYear('created_at', Carbon::now()->subMonths($i)->format('Y'))
                ->whereMonth('created_at', Carbon::now()->subMonths($i)->format('m'))
                ->get();
            array_push($number_of_users, $user);
        }
        // dd($number_of_users);

        foreach ($order_products as $pic) {
          $pic['image_name'] = json_decode($pic['image_name'], true);
        //   dd($order_products["image_name"]);
        }
        return view("pages.index", compact("order_products", "pic", "month_amount", "number_of_users","sales","month_count"));
    }
    public function loginPage()
    {
        return view("pages.login");
    }
    public function login()
    {
        $data = request()->validate([
            'email' => "required",  
            'password' => "required",
        ]);

        if (Auth::attempt($data)) {
            if (Auth::user()->user_type == "admin") {
                return redirect("/admin");
            }elseif (Auth::user()->user_type == "vendor") {
                return redirect("/vendor");
            }else{
                return redirect("/main/index");
            }
        }else{
            return redirect("/pages/login")->with("notExist", "These credentials do not match our records.");
        }
    }
    public function registerPage()
    {
        return view("pages.register");
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
        $item['phone'] = request("phone");
        $item['address'] = request("address");
        $item['email'] = request("email");
        $item['password'] = Hash::make(request("password"));
        
        User::create($item);

        $email = request("email");
        $password = request("password");

        Auth::attempt(['email' => $email, 'password' => $password]);
        return redirect("/pages/index")->with("registered", "You registration was Successful!");

    }
    public function account()
    {
        $id = Auth::user()->id;
        $admin = User::where("id", $id)->first();

        return view("pages.account", compact("admin"));
    }    
    public function editAcc()
    {
        $id = Auth::user()->id;
        $dbEmail = Auth::user()->email;

        $data = request()->validate([
            'fullname' => "required",
            'username' => "required",
            'email' => "required",
            'phone' => "required",
            'address' => "required",
        ]);

        $email = request("email");

        if($email == $dbEmail){
            $data['email'] = $email;
        }else{
            $data['email'] = $email;
        }
        
        if (request()->hasFile('user_image')) {
            $file = request()->file('user_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/users/', $filename);

            $data['user_image'] = $filename;
        }
        User::where("id", $id)->update($data);

        Auth::user()->notify(new ProfileUpdatedNotification);

        return redirect("/admin")->with("proUpdate", "Your account has been updated Successfully!");
    }
    public function users()
    {
        $users = User::where("user_type", "user")->paginate(10);
        return view("pages.users", compact("users"));
    }
    public function delUsers($id)
    {
        User::where("id", $id)->delete();

        session()->put("id", $id);

        Auth::user()->notify(new UserDeletedNotification);

        session()->forget("id");
        return redirect("/admin/customers")->with("msg", "You deleted the user Successfully!");
    }
    public function makeVendor($id)
    {
        $user = User::where("id", $id)->first();
        User::where("id", $id)->update(["user_type" => "vendor"]);

        session()->put("id", $id);

        $hash = md5( rand(0,1000));
        session()->put("hash", $hash);

        Mail::to($user->email)->send(new VendorAcceptedNotification($user));
        Auth::user()->notify(new UserAsVendorNotification);

        session()->forget("id");
        return redirect("/admin/vendors")->with("vendor", "You have Successfully made the user a Vendor!");
    }
    public function vendors()
    {
        $vendors = User::where("user_type", "vendor")->get();
        return view("pages.vendors", compact("vendors"));
    }
    public function unmakeVendor($id)
    {
        User::where("id", $id)->update(["user_type" => "user"]);

        session()->put("id", $id);

        Auth::user()->notify(new UserAsVendorNotification);

        session()->forget("id");
        return redirect("/admin/customers")->with("user", "You have Successfully made the vendor a User!");
    }
    public function categories()
    {
        $categories = Category::all()->sortByDesc("created_at");
        
        return view("pages.categories", compact("categories"));
    }
    public function addCategoryPage()
    {
        return view("pages.add-category");
    }
    public function addCategory()   
    {
        $data = request()->validate([
            "category_name" => "required",
            "category_image" => "required",
            "category_description" => "required",
        ]);
        
        $file = request()->file('category_image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('images/category/', $filename);
        $id = Auth::user()->id;

        $item['category_name'] = request("category_name");
        $item['category_image'] = $filename;
        $item['category_slug'] = Str::slug(request("category_name"));
        $item['category_description'] = request("category_description");
        $item['user_id'] = $id;

        Category::create($item);
        Auth::user()->notify(new CategoryNotification);
        return redirect("/admin/categories")->with("msg", "You have Successfully added a new Category!");
    }
    public function deleteCategory($id)
    {
        Category::where("id", $id)->delete();

        return redirect("/admin/categories")->with("catDeleted", "Category Deleted Successfully!");
    }
    public function editCategory(Request $request, $id)
    {
        $data['category_name'] = request("category_name");
        $data['category_description'] = request("category_description");
        // dd($data);
        if (request()->hasFile('category_image')) {
            $file = request()->file('category_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/category/', $filename);

            $data['category_image'] = $filename;
        }
        Category::where('id', $id)->update($data);

        return redirect("/admin/categories")->with("catEdited", "Category Edited Successfully!");
    }
    public function products()
    {
        $pics = Product::all();
        foreach ($pics as $pic) {
            $pic['image_name'] = json_decode($pic['image_name'], true);
        // $pics[0]['image_name']; 
        }

        $products = Product::all();
        return view("pages.products", compact("products", "pics"));
    }
    public function addProductsPage()
    {
        $getcat = Category::all();
        return view("pages.add-products", compact("getcat"));
    }
    public function addProducts()
    {
        if (request()->hasFile("image_name")) {
            $file = request()->file('image_name');
            $f = [];
            foreach ($file as $item) {
                $extension = $item->getClientOriginalExtension();
                $name = $item->getClientOriginalName();
                $filename = $name.time() . '.' . $extension;
                $f[] = $filename;
                $item->move('images/products/', $filename);
            }
        }
        
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image_name' => 'required',
        ]);
        $id = Auth::user()->id;
        $data['user_id'] = $id;
          
        $data['image_name'] = json_encode($f);
        
        $data['product_slug'] = Str::slug(request('name'));
        
        Product::create($data);

        return redirect("/admin/products")->with("msg", "Product Created Successfully!");
    }
    public function deleteProduct($id)
    {
        Product::where("id", $id)->delete();

        return redirect("/admin/products")->with("prodDeleted", "Product Deleted Successfully!");
    }
    public function editProduct(Request $request, $id)
    {
        $data['name'] = request("name");
        $data['description'] = request("description");
        $data['price'] = request("price");
        $data['quantity'] = request("quantity");
       
        Product::where('id', $id)->update($data);

        return redirect("/admin/products")->with("prodEdited", "Product Edited Successfully!");
    }
    public function orderPage($id)
    {
        $Authid = Auth::user()->id;
        $order = Order::where("vendor_id", $Authid)->get();

        foreach ($order as $value) {
            $user = User::where("id", $value->user_id)->first();
            $product = Product::where("id", $value->product_id)->first();
        }
        return view("vendor.order", compact("order","value", "user", "product"));
    }
}
