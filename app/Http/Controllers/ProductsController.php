<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Image;
use App\Category;
use DB;
use File;

class ProductsController extends Controller
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
        return view('products.create')->with('cates',$cates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'images[*]' => 'image|max:1999',
            
            'title' => 'required',

            'company' => 'required',

            'price' => 'required',

            'quantity' => 'required',

            'descr' => 'required',

            'cate' => 'required'

    ]);

    $product=new Product;
    $product->title=$request->input('title');
    $product->company=$request->input('company');
    $product->category_id=$request->input('cate');
    $product->price=$request->input('price');
    $product->quantity=$request->input('quantity');
    $product->descr=$request->input('descr');
    $product->save();
    $prod_id=$product->id;
    
    if($request->hasFile('images'))
    {
     foreach($request->file('images') as $img)
     {
         //file name with extension
         $fileNameWithExt=$img->getClientOriginalName();
         //just file name
         $filename=pathinfo($fileNameWithExt, PATHINFO_FILENAME);
         //just the extension
         $extension=$img->getClientOriginalExtension();
         //file name to store
         $fileNameToStore=$filename.'_'.time().'.'.$extension;
         $path=$img->storeAs('public/images',$fileNameToStore);
         $image=new Image;
         $image->product_id=$prod_id;
         $image->img=$fileNameToStore;
         $image->save();
     }
    }
    else
    {
      $fileNameToStore='noimage.jpg';
      $image=new Image;
      $image->product_id=$prod_id;
      $image->img=$fileNameToStore;
      $image->save();
    }
    $msg="product is added successfully";
    return redirect("/admin/home")->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $prod=Product::find($id);
        $prod->counter=$prod->counter+1;
        $prod->save();
        $images=$prod->images;
        return view('products.prod')->with(compact('prod','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $prod=Product::find($id);
        $cates=Category::all();
        return view('products.edit')->with(compact('prod','cates'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $this->validate($request,[
        'title' => 'required',

        'company' => 'required',

        'price' => 'required',

        'quantity' => 'required',

        'descr' => 'required',

        'cate' => 'required'  
    ]);
        $product=Product::find($id);
        $product->title=$request->input('title');
        $product->company=$request->input('company');
        $product->category_id=$request->input('cate');
        $product->price=$request->input('price');
        $product->quantity=$request->input('quantity');
        $product->descr=$request->input('descr');
        $product->save();
        $msg="product is updated successfully";
        return redirect("/admin/home")->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod=Product::find($id);
        $prod->delete();
        $images=DB::select("select * from images where product_id = ?",[$id]);
        foreach($images as $image)
        {   
            // $file_path='/storage/images/'.$image->img;
            // unlink($file_path);
            
        }
        DB::delete('delete from images where product_id= ?',[$id]);
        $msg="product is deleted successfully";
        return redirect("/admin/home")->with('danger',$msg);
    }

    public function adminProduct()
    {   
        $prods=Product::orderBy('updated_at','desc')->get();
        return view('products.admin_product')->with('prods',$prods);
    }
}
