@extends('layouts.appadmin')
@section('content')
{!! Form::open(['action'=>['CategoriesController@update',$cate->id], 'method'=>'POST']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$cate->title,['class'=>'form-control','placeholder'=>'Category Title'])}}
    </div>
    <div class="form-group">
            {{Form::label('parent_id','Parent Category')}}
            <select class="form-control" id="parent_id" name="parent_id">
                @foreach($cates as $c)
                @if($c->id == $cate->parent_id)
                <option value="<?=$c->id?>" selected="selected"><?=$c->title?></option>
                @else
                <option value="<?=$c->id?>"><?=$c->title?></option>                
                @endif
                @endforeach
            </select>
    </div>
    {{Form::hidden('_method','PUT')}}
    <div class="form-group">
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    </div>
{!! Form::close() !!}
{!! Form::open(['action'=>['CategoriesController@destroy',$cate->id],'method'=>'POST'])!!}
{{Form::hidden('_method','DELETE')}}
<div class="form-group">
    {{Form::submit('DELETE',['class'=>'btn btn-danger'])}}
</div> 
{!! Form::close() !!}
@endsection