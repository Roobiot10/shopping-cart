<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('success')){
            
            toast(session('success'),'success');
        }

        if(request()->categorie){

            $products = Product::with('categories')->whereHas('categories', function($query){
                $query->where('slug',request()->categorie);
            })->orderBy('created_at','DESC')->paginate(6);

        }else{

            $products = Product::with('categories')->paginate(6);

        }


        return view('product.index')->with('products',$products);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = product::where('slug',$slug)->firstOrFail();

        return view('product.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([

            'qty' => 'required|numeric|min:1'
        ]);

        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id,$request->qty);
        session()->put('cart',$cart);
        return redirect()->route('cart.show')->with('success','Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(session('success')){
            
            toast(session('success'),'success');
        }
        
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);

        if($cart->totalQty <= 0){

            session()->forget('cart');
        }else{
            session()->put('cart',$cart);
        }
        
        return redirect()->route('cart.show')->with('success','Le product a bién été supprimer');
    }

    
    public function addToCart(Product $product)
    
    {
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = new Cart();
        }
        $cart->add($product);

        session()->put('cart',$cart);

        return redirect()->route('store')->with('success','Le product a bién été ajouter au panier');

    }

    public function showCart()
    {
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));

        }else{
            $cart = null;

        }
        return view('cart.show')->with('cart',$cart);
    }
    
    public function checkout($amount)
    {
        return view('cart.checkout')->with('amount',$amount);
    }

    public function charge(Request $request)
    {
        $charge = Stripe::charges()->create([

            'currency' => 'USD',
            'source' => $request->stripeToken,
            'amount' =>$request->amount,
            'description' => 'shopping-cart laravel 7'
        ]);

        $chargeId = $charge['id'];

        if($chargeId){

            auth()->user()->orders()->create([
                'cart' => serialize(session()->get('cart'))
            ]);

            session()->forget('cart');
            return  redirect()->route('store')->with('success','le paiement a été effectué merci');
        }else{
            return  redirect()->back();


        }

    }

    public function search()
    {
        
        request()->validate([
            'q' => 'required|min:3'
        ]);


        $q = request()->input('q');
        
        $products = Product::where('title','like',"%$q%")->orwhere('description','like',"%$q%")->paginate(6);

        return view('product.search')->with('products',$products);
    }
}
