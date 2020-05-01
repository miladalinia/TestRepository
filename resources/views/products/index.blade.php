@extends('layouts.app')

@section('content')

    @if(count($products) > 0)
        @foreach($products as $product)
            <p>{{$product->id}}</p>
            <p>{{$product->name}}</p>
            <p>{{$product->user->name}}</p>
            <strong>{{$product->product_code}}</strong>
            <p>{{$product->type}}</p>
            <p>{{$product->price}}</p>

            <a href="{{route('products.show',$product->id)}}" >Show</a>
        @endforeach
        <div>
            {{$products->links()}}
        </div>
    @endif
@endsection

