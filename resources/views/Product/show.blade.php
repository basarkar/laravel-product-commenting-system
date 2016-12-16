<?php
/**
 * Created by PhpStorm.
 * User: bappasarkar
 * Date: 12/15/16
 * Time: 4:19 PM
 */
?>
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $product->name}}</h2>
                <div>{{ $product->desc}}</div>
                <div>Price: <b>${{$product->price}}</b></div>
            </div>
        </div>
    </div>
    {!! Form::open(array('url' => 'product/comment/' . $product->id, 'method'=>'POST', 'id'=>'comment-form')) !!}
    {!! Form::hidden('product_id', $product->id) !!}
    <div class="row" style="margin-top:20px;">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="err-feedback">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Comment:</strong>
                    {!! Form::textarea('comment', NULL, array('placeholder' => 'Add your comment here', 'required' => 'true', 'id'=>'comment-area', 'class' => 'form-control','style'=>'height:100px')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button type="submit" id="comment-submit-button" class="btn btn-primary">Post Comment</button>
            </div>
        </div>
        {!! Form::close() !!}
        <div id="comment">
        @if ($comments->count())
            @foreach ($comments as $comment)
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left" style="margin-right:10px;">
                            <b>{{ $comment->name}}</b>
                        </div>
                        <div class="pull-left">
                            {{ $comment->comment}}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
        <script type="text/javascript" src="{{ URL::asset('js/comment.js') }}"></script>
@endsection
