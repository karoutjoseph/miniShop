@extends('layouts.appadmin')
@section('content')
{!! Form::open(['action'=>'ProductsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    @csrf
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title','',['class'=>'form-control','placeholder'=>'Product Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('company','Company')}}
        {{Form::text('company','',['class'=>'form-control','placeholder'=>'Product Company'])}}
    </div>
    <div class="form-group">
        {{Form::label('cate','Category')}}
        <select class="form-control" id="cate" name="cate">
                <option selected="selected" value="">Pick a category...</option>
                @foreach($cates as $cate)
                <option value="<?=$cate->id?>"><?=$cate->title?></option>
                @endforeach
        </select>
    </div>
    <div class="form-group">
        {{Form::label('price','Price')}}
        {{Form::number('price','',['class'=>'form-control','placeholder'=>'Product Price'])}}
    </div>
    <div class="form-group">
        {{Form::label('quantity','Quantity')}}
        {{Form::number('quantity','',['class'=>'form-control','placeholder'=>'Product Quantity'])}}
    </div>
    <div class="form-group">
        {{Form::label('descr','Description')}}
        {{Form::textarea('descr','',['class'=>'form-control','placeholder'=>'Product Description'])}}
    </div>
    <div class="form-group">
    <input type="file" name="images[]" class="myfrm form-control" multiple>
    </div>
    <div class="form-group">
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    </div>
{!! Form::close() !!}
@endsection