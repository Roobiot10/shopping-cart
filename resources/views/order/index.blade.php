@extends('layouts.shopping')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9">
            @foreach($carts as $cart)
            <div class="card mb-3">
                <div class="card-body">
                   
                    <table class="table mt-2 mb-2">
                        <thead>
                            <tr>
                                
                                <th scope="col">Titre</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cart->items as $item)
                            <tr>
                                
                                <td>{{$item['title'] }}</td>
                                <th>{{$item['price'] }} $</th>
                                <td>{{$item['qty'] }}</td>
                                <td> Payé </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </div>
            <p class="badge badge-pill badge-info mb-3 p-3 text-white">Total est : {{$cart->totalPrice}} $</p>
            @endforeach
        </div>
    </div>
</div>

@endsection