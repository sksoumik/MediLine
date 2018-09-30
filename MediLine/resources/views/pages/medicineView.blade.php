@extends('layouts.app')
@section('content')

    <h2 class= "display-1">All Medicines</h2>
    <div class="input-group col-md-offset-9">
        {!!Form::open(['route'=>'medicine.index', 'method'=>"GET"])!!}
        {!!Form::text('med_name',null, ['class' => 'form-control'] )!!}

        {!!Form::submit('Search', ['class' => 'btn btn-success form-control search-btn'])!!}
        {!!Form::close()!!}
    </div>
    <br><br>
    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    <div class="container justify-content-center" style="margin-top: 20px">
        <table class="table table-hover table-responsive table-striped">
            <thead >
            <tr class="text-center">
                <th>Name</th>
                <th>Group name</th>
                <th>Power in mg</th>
                <th>Price per unit</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($medicines as $medicine)
                <tr>
                    <td>{{$medicine->med_name}}</td>
                    <td>{{$medicine->med_group}}</td>
                    <td>{{$medicine->power_mg}}</td>
                    <td>{{$medicine->price}}</td>
                    <td><a href="{{route('medicine.addToCart', ['id' => $medicine->id])}}" class ="btn btn-primary">Add to cart</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {!!$medicines->links();!!}
        </div>
    </div>
@endsection