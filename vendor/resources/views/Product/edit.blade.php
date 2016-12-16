<?php
/**
 * Created by PhpStorm.
 * User: bappasarkar
 * Date: 12/15/16
 * Time: 4:17 PM
 */
?>
@extends('layouts.app')

@section('content')
    @if (empty($product))
        Access denied!
    @else
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::model($product, ['method' => 'PATCH','route' => ['product.update', $product->id]]) !!}
        @include('Product.form')
        {!! Form::close() !!}
    @endif
@endsection
