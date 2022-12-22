{{-- <x-app-layout>
    
</x-app-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        .title_deg {

            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;


        }

        .table_deg {
            border: 2px solid white;
            width: 75%;
            margin: auto;
            padding-top: 50px;
            text-align: center;
            border-radius: 10px;
        }

        .th_tg {

            background-color: skyblue;
            color: black;
        }

        .image_size {
            width: 150px;
            height: 150px;
            border-radius: 5px;
            background-color: grey;
            border: 1px solid black;


        }

        .table_container {
            padding-top: 40px;
            background-color: white;
            border-radius: 10px;

        }

        .table_data {

            color: black;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">

            <div class="content-wrapper">

                <h1 class="title_deg">All Order</h1>

                <div style="padding-left:40%; padding-bottom:30px;">
                    <form action="{{ url('search') }}" method="GET">
                        @csrf
                        <input type="text" style="color: black;" name="search" placeholder="search For Something">
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
                <div class="table_container">
                    <table class="table_deg">
                        <tr class="th_tg">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Product_title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Image</th>
                            <th>Delivered</th>
                            <th>Print PDF</th>
                            <th>Send Email</th>
                        </tr>

                        @forelse ($order as $order)
                            <tr class="table_data">
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->product_title }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->delivery_status }}</td>
                                <td><img height="200" width="200" class="img_size"
                                        src="/product/{{ $order->image }}" alt=""></td>
                                <td>
                                    @if ($order->delivery_status == 'processing')
                                        <a href="{{ url('delivered', $order->id) }}"
                                            class="btn btn-primary">Delivered</a>
                                    @else
                                        <p>Delivered</p>
                                    @endif

                                </td>
                                <td>
                                    <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-secondary">Print
                                        Pdf</a>
                                </td>
                                <td> <a href="{{ url('send_email', $order->id) }}" class="btn btn-info">Send Email</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="16" style="color: black;">No Data Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>


            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>
