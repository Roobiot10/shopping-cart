@extends('layouts.shopping')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                     <div class="card mb-2">
                         <img class="card-img-top" src="{{ $product->image  }}" alt="Card image cap">
                         {{-- <img class="card-img-top" src="{{asset('storage/'.$product->image)}}" alt="Card image cap"> --}}
                             <div class="card-body">
                                 @foreach ($product->categories as $category)
                                 <muted class="d-inline-block mb-2 text-info">{{$category->name}}</muted>
                                 
                                 @endforeach
                               <h5 class="card-title">{{$product->title}}</h5>
                               <p class="card-text"><small class="text-muted">{{$product->created_at->format('d/m/Y')}}</small></p>
                               <p class="card-text"> {{$product->subtitle}}</p>
                               <p><strong>$ {{$product->price}}</strong></p>
                             <a href="{{route('products.show',$product->slug)}}" class="btn btn-info">Voir</a>
                             <a href="{{route('cart.add',$product->id)}}" class="btn btn-warning"><i class="fas fa-cart-arrow-down"></i></a>
                             </div>
                   </div>
                </div>
            @endforeach
         </div>
    </div>
    {{$products->appends(request()->input())->links()}}
@endsection