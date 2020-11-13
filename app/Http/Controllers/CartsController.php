<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Auth;
use DB;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()!=null)
        {
            $cart=Cart::where('user_id',Auth::user()->id)->get();
        }
        else
        {
            $cart=Cart::where('session_id',session()->getId())->get();
        }
        return view('cart.cart')->with('cart',$cart);
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
      $product_id=$request->input('product_id');
      $s_id=session()->getId();
      if(Auth::user()!=null)
      {
            $q=DB::select('select * from carts where product_id = ? and user_id = ?',[$product_id,Auth::user()->id]);
      }
      else
      {
            $q=DB::select('select * from carts where product_id = ? and session_id = ?',[$product_id,$s_id]);
      }
      if(count($q)>0)
      {
            $cart_item=Cart::find($q[0]->id);
            $aqtn=$request->input('aqtn');
            $tqtn=$cart_item->quantity+$request->input('oqtn');
            if($tqtn>$aqtn)
            {
                $msg="we don't have enough units";
            }
            else
            {
                $cart_item->quantity=$tqtn;
                $cart_item->save();
                $msg="Item added to Cart";
            }
      }
      else
      {
            $cart_item=new Cart;  
            $cart_item->product_id=$request->input('product_id');
            $cart_item->quantity=$request->input('oqtn');
            $cart_item->session_id=session()->getId();
            if(Auth::user()!=null)
            {
                $cart_item->user_id=Auth::user()->id;
            }
            $cart_item->save();
            $msg="Item added to Cart";
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
        $item=Cart::find($id);
        $prod=$item->product;
        $oqtn=$request->input('oqtn');
        if($oqtn>$prod->quantity)
        {
            $msg="we don't have enough units so we add ".$prod->quantity."units";
            $item->quantity=$prod->quantity;
            $item->save();
        }
        else
        {
            $msg='yes';
            $item->quantity=$oqtn;
            $item->save();
        }
        return response()->json(['msg'=>$msg,'qtn'=>$prod->quantity]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Cart::find($id);
        $item->delete();
        $msg='item was deleted from your cart';
        return response()->json(['msg'=>$msg]);
    }

    public function items_num(Request $request)
    {
        if(Auth::user()!=null)
        {
            $cart=Cart::where('user_id',Auth::user()->id)->get();
        }
        else
        {
            $cart=Cart::where('session_id',session()->getId())->get();
        }
        $g=count($cart);
        return response()->json(['g'=>$g]);
    }
    
}
