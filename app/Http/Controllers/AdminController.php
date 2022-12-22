<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Order;
use App\Models\Products;

use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;
use PDF;
use Notification;
use App\Notifications\SendEmailNotifications;

class AdminController extends Controller
{
    public function view_category()
    {
        // here we are getting all data from database and send are pass to data to ccatagory page through compact
        $data = Catagory::all();
        return view("admin.catagory", compact('data'));
    }
    public function add_catagory(Request $request)
    {
        //zain remember that we are creating object of catagory class which mean that we want to add or create new category 
        $data = new Catagory();
        $data->catagory_name = $request->catagory;
        $data->save();
        return redirect()->back()->with("message", 'Added Successfully');
    }
    public function delete_catagory($id)
    {
        //its mean we want to find existing object therefore we will find the catagory by id not creating a new object of catagory
        $data = Catagory::find($id);
        $data->delete();
        return redirect()->back()->with("message", 'Catagory deleted Successfully');
    }
    public function view_product()
    {
        $catagory = Catagory::all();

        return view('admin.product', compact('catagory'));
    }
    public function add_product(Request $request)
    {
        $product = new Products();
        $product->title = $request->title;
        $product->description = $request->descripton;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->dis_price;
        $product->catagory = $request->catagory;
        $image = $request->image;
        //here we mix image name with time library for make it unique
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        //to store in database
        $product->image = $imagename;
        $product->save();

        return redirect()->back()->with('message', "product Added Successfully");
    }
    public function show_product()
    {
        $all_products = Products::all();
        return view('admin.show_product', compact('all_products'));
    }
    public function delete_product($id)
    {

        $product = Products::find($id);
        $product->delete();
        return redirect()->back()->with("message", "product are deleted successfully");
    }
    public function update_product($id)
    {

        $product = Products::find($id);
        $catagory = Catagory::all();

        return view("admin.update_product", compact("product", 'catagory'));
    }
    public function update_product_confirm(Request $request, $id)
    {

        $product = Products::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->catagory = $request->catagory;
        $product->quantity = $request->quantity;
        $image = $request->image;
        //here if the image is exists then we will change otherwise we can not change image
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }
        $product->save();
        return redirect()->back()->with("message", "product are Updated successfully");;
    }
    public function order()
    {
        $order = Order::all();

        return  view('admin.order', compact('order'));
    }

    public function delivered($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'delivered';
        $order->payment_status = "Paid";
        $order->save();
        return redirect()->back();
    }
    public function print_pdf($id)
    {
        try {
            $order = Order::find($id);
            //here i am loading the view of that admin.pdf file and then i have converting the Pdf
            $pdf = PDF::loadView('admin.pdf', compact("order"));
            return $pdf->download('order_details.pdf');
        } catch (\Throwable $th) {

            return redirect();
        }
    }
    public function send_email($id)
    {
        $order = Order::find($id);

        return view('admin.email_info', compact('order'));
    }
    public function send_user_email(Request $request, $id)
    {
        $order = Order::find($id);

        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,

        ];

        Notification::send($order, new SendEmailNotifications($details));

        return redirect()->back();
    }

    public function searchdata(Request $request)
    {
        $searchText = $request->search;

        $order = Order::where('name', 'LIKE', "%$searchText%")->orWhere('product_title', 'LIKE', "%$searchText%")->orWhere('phone', 'LIKE', "%$searchText%")->get();


      return  view('admin.order', compact("order"));
    }
}
