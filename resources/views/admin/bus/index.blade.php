@extends('layouts.master', ['title' => 'Bus Lines', 'isAdmin' => true])
@section('styles')
    {!! Html::style('/css/form.min.css') !!}
    {!! Html::style('/css/admin.min.css') !!}
@endsection
@section('content')
    <a href="/admin/bus/create">
        <button type="submit" class="new-button">
            <span class="fa fa-plus"></span>
        </button>
    </a>
    @if (count($lines))
        <div class="section fp scroll-lock-x">
            <div class="table">
                <table class="table table-bordered table-hover">
                    <thead>
                    <th> Origin </th>
                    <th> Price </th>
                    <th> </th>
                    </thead>
                    <tbdoy>
                        @foreach($lines as $line)
                            <tr>
                                <td> {{ $line['origin']  }} </td>
                                <td> {{ $line['price'] / 100  }} € </td>
                                <td>
                                    <a href="/admin/bus/{{ $line['id'] }}/edit" class="btn btn-warning"> Edit </a>
                                    {!! Form::open(['url' => '/admin/bus/' . $line['id'], 'method' => 'delete', 'class' => 'no-style']) !!}
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-danger" value="delete">
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbdoy>
                </table>
            </div>
        </div>
    @else
        <div class="section fp center-container">
            <div>
                <h3> No bus lines found </h3>
                <div style="text-align: center">
                    <a style="margin: 10px" class="btn btn-success" href="/admin/bus/create">Create new</a>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script type="text/javascript">
        $('form#delete').on('submit', function(e) {
            let send = confirm('[WARN] Are you sure???')
            return send;
        })
    </script>
@endsection
