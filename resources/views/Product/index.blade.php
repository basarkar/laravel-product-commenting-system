<?php
/**
 * Created by PhpStorm.
 * User: bappasarkar
 * Date: 12/15/16
 * Time: 4:13 PM
 */
?>
@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $product->name}}</td>
                <td>{{ $product->desc}}</td>
                <td>${{ $product->price}}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('product.show',$product->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $product->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {!! $products->render() !!}
@endsection
