@extends('layouts.appadmin')
@section('content')
{!! Form::open(['action'=>['ProductsController@update',$prod->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$prod->title,['class'=>'form-control','placeholder'=>'Product Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('company','Company')}}
        {{Form::text('company',$prod->company,['class'=>'form-control','placeholder'=>'Product Company'])}}
    </div>
    <div class="form-group">
        {{Form::label('cate','Category')}}
        <select class="form-control" id="cate" name="cate">
            @foreach($cates as $cate)
              @if($cate->id == $prod->category_id)
            <option value="<?=$cate->id?>" selected="selected"><?=$cate->title?></option>
              @else
              <option value="<?=$cate->id?>"><?=$cate->title?></option>
              @endif
            @endforeach
        </select>    
    </div>
    <div class="form-group">
        {{Form::label('price','Price')}}
        {{Form::number('price',$prod->price,['class'=>'form-control','placeholder'=>'Product Price'])}}
    </div>
    <div class="form-group">
        {{Form::label('quantity','Quantity')}}
        {{Form::number('quantity',$prod->quantity,['class'=>'form-control','placeholder'=>'Product Quantity'])}}
    </div>
    <div class="form-group">
        {{Form::label('descr','Description')}}
        {{Form::textarea('descr',$prod->descr,['class'=>'form-control','placeholder'=>'Product Description'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    <div class="form-group">
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    </div>
{!! Form::close() !!}
{!! Form::open(['action'=>['ProductsController@destroy',$prod->id], 'method'=>'POST'])!!}
{{Form::submit('Delete',['class'=>'btn btn-danger'])}}
{{Form::hidden('_method','DELETE')}}
{!! Form::close() !!}
@endsection