{{-- <x-app-layout>
    
</x-app-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .div_center {

            text-align: center;
            align-items: center;
        }

        .font_size {

            font-size: 40px;
            padding-bottom: 40px;

        }

        .text_color {

            color: black;
            padding-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        .div_design {
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">x</button>{{ session()->get('message') }}
                    </div>
                @endif
                <div class="div_center">
                    <h1 class="font_size">Add Product</h1>
                    <form action="{{ url('/add_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="div_design">
                            <label>Product Title:</label>
                            <input class="text_color" type="text" name="title" placeholder="Write a Title"
                                required="">
                        </div>
                        <div class="div_design">
                            <label>Product Description:</label>
                            <input class="text_color" type="text" name="descripton" placeholder="Write a Description"
                                required="">
                        </div>
                        <div class="div_design">
                            <label>Product Price:</label>
                            <input class="text_color" type="number" name="price" placeholder="Write a Price"
                                required="">
                        </div>
                        <div class="div_design">
                            <label>Discount Price:</label>
                            <input class="text_color" type="number" name="dis_price" placeholder="Write a Title">
                        </div>

                        <div class="div_design">
                            <label>Product Quantity:</label>
                            <input class="text_color" type="number" min="0" name="quantity" required=""
                                placeholder="Write a Title">
                        </div>
                        <div class="div_design">
                            <label>Product Catagory:</label>
                            <select name="catagory" class="text_color" required="">
                                <option value="">Add a catagory here</option>
                                @foreach ($catagory as $catagory)
                                    <option value="{{ $catagory->catagory_name }}">{{ $catagory->catagory_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="div_design">
                            <label>Product Image:</label>
                            <input type="file" name="image" required="">
                        </div>
                        <div class="div_design">

                            <input class="btn btn-primary" type="submit" value="Add product">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.script')
</body>

</html>
