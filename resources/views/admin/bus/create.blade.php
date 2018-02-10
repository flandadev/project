@extends('layouts.master', ['title' => 'BusLines - New', 'isAdmin' => true])
@section('content')
    @php
        if (count($errors)) {
            dd($errors->toArray());
        }
    @endphp
    <div class="section fp center-container">
        <form id="create" method="post" action="/admin/bus" class="admin-form">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Bus Start:</label>
                <input type="text" name="origin" placeholder="Bus origin (ex: Madrid, Barcelona etc..)" class="form-control">
            </div>

            <div class="form-group">
                <label for="price">Bus Price:</label>
                <input type="number" name="price" placeholder="in cents (ex: 999 => 9.99)" class="form-control">
            </div>

            <input type="submit" class="btn btn-info" value="Deploy">
        </form>
    </div>
@endsection