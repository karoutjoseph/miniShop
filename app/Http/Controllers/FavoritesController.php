<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use Auth;
use DB;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favorites=Auth::user()->favorites;
        return view('favorites.favo')->with('favorites',$favorites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $q=DB::select('select * from favorites where product_id= ? and user_id = ?',[$request->input('product_id'),Auth::user()->id]);
         if(count($q)>0)
         {
             $msg="<label class='alert alert-warning'>Product is already in your favorite</label>";
         }
         else
         {
         $favorite=new Favorite;
         $favorite->product_id=$request->input('product_id');
         $favorite->user_id=Auth::user()->id;
         $favorite->save();
         $msg="<label class='alert alert-success'>Item is in your favorite</label>";
         }
         return response()->json(['msg'=>$msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $favorite=Favorite::find($id);
        $favorite->delete();
        $msg='Done';
        return response()->json(['msg'=>$msg]);
    }

    public function check(Request $request)
    {
        $product_id=$request->input('product_id');
        if(Auth::user()!=null)
        {
            $q=DB::select('select * from favorites where product_id = ? and user_id = ?',[$product_id,Auth::user()->id]);
            if(count($q)>0)
            {
                $msg="<button id='".$q[0]->id."' class='btn btn-danger' value='rfavo' type='button'>Remove from favorite</button>";
            }
            else
            {
                $msg='<button id="fd" class="like btn btn-default" value="'.$product_id.'" click="add_to_fav(this.value)" type="button">Add to favorite</button>';
            }

        }
        else
        {
            $msg='<a class="like btn btn-default" value="favo1" type="button" href="'.route('login').'">Add to favorite</a>';
        }
        return response()->json(['msg'=>$msg]);
    }
}
