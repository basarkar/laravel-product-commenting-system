@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if ($products->count())
                            @foreach ($products as $product)
                                <div>
                                    <a href="/product/{{$product->id}}">{{$product->name}}</a>
                                </div>
                            @endforeach
                            {!! $products->render() !!}
                        @else
                        No product has been added yet!
                        @endif
                    </div>
                </div>
            </div>

    </div>
</div>
@endsection
