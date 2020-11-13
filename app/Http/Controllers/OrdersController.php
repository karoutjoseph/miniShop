<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Cart;
use App\Order;


class OrdersController extends Controller
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
            if(Auth::user()->isAdmin==1)
            {
                $orders=Order::where('status','!=','removed')->orderBy('created_at','desc')->get();
                return view('orders.admin_order')->with('orders',$orders);
            }
            else
            {
                $orders=Order::where('user_id',Auth::user()->id)->where('status','!=','removed')->orderBy('created_at','desc')->get();
                return view('orders.user_order')->with('orders',$orders);
            }
        }
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
        $user_id=Auth::user()->id;
        $items=Cart::where('user_id',$user_id)->get();
        foreach($items as $item)
        {
            $prod=$item->product;
            $order=new Order;
            $order->user_id=$user_id;
            $order->quantity=$item->quantity;
            $order->price=$prod->price;
            $order->product_id=$item->product_id;
            $order->save();
            $prod->quantity=$prod->quantity-$order->quantity;
            $prod->save();
            $item->delete();
        }
        $msg='Your orders are pending approval';
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
        $type=$request->input('type');
        if($type=='received')
        {
            $order=Order::find($id);
            $order->status='received';
            $order->save();
        }
        if($type=='remove')
        {
            $order=Order::find($id);
            $order->status='removed';
            $order->save();
        }
        if($type=='disable')
        {
            $order=Order::find($id);
            $order->status='disable';
            $order->save();
        }
        if($type=='accepted')
        {
            $order=Order::find($id);
            $order->status='on its way';
            $order->save();
        }
        $msg='Done';
        return response()->json(['msg'=>$msg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
