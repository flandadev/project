@extends('layouts.master', ['title' => 'BusLines - Edit', 'isAdmin' => true])
@section('content')
    @php
        if (count($errors)) {
            dd($errors->toArray());
        }
    @endphp
    <div class="section fp center-container">
        <form id="create" method="post" action="/admin/bus/{{ $bus->id }}" class="admin-form">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="name">Bus Start:</label>
                <input type="text" value="{{ $bus->origin }}" name="origin" placeholder="Bus origin (ex: Madrid, Barcelona etc..)" class="form-control">
            </div>

            <div class="form-group">
                <label for="price">Bus Price:</label>
                <input type="number" value="{{ $bus->price }}" name="price" placeholder="in cents (ex: 999 => 9.99)" class="form-control">
            </div>

            <input type="submit" class="btn btn-info" value="Deploy">
        </form>
    </div>
@endsection