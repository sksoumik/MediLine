@extends('layouts.app')

@section('content')
        <div class="row profile-section" >
        <div class="col-md-4">
            @if(\Auth::user()->id == $user->id || \Auth::user()->id == 2)
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="well well-sm">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4">
                                        <img src="/storage/cover_images/{{$user->cover_image}}" alt="" class="img-circle img-responsive" />
                                    </div>
                                    <div class="col-sm-6 col-md-8">
                                        <h4>{{$user->name}}</h4>
                                        <small>{{$user->address}}</small>
                                        <p>
                                            <i class="glyphicon glyphicon-envelope" style="margin-right: 2px" ></i>{{$user->email}}
                                            <br />
                                            <i class="glyphicon glyphicon-gift" style="margin-right: 2px"></i>{{$user->dob}}</p>
                                        <i class="glyphicon glyphicon-phone"></i>{{$user->phone}}</p>

                                        <!-- Split button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary">
                                                Social</button>
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span><span class="sr-only">Social</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Twitter</a></li>
                                                <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
                                                <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
                                            </ul>
                                            <a href="/profile/{{$user->id}}/edit" class="btn btn-info" style="margin-left: 5px;">Edit Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
            {{--Recent activity/orders--}}
            @if(\Auth::user()->id != 2)
                <div class="col-md-6 pull-right">
                    <h3>Your Recent Orders</h3>
                    @foreach($orders as $order)
                        <div class="panel panel-default">
                            <div class="panel-heading lead"><p>You ordered the following medicines {{ $order->created_at->diffForHumans() }}</p></div>
                            <div class="panel-body">
                                <ul class="list-group">
                                    @foreach($order->cart->items as $item)
                                        <li class="list-group-item">
                                            <span class="badge">{{$item['price']}} BDT</span>
                                            {{$item['item']['med_name']}} | {{$item['qty']}} Units
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="panel-footer">
                                <strong>Total cost: {{$order->cart->totalPrice}} BDT</strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{--suggested medicines from recent orders--}}
            @if(\Auth::user()->id != 2)
                <div class="col-md-6 pull-right">
                    <h3>Reminders</h3>
                    @foreach($orders as $order)
                        @if($order->created_at->diffForHumans() >= 8)
                        <div class="panel panel-default">
                                <div class="panel-heading lead"><p>Our system has detected that you
                                        ordered the following medicines {{ $order->created_at->diffForHumans() }} ago. Feel free to order them again</p></div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            @foreach($order->cart->items as $item)
                                                        <li class="list-group-item">
                                                            <span class="badge">{{$item['price']}} BDT</span>
                                                            {{$item['item']['med_name']}} | {{$item['qty']}} Units
                                                        </li>
                                            @endforeach
                                        </ul>
                                     </div>
                                <div class="panel-footer">
                                    <strong>Total cost: {{$order->cart->totalPrice}} BDT</strong>
                                </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

    

@endsection
