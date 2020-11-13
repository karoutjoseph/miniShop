<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Favorite;
use App\Order;
use App\Category;
use DB;
use Auth;

class PagesController extends Controller
{
    public function index()
    {
        if(Auth::user()!=null)
        {
            if(Auth::user()->isAdmin==1)
            {
                return redirect('/admin/home');
            }
        }
        //latest products
        $lp=Product::orderBy('created_at','desc')->get();
        //most viewed
        $vp=Product::orderBy('counter','desc')->get();
        //favorite products
        $f=DB::select('select product_id from favorites group by product_id order by count(*) desc');
        $fp=[];
        for($i=0;$i<count($f);$i++)
        {
        $fp[]=Product::find($f[$i]->product_id);
        }
        //most ordered
        $o=DB::select('select product_id from orders group by product_id order by count(*) desc');
        $op=[];
        for($i=0;$i<count($o);$i++)
        {
            $op[]=Product::find($o[$i]->product_id);
        }
        return view('pages.home')->with(compact('lp','vp','fp','op'));
    }

    public function search(Request $request)
    {
        $text=$request->input('textToSearch');
        $prods=DB::select('select * from products where INSTR(title, ?)>0 or INSTR(company, ?)>0 ',[$text,$text]);
        $prods1=[];
        $category=DB::select('select * from categories where INSTR(title, ?)>0',[$text]);
        foreach($category as $k)
        {
            $c=Category::find($k->id);
            $prods1[]=$c->products;
            $categories=Category::all();
            foreach($categories as $k1)
            {
                if($k1->parent_id==$k->id)
                {
                    $prods1[]=$k1->products;
                }
            }
        }
        return view('pages.search')->with(compact('prods','prods1'));
    }
    
    public function advanceSearch(Request $request)
    {
        $text=$request->input('textToSearch');
        $cateFromAdvance=$request->input('cate');
        if($cateFromAdvance!='no')
        {
            $prods=DB::select('select * from products where INSTR(title, ?)>0 or INSTR(company, ?)>0 and category_id = ? ',[$text,$text,$cateFromAdvance]);
            $prods1=[];
            $categories=Category::all();
            foreach($categories as $k1)
            {
                if($k1->parent_id==$cateFromAdvance)
                {
                    $prods1[]=DB::select('select * from products where INSTR(title, ?)>0 or INSTR(company, ?)>0 and category_id= ?',[$text,$text,$k1->id]);
                }
            }
            return view('pages.search')->with(compact('prods','prods1'));
        }
        else
        {
            $prods=DB::select('select * from products where INSTR(title, ?)>0 or INSTR(company, ?)>0 ',[$text,$text]);
            $prods1=[];
            $category=DB::select('select * from categories where INSTR(title, ?)>0',[$text]);
            foreach($category as $k)
            {
                $c=Category::find($k->id);
                $prods1[]=$c->products;
                $categories=Category::all();
                foreach($categories as $k1)
                {
                    if($k1->parent_id==$k->id)
                    {
                        $prods1[]=$k1->products;
                    }
                }
            }
            return view('pages.search')->with(compact('prods','prods1'));
        }
    }
}
