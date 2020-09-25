@extends('master')

@section('content')
<h1 style="padding:30px;">
        Professor Requests
    </h1>
    <br>
    <br>
    <br>
    <hr>
    @if (count($rowr) == 0)
            <center>
                <hr>
                <p style="margin: auto;width:auto">No Results Yet !!</p>
                <img class="non-found" src="img/non/non1.png">
            </center>
    @else
    <table class="table table-striped table-hover col-12">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
        </tr>
        </thead>
        <tbody>
        
        @foreach($rowr as $x)
            <tr>
                <th scope="row">{{$x->id}}</th>
                <td>{{$x->name}}</td>
                <td>{{$x->phone}}</td>
                <td>
                    <form action="Accept" method="post">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$x->id}}" name="did">
                        <button class="btn btn-success" type="submit" style="padding: 5px">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{$x->id}}/removerequest">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        
        </tbody>
    </table>
    @endif
@stop
