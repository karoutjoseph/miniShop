@extends('layouts.appadmin')
@section('content')
<?php
use App\Category;
?>
<a href="../cate/create" class="btn btn-success">Add new Category</a>
<table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Category Title</th>
            <th scope="col">Parent Category</th>
            <th scope="col"># of products</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <?php
          $parent='n/a';
          if($category->parent_id!=null)
          {
              $parent=Category::find($category->parent_id)->title;
          }
          ?>
            <tr>
              <td><?=$category->title?></td>
              <td><?=$parent?></td>
              <td><?=count($category->products)?></td>
              <td><a href="<?=url("/");?>/cate/<?=$category->id?>/edit" class="btn btn-primary">Edit</a></td>
            @endforeach  
        </tbody>
</table>  
@endsection