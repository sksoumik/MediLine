@extends('layouts.app')
@section('content')

    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Quick links</h3>
            </div>
            <div class="panel-body">
                <p class="lead text-center">
                    <a href="/owner/upload" class="btn btn-info" style="margin-left: 5px;">Upload medicine</a>
                </p>
            </div>
        </div>
    </div>
    @endsection