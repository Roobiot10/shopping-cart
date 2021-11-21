@extends('layouts.shopping')

@section('content')
<div class="col-md-12">
    <div class="row no-gutters p-3 border rounded d-flex align-items-center flex-md-row mb-4 shadow-sm position-relative">
      <div class="col p-3 d-flex flex-column position-static">
        <muted class="d-inline-block mb-2 text-info">
          @foreach ($product->categories as $category)
              {{ $category->name }}{{ $loop->last ? '' : ', '}}
          @endforeach
        </muted>
        <h5 class="mb-4">{{$product->title}}</h5>
        <div class="mb-1 text-muted">{{$product->created_at}}</div>
        <span>{!! $product->description !!}</span>
        <strong class="mb-auto">{{$product->price}} $</strong>
    </div>
    <div class="col-auto d-none d-lg-block">
        <img src="{{$product->image}}"  >
    </div>
    </div>
    <a href="{{route('cart.add',$product->id)}}" class="btn btn-success mb-2">Ajouter au panier <span class="fas fa-shopping-cart"></span></a>
</div>

@endsection