{{-- <x-app-layout>
    
</x-app-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .div_center {

            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .input_color {

            color: black;
        }

        .center {

            margin: auto;
            width: 50%;
            text-align: center;
            color: black;
            margin-top: 30px;

        }

        .table_container {

            background-color: white;
            border-radius: 15px;
            margin-left: 30%;
            margin-right: 30%;

        }

        .table_td {

            color: black;
        }
        .table_header{

            background-color: skyblue;
            border-radius: 5px;
            
            
        }
    </style>
</head>

<body>
    <div class="container-scroller">


        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')

        <!-- partial -->
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
                <div class="div_center">
                    <h2 class="h2_font">Add Catagory</h2>
                    <form action="{{ url('add_catagory') }}" method="POST">
                        @csrf
                        <input class="input_color" type="text" name="catagory" placeholder="write catagory name">
                        <input type="submit" name="submit" class="btn btn-primary" value="Add Catagory">
                    </form>
                </div>
                <div class="table_container">
                    <table class="center">
                        <tr class="table_header">
                            <td>Catagory Name</td>
                            <td>Action</td>
                        </tr>

                        @foreach ($data as $data)
                            <tr class="table_td">
                                <td>{{ $data->catagory_name }}</td>
                                {{-- @csrf --}}
                                <td><a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-danger"
                                        href="{{ URL('delete_catagory', $data->id) }}">Delete</a></td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        @include('admin.script')
</body>

</html>
