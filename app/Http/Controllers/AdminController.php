<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Products;
use Symfony\Contracts\Service\Attribute\Required;

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
}
