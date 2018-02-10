@extends('layouts.master', ['title' => 'Admin - Settings', 'isAdmin' => true])
@section('content')
    {!! Form::open(['url' => '/admin/settings/maintence', 'method' => 'POST']) !!}
        <button type="submit" class="maintence-button">
            <span class="fa fa-power-off"></span>
        </button>
    {!! Form::close() !!}


    <div class="flex-grid-thirds">
        <div class="col">
            <a href="/admin/bus"  class="btn btn-primary">
                Bus Lines
            </a>
        </div>
        <div class="col">
            <a href="/admin/customers"  class="btn btn-primary">
                Customers
            </a>
        </div>
        <div class="col">
            <a href="/admin/users"  class="btn btn-primary">
                Admins
            </a>
        </div>
    </div>
@endsection


{{--<div class="section fp center-container">
    {!! Form::open(['url' => '/admin/settings/buslines', 'method' => 'POST']) !!}
    <div class="form-group">
        {!! Form::label('Origin:') !!}
        {!! Form::text('origin', null, ['class' => 'form-control', 'placeholder' => 'Bus Origin']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Price:') !!}
        {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Bus Price (in cents)']) !!}
    </div>
    {!! Form::submit('Create Bus', ['class' => 'form-control btn btn-dark']) !!}
    {!! Form::close() !!}
</div>--}}