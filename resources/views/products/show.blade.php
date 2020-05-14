@extends('layouts.app')

@section('content')
<h2>{{$product->name}}</h2>
<h2>{{$product->author}}</h2>
<h2>{{$product->type}}</h2>
<form action="{{route('products.destroy',$product->id)}}" enctype="multipart/form-data" method="post">
    @csrf
    @method('delete')
    <button class="btn btn-danger">Delete</button>
    <a href="{{route('products.edit',$product->id)}}" class="btn btn-info">Edit</a>
</form>
@endsection
