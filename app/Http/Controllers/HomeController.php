<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Stripe;
use Stripe\Product;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $usertype = Auth::user()->usertype;
            if ($usertype == '1') {
                $total_product = Products::all()->count();
                $total_orders = Order::all()->count();
                $total_users = User::all()->count();
                $orders = Order::all();
                $total_sale = 0;
                $total_delivered_order = 0;
                $total_processing_order = 0;
                foreach ($orders as  $orders) {
                    $total_sale = $total_sale + $orders->price;
                    if ($orders->delivery_status == "delivered") {

                        $total_delivered_order = $total_delivered_order + 1;
                    } else {
                        $total_processing_order = $total_processing_order + 1;
                    }
                }
                return view('admin.home', compact('total_product', 'total_users', 'total_orders', 'total_orders', 'total_sale', 'total_delivered_order', 'total_processing_order'));
            } else {
                //if the user is logined then we move to that page
                $product = Products::paginate(10);
                return view('home.userpage', compact("product"));
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        //If the user is Not logined
        $product = Products::paginate(10);
        return view('home.userpage', compact("product"));
    }
    public function  redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == "1") {
            $total_product = Products::all()->count();
            $total_orders = Order::all()->count();
            $total_users = User::all()->count();
            $orders = Order::all();
            $total_sale = 0;
            $total_delivered_order = 0;
            $total_processing_order = 0;
            foreach ($orders as  $orders) {
                $total_sale = $total_sale + $orders->price;
                if ($orders->delivery_status == "delivered") {

                    $total_delivered_order = $total_delivered_order + 1;
                } else {
                    $total_processing_order = $total_processing_order + 1;
                }
            }
            return view('admin.home', compact('total_product', 'total_users', 'total_orders', 'total_orders', 'total_sale', 'total_delivered_order', 'total_processing_order'));
        } else {
            $product = Products::paginate(10);
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
    public function cash_order()
    {
        //here we are getting id of the current user here who added product
        $user = Auth::user();
        $userid = $user->id;
        //here we are getting all the product which in cart added by current user from cart table
        //Note:this will return a list which contain all cart item which added by the current login user
        $data = Cart::where('user_id', '=', $userid)->get();
        //Note:data contain list of cart items
        foreach ($data as $data) {
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->name = $data->name;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();
            //note that after save order we are deleting products from cart table one by one
            $card_id = $data->id;
            $cart = Cart::find($card_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'We Received Your Order .We will connect with you Soon...');
    }
    public function stripe($totalprice)
    {

        return view('home.stripe', compact('totalprice'));
    }
    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            //here we need have to multiply totalprice with 100 because it calulate in cents therefore we need have to multiply it to 100
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks For Payment."
        ]);
        // Session::flash('success', 'Payment successful!');
        $user = Auth::user();
        $userid = $user->id;
        //here we are getting all the product which in cart added by current user from cart table
        //Note:this will return a list which contain all cart item which added by the current login user
        $data = Cart::where('user_id', '=', $userid)->get();
        //Note:data contain list of cart items
        foreach ($data as $data) {
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->name = $data->name;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';
            $order->save();
            //note that after save order we are deleting products from cart table one by one
            $card_id = $data->id;
            $cart = Cart::find($card_id);
            $cart->delete();
        }
        return back()->with('message', 'Payment successful!');
    }
    public function show_order()
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $order = Order::where('user_id', '=', $userid)->get();
            return view('home.order', compact('order'));
        } else {
            return view('login');
        }
    }
    public function CancelOrder($id)
    {
        $order=Order::find($id);
        $order->delivery_status="you canceled the Order";
        $order->save();
        return redirect();
    }
}
