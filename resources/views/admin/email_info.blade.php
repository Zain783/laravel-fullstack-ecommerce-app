{{-- <x-app-layout>
    
</x-app-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('admin.css')
    <style>
        label {

            display: inline-block;
            width: 200px;
            font-size: 15px;
            font-weight: bold;
        }

        .inputfiled {

            
            color: black;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">

        @include('admin.sidebar')

        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <div class="main-panel">

            <div class="content-wrapper">
                <div style="padding-left: 35%;padding-top:30px;font-size:25px;font-weight:bold;">
                    <h1 style="">Send Email to {{ $order->email }}</h1>

                </div>
                <form action="{{url('send_user_email',$order->id)}}" method="POST">
                    @csrf
                    <div style="padding-top:30px;">
                        <div style="padding-left: 35%;padding-top:30px;"><label>Email Greeting:</label><input class="inputfiled" type="text" name="greeting"></div>
                        <div style="padding-left: 35%;padding-top:30px;">

                            <label>Email Fistling:</label><input class="inputfiled" type="text" name="firstline">
                        </div>

                        <div style="padding-left: 35%;padding-top:30px;">

                            <label>Email body:</label><input class="inputfiled" type="text" name="body">
                        </div>

                        <div style="padding-left: 35%;padding-top:30px;">

                            <label>Email Button Name:</label><input class="inputfiled" type="text" name="button">
                        </div>

                        <div style="padding-left: 35%;padding-top:30px;">

                            <label>Email url:</label><input class="inputfiled" type="text" name="url">
                        </div>

                        <div style="padding-left: 35%;padding-top:30px;">

                            <label>Email Last Line:</label><input class="inputfiled" name="lastline" type="text" name="lastline">

                        </div>
                        <div style="padding-left: 35%;padding-top:30px;">

                            <input class="btn btn-primary" value="Send Email" type="submit">
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>
