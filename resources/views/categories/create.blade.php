@extends('layouts.appadmin')
@section('content')
{!! Form::open(['action'=>'CategoriesController@store', 'method'=>'POST']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title','',['class'=>'form-control','placeholder'=>'Category Title'])}}
    </div>
    <div class="form-group">
            {{Form::label('parent_id','Parent Category')}}
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">Pick parent Category</option>
                @foreach($cates as $c)
                <option value="<?=$c->id?>"><?=$c->title?></option>
                @endforeach
            </select>    
    </div>
    <div class="form-group">
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    </div>
{!! Form::close() !!}
@endsection