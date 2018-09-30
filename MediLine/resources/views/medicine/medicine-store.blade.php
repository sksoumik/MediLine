@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload meds</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('medicine.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="med_name" class="col-md-4 control-label">Med name</label>
                                <div class="col-md-6">
                                    <input id="med_name" type="text" class="form-control" name="med_name" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="med_group" class="col-md-4 control-label">Med group name</label>
                                <div class="col-md-6">
                                    <input id="med_group" type="text" class="form-control" name="med_group" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="power_mg" class="col-md-4 control-label">power_mg</label>
                                <div class="col-md-6">
                                    <input id="power_mg" type="text" class="form-control" name="power_mg"
                                           required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">Price</label>
                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price"
                                           required autofocus>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Upload
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
