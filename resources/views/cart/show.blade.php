@extends('layouts.shopping')

@section('content')
@if ($cart)
<div class="px-4 px-lg-0">
    <div class="pb-5">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach

                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                    <!-- Shopping cart table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Produit</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Prix</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Quantité</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Action</div>
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->items as $product)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{ $product['image'] }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle card-title">
                                                <h5 class="mb-0">{{ $product['subtitle'] }}</h5>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"><strong>{{ $product['price'] }} $</strong></td>
                                    <td class="border-0 align-middle">
                                        <form action="{{route('product.update',$product['id'])}}" method="POST" >
                                            @csrf
                                            @method('put')
                                            <input type="text" name="qty" id="qty" value="{{$product['qty']}}">
                                    </td>
                                    <td class="border-0 align-middle">
                                            <button class="btn btn-secondary"><i class="far fa-edit"></i></button>
                                        </form>
                                        <form action="{{route('product.remove',$product['id'])}}" method="POST"  >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger "><i class="fa fa-trash"></i></a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                    <!-- End -->
                </div>
            </div>
            <div class="row p-4 bg-white rounded shadow-sm">
                <div class="col-lg-12">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Détails de la commande
                    </div>
                    <div class="p-4">
                        <p class="font-italic mb-4">Les frais éventuels de livraison seront calculés suivant les informations que vous avez transmises.</p>
                        <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total </strong><strong>{{$cart->totalPrice}} $</strong></li>
                        {{-- <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li> --}}
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Quantité</strong><strong>{{$cart->totalQty}}</strong></li>
                        {{-- <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                            <h5 class="font-weight-bold">26595 $</h5>
                        </li> --}}
                    </ul><a href="{{route('cart.checkout',$cart->totalPrice)}}" class="btn btn-info rounded-pill py-2 btn-block">Passer à la caisse  <i class="fab fa-cc-visa" aria-hidden="true"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-md-12">
    <h5>Votre panier est vide pour le moment </h5>
    <p>Mais vous pouvez visiter la <a href="{{ route('store') }}">boutique</a> pour faire votre shopping.
    </p>
</div>
@endif
@endsection