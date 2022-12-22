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
    <link href="/home/css/responsive.css" rel="stylesheet" />

    <style type="text/css">
        .center {
            margin: auto;
            width: 70%;
            padding: 30px;
            text-align: center;
        }

        table,
        th,
        td {

            border: 1px solid black;

        }

        .th_deg {
            padding: 10px;
            background-color: skyblue;

        }

        /* .img_deg {


            height: 200px;
            width: 200px;
        }

        .total_deg {

            font-size: 20px;
            padding: 20px;
            font-weight: 800;
        } */
    </style>
</head>

<body>

    <!-- header section strats -->
    @include('home.header')
    <div class="center">
        <table>

            <tr>
                <th class="th_deg">Price Title</th>
                <th class="th_deg">Quantity</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Payment Status</th>
                <th class="th_deg">Delivery Status</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Cancel Order</th>
            </tr>
            @foreach ($order as $order)
                <tr>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->delivery_status }}</td>
                    <td><img height="150" width="160" src="product/{{ $order->image }}" alt=""></td>
                    <td>
                        @if ($order->delivery_status='processing')
                        <a href="{{url('cancel_order')}}" class="btn btn-danger">Cancel Order</a></td>
                            
                        @else
                            <p class="color:blue;">Not Allowed</p>
                        @endif
                        
                </tr>
            @endforeach

        </table>

    </div>

    @include('home.footer')

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
