@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (!empty($products))
            @foreach ($products as $product)
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <a href="/product/{{$product->id}}">{{$product->name}}</a>
                </div>
            @endforeach
            {!! $products->render() !!}
        @else
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
