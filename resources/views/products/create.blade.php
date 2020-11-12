@extends('layouts.app')

@section('content')
<h1>New Product</h1>
<table class="table">
    {!!Form::open(['action' => 'ProductsController@store', 'method' => 'post', 'enctype' => 'multipart/form-data'])!!}
        <div class="form-group row">
            {!! Form::label("name", "Name", ["class" => "col-sm-2"]) !!}
            {!! Form::text("name", "", ["class" => "col-sm-10"]) !!}
        </div>

        <div class="form-group row">
            {!! Form::label("description", "Description", ["class" => "col-sm-2"]) !!}
            {!! Form::textarea("description", "", ["class" => "col-sm-10"]) !!}
        </div>

        <div class="form-group row">
            {!! Form::label("price", "Price", ["class" => "col-sm-2"]) !!}
            {!! Form::number("price", 0.00, ["class" => "col-sm-3", "step" => "0.01"]) !!}
        </div>
        
        <div class="form-group row">
            {!! Form::label("stock", "Stock", ["class" => "col-sm-2"]) !!}
            {!! Form::number("stock", 1, ["class" => "col-sm-3", "step" => "1"]) !!}
        </div>

        <div class="form-group row">
            {!! Form::label('cover_image', 'Image', ["class" => "col-sm-2"]) !!}
            {!! Form::file('cover_image') !!}
        </div>

        {!! Form::submit("Save", ["class" => "btn btn-success"]) !!}
    {!!Form::close()!!}

</table>
@endsection