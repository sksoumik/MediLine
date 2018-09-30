@extends('layouts.app')
@section('content')

    <h1>Edit or Add information to profile</h1>


    {!! Form::open(['action' => ['ProfileController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'User name'])}}
    </div>
    <div class="form-group">
        {{Form::label('email', 'Email')}}
        {{Form::email('email', $user->email, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'New email'])}}
    </div>
    <div class="form-group">
        {{Form::label('date-of-birth', 'Date of birth')}}
        {{Form::date('date-of-birth', $user->dob, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Date of birth'])}}
    </div>
    <div class="form-group">
        {{Form::label('address', 'Address')}}
        {{Form::text('address', $user->address, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Address'])}}
    </div>
    <div class="form-group">
        {{Form::label('phone', 'Phone number')}}
        {{Form::number('phone', $user->phone, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Phone Number'])}}
    </div>
    {{Form::label('add a profile image', 'Add profile image')}}
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>

    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection

