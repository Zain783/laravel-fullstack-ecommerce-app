<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <base href="/product">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="/home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="/home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="/home/css/responsive.css" rel="stylesheet" />
    <style>
        .product_cart {


            background-color: #131313;
            border-radius: 30px;
            padding: 30px;
        }
    </style>
</head>

<body>

    <!-- header section strats -->
    @include('home.header')
    <div class="">
        <div class="col-sm-6 col-md-5 col-lg-5 product_cart" style="margin: auto;width:50%;">
            <div class="img-box" style="padding-top:20px;">
                <img src="{{ url('product/' . $product->image) }}" alt="">
            </div>
            <div class="detail-box">
                <h6>Title:
                    {{ $product->title }}
                </h6>
                @if ($product->discount_price != null)
                    <h6 style="color: red;">Discount Price :
                        ${{ $product->discount_price }}
                    </h6>
                    <h6 style="text-decoration: line-through; color:white;">
                        Price :
                        ${{ $product->price }}
                    </h6>
                @else
                    <h6 style=" color:white;"> Price <br>
                        ${{ $product->price }}
                    </h6 style=" color:white;">
                @endif
                <h6 style=" color:white;">

                    Product Catagory: ${{ $product->catagory }}
                </h6>
                <h6 style=" color:white;">

                    Product Details: ${{ $product->description }}
                </h6>
                <h6 style=" color:white;">

                    Available Quantity: ${{ $product->quantity }}
                </h6>
                <form action="{{ url('add_cart', $product->id) }}" method="POST">
                    @csrf
                    <div class="row pt-3">
                        <div class="col-md-4"><input type="number" name="quantity" value="1" style="width: 100px;"
                                min="1" max="{{ $product->quantity }}">
                        </div>
                        <div class="col-md-4"><input style="border-radius: 15px;" type="submit" name=""
                                value="Add To Cart"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>



    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>
    <!-- jQery -->
    <script src="/home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="/home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="/home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="/home/js/custom.js"></script>
</body>

</html>
