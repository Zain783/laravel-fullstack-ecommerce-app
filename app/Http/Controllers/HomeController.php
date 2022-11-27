<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Cart;

class HomeController extends Controller
{

    public function index()
    {
        $product = Products::paginate(8);
        return view('home.userpage', compact("product"));
    }
    public function  redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {

            return view('admin.home');
        } else {
            $product = Products::paginate(1);
            return view('home.userpage', compact("product"));
        }
    }
    public function product_details($id)
    {
        $product = Products::find($id);
        return view('home/product_details', compact('product'));
    }
    public function add_cart(Request $request, $id)
    {

        //Check User Login Or Not
        if (Auth::id()) {
            $user = Auth::user();
            $product = Products::find($id);
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            //here i am checking if product has discount price
            if ($product->discount_price) {
                //because the total discount price will be discount_price multiplay by product quantity
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            //Note that this quantity come from request mean current input filed
            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
        $product = Products::find($id);
        return view('home/product_details', compact('product'));
    }
    public function show_cart()
    {
        if (Auth::id()) {
            //here i am gettings th current id of login user
            $id = Auth::user()->id;
            //Here I am fetching all the product which entered by the current user
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.showcart', compact("cart"));
        } else {
            //if the user is not login
            return redirect("login");
        }
    }
    public function remove_cart($id)
    {
        //here we re getting the id of the cart product whcih we want to delete here 
        $cart = Cart::find($id);
        // after find the product by id then we will delete this product
        $cart->delete();
        return redirect()->back();
    }
}
