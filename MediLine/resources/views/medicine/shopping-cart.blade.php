@extends('layouts.app')

@section('content')
    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 ol-sm-offset-3">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <span class="badge">{{$product['qty']}} units</span>
                            <stron>{{$product['item']['med_name']}}</stron>
                            <span class="label label-success">{{$product['price']}} BDT</span>
                            {{--<div class="btn-group">--}}
                                {{--<button class="btn btn-primary btn-xs dropdown-toggle"--}}
                                        {{--data-toggle="dropdown">--}}
                                    {{--Action <span class="caret"></span>--}}
                                {{--</button>--}}
                                {{--<ul class="dropdown-menu">--}}
                                    {{--<li>--}}
                                        {{--<a href="#">Reduce 1</a>--}}
                                        {{--<a href="#">Reduce all</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 ol-sm-offset-3">
                 <strong>Total price: {{$totalPrice}} BDT</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 ol-sm-offset-3">
                <a type="button" href="{{route('medicine.checkout')}}" class="btn btn-success">Confirm order</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 ol-sm-offset-3">
                <H2>No items in cart</H2>
            </div>
        </div>
    @endif
@endsection