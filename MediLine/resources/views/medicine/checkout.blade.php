@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-5 ol-sm-offset-3">
            <h1>Checkout</h1>
            <h4>Your total is: {{$total}} taka</h4>
            <div id="charge-error" class="alert alert-danger {{!Session::has('error')
            ? 'hidden':' '}}">
                {{Session::get('error')}}
            </div>
            <form action="{{route('medicine.checkout')}}" method="post" id="checkout-form">
               <div class="row">
                   <div class="col-xs-12">
                       <div class="form-group">
                           <label for="name">Name</label>
                           <input type="text" id="name" name="name" class="form-control" required>
                       </div>

                       <div class="form-group">
                           <label for="address">Address</label>
                           <input type="text" id="address" name="address" class="form-control" required>
                       </div>
                       <div class="form-group">
                           <label for="card-name">Name on the card</label>
                           <input type="text" id="card-name" class="form-control" required>
                       </div>

                           <div class="form-group">
                               <label for="card-number">Card number</label>
                               <input type="text" id="card-number" class="form-control" required>
                           </div>

                       <div class="row">

                               <div class="col-xs-6">
                                   <div class="form-group">
                                       <label for="card-expiry-month">expiration month</label>
                                       <input type="text" id="card-expiry-month" class="form-control" required>
                                   </div>
                               </div>
                               <div class="col-xs-6">
                                   <div class="form-group">
                                       <label for="card-expiry-year">expiration year</label>
                                       <input type="text" id="card-expiry-year" class="form-control" required>
                                   </div>
                               </div>

                       </div>

                       <div class="form-group">
                           <label for="card-cvc">cvc</label>
                           <input type="text" id="card-cvc" class="form-control" required>
                       </div>
                   </div>
               </div>

        <button type="submit" class="btn btn-primary">Buy now</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="{{ asset('js/checkout.js') }}"></script>
@endsection