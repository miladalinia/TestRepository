@extends('layouts.app')
@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <button type="button" class="btn btn-primary float-lg-left ml-4" data-toggle="modal" data-target="#exampleModal">
        create
        product <i class="fa fa-save"></i>
    </button>
    <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="close fa fa-times-circle"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control inputs">
                            </div>
                            <div class="form-group">
                                <label for="name">Enter author</label>
                                <input type="text" name="author" class="form-control inputs">
                            </div>
                            <p>Enter publisher<input type="text" name="publisher" class="form-control inputs"></p>
                            <p>Enter publish_year<input type="text" name="publish_year" class="form-control inputs"></p>
                            <div>Enter product_code
                                <select name="product_code" class="form-control inputs[]">
                                    <option value="Select ProductCode">Select ProductCode</option>
                                    @foreach($items as $key => $value)
                                        <option value="{{$key}}"> {{ $value }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <p>Enter Type<input type="text" name="type" class="form-control inputs"></p>
                            <p>Enter category<input type="text" name="category" class="form-control inputs"></p>
                            <p>Enter weight<input type="number" name="weight" class="form-control inputs"></p>
                            <p>Enter price<input type="text" name="price" class="form-control inputs"></p>
                            <p>Enter image<input type="text" name="image" class="form-control inputs"></p>
                            <button type="submit" class="btn btn-info">submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="form-group col-md-8">
                <input type="text" name="search" id="search" class="form-control"
                       placeholder="Search Product Data">
            </div>
            <div class="table-responsive">
                <h3 align="center"> Total Data: <span id="total-records"></span>
                </h3>
                <table class="table table-hover table-sm table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>product name</th>
                        <th>username</th>
                        <th>type</th>
                        <th>product code</th>
                        <th>author</th>
                        <th>publisher</th>
                        <th>publish year</th>
                        <th>category</th>
                        <th>weight</th>
                        <th>price</th>
                        <th>image</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                                        @foreach($products as $product)--}}
                    {{--                                            <tr>--}}
                    {{--                                                <td>{{$product->name}}</td>--}}
                    {{--                                                <td>{{$product->user->name}}</td>--}}
                    {{--                                                <td>{{$product->type}}</td>--}}
                    {{--                                                <td>{{$product->product_code}}</td>--}}
                    {{--                                                <td>{{$product->author}}</td>--}}
                    {{--                                                <td>{{$product->publisher}}</td>--}}
                    {{--                                                <td>{{$product->publish_year}}</td>--}}
                    {{--                                                <td>{{$product->category}}</td>--}}
                    {{--                                                <td>{{$product->weight}}</td>--}}
                    {{--                                                <td>{{$product->price}}</td>--}}
                    {{--                                                <td>{{$product->image}}</td>--}}
                    {{--                                            </tr>--}}
                    {{--                                        @endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
        </div>
    </div>
    <script>
        $(document).ready(function () {
            fetch_product_data();

            function fetch_product_data(query = '') {
                $.ajax({
                    type: 'GET',
                    url: "{{route('products.action')}}",
                    data: {
                        query: query,
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('tbody').html(data.table_data);
                        $('#total-records').text(data.total_data);
                    },
                    // error:function(jqXHR, textStatus, errorThrown){
                    //     alert('error!');
                    // }
                })
            }

            $(document).on('keyup', '#search', function () {
                var query = $(this).val();
                fetch_product_data(query);
            });
        });
    </script>
@endsection
