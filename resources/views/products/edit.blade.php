@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.show',$product->id) }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-info">{{ Session::get('success') }}</div>
    @endif

    <form action="{{ route('products.update',$product->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{$product->name}}">
            </div>
            <div class="form-group">
                <label for="name">Enter author</label>
                <input type="text" name="author" class="form-control" value="{{$product->author}}">
            </div>

            <p>Enter publisher<input type="text" name="publisher" class="form-control" value="{{$product->publisher}}"></p>
            <p>Enter publish_year<input type="text" name="publish_year" class="form-control" value="{{$product->publish_year}}"></p>
            <div>Enter product_code
                <select name="product_code" class="form-control">
                    <option value="Select ProductCode">Select ProductCode</option>
                    @foreach($items as $key => $value)
                        <option value="{{$key}}"> {{ $value }} </option>
                    @endforeach
                </select>
            </div>

            <p>Enter Type<input type="text" name="type" class="form-control" value="{{$product->type}}"></p>
            <p>Enter category<input type="text" name="category" class="form-control" value="{{$product->category}}"></p>
            <p>Enter weight<input type="number" name="weight" class="form-control" value="{{$product->weight}}"></p>
            <p>Enter price<input type="text" name="price" class="form-control" value="{{$product->price}}"></p>
            <p>Enter image<input type="text" name="image" class="form-control" value="{{$product->image}}"></p>
{{--            @can('edit-product',$product)--}}
            <button type="submit" class="btn btn-info">Update</button>
{{--            @endcan--}}
        </div>


    </form>


@endsection
