{{-- <x-app-layout>
    
</x-app-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .center {


            margin: auto;
            width: 50%;
            border: 2px solid white;
            text-align: center;
            margin-top: 40px;



        }

        .font_size {

            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }

        .image_size {
            width: 150px;
            height: 150px;
            border-radius: 5px;


        }

        .th_color {

            background: cornflowerblue;
        }

        .the_deg {
            padding: 30px;


        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">x</button>{{ session()->get('message') }}
                        </div>
                    @endif 
                    <h2 class="font_size">All Products</h2>
                    <table class="center">
                        <tr class="th_color">
                            <th class="the_deg">Product title</th>
                            <th class="the_deg">Description</th>
                            <th class="the_deg">Quality</th>
                            <th class="the_deg">Catagory</th>
                            <th class="the_deg">Price</th>
                            <th class="the_deg">Discount Price</th>
                            <th class="the_deg">Product Image</th>
                            <th class="the_deg">Delete</th>
                            <th class="the_deg">Edit</th>
                        </tr>

                        @foreach ($all_products as $product)
                            <tr>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->catagory }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount_price }}</td>
                                <td><img class="image_size" src="/product/{{ $product->image }}" alt=""></td>
                                <td><a class="btn btn-danger" href="{{ url('delete_product', $product->id) }}"
                                        onclick="return confirm('Are You Sure To Delete?')">Delete</a>
                                </td>
                                <td><a class="btn btn-success" href="{{url('update_product', $product->id)}}">Edit</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>
