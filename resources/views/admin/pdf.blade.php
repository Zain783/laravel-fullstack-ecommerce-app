<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <base href="/public"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order PDF</title>
    <style type="text/css">
        body {

            background: black;
            border-radius: 15px;
        }
        .pdf_style {
            margin-top: 50px;
            margin: auto;
            text-align: center;
            border-radius: 15px;
            width: 90%;
            height: 90%;
            color: grey;
            background-color: white;
        }
        .image_style {
            height: 250px;
            width: 450px;
        }
    </style>
</head>

<body>
    <div class="pdf_style">
        <h1>Order Details</h1>
        <h3>Customer Name:{{ $order->name }}</h3>
       <h3> Customer Email:{{ $order->email }}</h3>
       <h3> Customer Phone:{{ $order->phone }}</h3>
        <h3>Customer address:{{ $order->address }}</h3>
        <h3>Customer Id:{{ $order->user_id }}</h3>
        <h3>Product Name:{{ $order->product_title }}</h3>
        <h3>Product Price:{{ $order->price }}</h3>
       <h3> Product Quantity:{{ $order->quantity }}</h3>
        <h3>Payment Status:{{ $order->payment_status }}</h3>
        <h3>Product Id:{{ $order->product_id }}</h3>
        <img class="image_style"  src="product/{{ $order->image }}" alt="">

    </div>
</body>

</html>
