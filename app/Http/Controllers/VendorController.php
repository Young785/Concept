<?php

namespace App\Http\Controllers;

use App\Category;
use App\Notifications\CategoryNotification;
use App\Notifications\ProfileUpdatedNotification;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {
        return view("vendor.index");
    }
    public function account()
    {
        $id = Auth::user()->id;
        $vendor = User::where("id", $id)->first();

        return view("vendor.account", compact("vendor"));
    }
    public function editAccount()
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

        return redirect("/vendor")->with("proUpdate", "Your account has been updated Successfully!");
    }
    public function categories()
    {
        $categories = Category::all()->sortByDesc("created_at");
        
        return view("vendor.category", compact("categories"));
    }
    public function myCat()
    {
        $id = Auth::user()->id;
        $categories = Category::where("user_id", $id)->get();
        
        return view("vendor.my-category", compact("categories"));
    }
    public function addCategoryPage()
    {
        return view("vendor.add-category");
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
        return redirect("/vendor/categories")->with("msg", "You have Successfully added a new Category!");
    }
    public function deleteCategory($id)
    {
        Category::where("id", $id)->delete();

        return redirect("/vendor/vendor-categories")->with("catDeleted", "Category Deleted Successfully!");
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

        return redirect("/vendor/vendor-categories")->with("catEdited", "Category Edited Successfully!");
    }
    public function products()
    {
        $pics = Product::all();
        foreach ($pics as $pic) {
            $pic['image_name'] = json_decode($pic['image_name'], true);
        // $pics[0]['image_name']; 
        }

        $products = Product::all();
        return view("vendor.products", compact("products", "pics"));
    }
    public function myProducts()
    {
        $pics = Product::all();
        foreach ($pics as $pic) {
            $pic['image_name'] = json_decode($pic['image_name'], true);
        // $pics[0]['image_name']; 
        }

        $id = Auth::user()->id;
        $products = Product::where("user_id", $id)->get();
        
        return view("vendor.my-products", compact("products", "pics"));
    }
    public function addProductsPage()
    {
        $getcat = Category::all();
        return view("vendor.add-product", compact("getcat"));
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

        return redirect("/vendor/products")->with("msg", "Product Created Successfully!");
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
    public function custOrderPage()
    {
        $id = Auth::user()->id;
        $order = Order::where("vendor_id", $id)->where(["order_status" => "pending"])->get();

        $completed = Order::where("vendor_id", $id)->where(["order_status" => "completed"])->get();

        if (count($order) == null) {
            return view("vendor.customer-order", compact("order", "completed"));
        }else{
            foreach ($order as $value) {
                $user = User::where("id", $value->user_id)->first();
                $product = Product::where("id", $value->product_id)->first();
            }
            return view("vendor.customer-order", compact("order", "completed", "user", "product"));
        }
        
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
    public function completeOrder($id)
    {
        Order::where("id", $id)->update(['order_status' => 'completed']);

        return redirect("/vendor/customers-order")->with("completed", "Congratulation! You successfully Completed the Order.");
    }
}
