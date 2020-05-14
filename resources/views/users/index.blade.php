@extends('layouts.app')

@section('content')
<div class="container">

        @foreach($users as $user)
            <p>{{$user->name}}</p>
            <p>{{$user->email}}</p>
            <h2>{{$user->products_count}}</h2>
            @foreach($user->products as $product)
                <h2>{{$product->name}}</h2>
                <h2>{{$product->type}}</h2>
            @endforeach
        @endforeach

</div>
@endsection
