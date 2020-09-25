@extends('master')
@section('content')
                    <div class="col-12 side" style="margin-top: 7vh;height: auto;font-size: 18px;padding: 25px">
                        <p style="font-size: 23px">Requests</p>
                        <hr>
                        @if (count($rowrqs) == 0)
                            <center>
                                <p style="margin: auto;width:auto">No Rquests Yet !!</p>
                                <img class="non-found" src="img/non/non1.png">
                            </center>
                        @else
                            @foreach($rowrqs as $s)
                            Name : <span style="color:green;font-size: 16px">{{$s->name}}</span><br>
                            National ID : <span style="color:green;font-size: 16px">
                                @php
                                    $a = substr($s->Nationalid , 2);
                                    echo $a;
                                @endphp
               
                            
                            </span><br>
                                @foreach($rowd as $d)
                                    @if($d->id == $s->department_id)
                                    Department : <span style="color:green;font-size: 16px">{{$d->name}}</span><br>
                                    @endif
                                @endforeach
                                @foreach($rowl as $l)
                                    @if($l->id == $s->level_id)
                                    Level : <span style="color:green;font-size: 16px">{{$l->name}}</span>
                                    <a href="{{$s->id}}/removestudent"  style="float: right;margin-right: 5%">
                                        <button class="btn btn-danger">Deny</button>
                                    </a>
                                    <a href="{{$s->id}}/acceptstudent"  style="float: right;margin-right: 5%">
                                        <button class="btn btn-success">Accept</button>
                                    </a>
                                    <br><hr>
                                    
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </div>
@stop
