<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates=Category::all();
        return view('categories.create')->with('cates',$cates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required'
        ]);
        $cate=new Category;
        $cate->title=$request->input('title');
        if($request->input('parent_id')!=null)
        {
            $cate->parent_id=$request->parent_id;
        }
        $cate->save();
        $msg="category is created successfully";
        return redirect("/admin/category")->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cate=Category::find($id);
        $prods=$cate->products;
        $prods1=[];
        //check if this category is Parent
        $query=DB::select("select * from categories where parent_id = ?",[$id]);
        if(count($query) > 0)
        {
          //get sub category products
           foreach($query as $k)
           {
              $q=Category::find($k->id);
              $prods1[]=$q->products;
           }
        }
        return view('pages.cate')->with(compact('cate','prods','prods1'));
        
        // if($cate->parent_id==null)
        // {
        // return view('pages.cate')->with(compact('cate','prods'));
        // }
        // else
        // {
        //  $c=Category::find($cate->parent_id);
        //  $prods1=$c->products;
        //  return view('pages.cate')->with(compact('cate','prods','prods1'));         
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cates=Category::all();
        $cate=Category::find($id);
        return view('categories.edit')->with(compact('cates','cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            "title"=>'required'
        ]);
        $cate=Category::find($id);
        $cate->title=$request->input('title');
        $cate->parent_id=$request->input('parent_id');
        $cate->save();
        $msg="category is updated successfully";
        return redirect("/admin/category")->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate=Category::find($id);
        $cate->delete();
        $msg="category is deleted successfully";
        return redirect("/admin/category")->with('danger',$msg);
    }

    public function adminCategory()
    {
        $categories=Category::all();
        return view('categories.admin_category')->with('categories',$categories);
    }
}
