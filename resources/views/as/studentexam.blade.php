<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <title>الامتحان</title>
    <link rel="icon" href="../images.jpeg" style="border-radius: 20px">

    <script src="../js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="../bootstrap-4.0.0/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/popper.js" type="text/javascript"></script>
    <link href="../css/exam.css" rel="stylesheet" type="text/css"/>
    <link href="../css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="../fontawesome-free-5.11.2-web/css/all.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<section style="height: 100px;">
    <div class="container">
        <div class="row d-flex flex-nowrap justify-content-center align-content-center flex-row" style="padding-top: 2vh;font-size: 20px">
            <div style="display: inline-flex;padding: 0px 5%">
                @foreach($s as $st)
                @foreach($rowl as $l)
                    @if($l->id == $st->level_id)
                الصف : {{$l->name}}
                        @endif
                    @endforeach
                <br>
                    @foreach($rowd as $d)
                        @if($d->id == $st->department_id)
                القسم : {{$d->name}}
                            @endif
                        @endforeach
                    @endforeach
            </div>
            <div style="display: inline-flex;padding: 0px 5%">
                <p><i>جامعة كفر الشيخ</i><br>
                    @foreach($rows as $sub)
                        @if($sub->id == $subject)
                           الماده : {{$sub->name}}
                            @endif
                        @endforeach
                    </p>
            </div>
            <div style="display: inline-flex;padding: 0px 5%">
                @foreach($rowt as $t)
                        @if($t->subject_id == $subject)
                        الوقت : {{$t->time}} ساعه<br>
                            @endif
                    @endforeach
                @foreach($rows as $ss)
                    @if($ss->id == $subject)
                        @foreach($rowp as $p)
                            @if($p->id == $ss->professor_id)
                                    المدرس : {{$p->name}}
                                @endif
                            @endforeach
                        @endif
                    @endforeach
            </div>
        </div>
    </div>
</section>
<br><hr>
<section>
    <div class="container">
        <div class="row" style="font-size: 20px">
            <table class="table table-dark col-11" style="margin: auto">
                <tr>
                    <th>اليوم</th>
                    <td><?php echo  date("l"); ?></td>
                </tr>
                <tr>
                    <th>الوقت المتبقي</th>
                    <td>
                        <div class="col-6" id="intervals">

                        </div>
                    </td>
                </tr>
                <tr>
                    @foreach($s as $st)
                        <th> اسم الطالب</th>
                        <td>{{$st->name}}</td>
                </tr>
                <tr>
                    <th>الرقم الجامعي</th>
                    <td>{{$st->id}}</td>
                    @endforeach
                </tr>
            </table>
            <form class="my_form col-12" action="saa" method="post" enctype="multipart/form-data" style="width: 100%">
                {{csrf_field()}}
            <ol type="1" class="col-12">
            @foreach($da2 as $tru)
                    @foreach($rowq as $q)
                        @if($q->id == $tru->question_id)
                                        <li class="col-12" style="margin: 15vh 0px;width: 100%">
                                        

                                            
                                                                            
                                            @php
                                            $a = substr($q->text , 1 );
                                            echo $a;
                                            @endphp
                                                
                                 
                                            @foreach($rowat as $at)
                                                @if($at->question_id == $q->id)
                                                @if($at->fileattache_id == 1)<br><br>
                                                <img src="../att/img/{{$at->name}}" class="imgfluid col-10" style="margin:15px;">
                                                    @endif
                                                @if($at->fileattache_id == 2)<br><br>

                                                <audio controls loop preload="auto" style="outline:0;">
                                                    <source src="../att/audio/{{$at->name}}" type="audio/mpeg">
                                                    <source src="../att/audio/{{$at->name}}" type="audio/ogg">
                                                   المتصفح الخاص بك لا يدعم ملفات الصوت !!
                                                </audio>
                                                    @endif
                                                @if($at->fileattache_id == 3)<br><br>
                                                <video controls>
                                                    <source src="../att/video/{{$at->name}}" type="video/mp4">
                                                    <source src="../att/video/{{$at->name}}" type="video/ogg">
                                                    المتصفح الخاص بك لا يدعم ملفات الفديو !!
                                                </video>
                                                    @endif
                                                @endif
                                            @endforeach
                                                <ol type="1" class="in col-12" style="padding-top: 4vh;width: 100%">
                                                    @if($q->typeq_id == 3)
                                                    @foreach($rowans as $a)
                                                        @if($a->question_id == $q->id)
                                                            <li style="display: inline;" class="col-6">
                                                                <input type="radio" name="answer{{$q->id}}" value="{{$q->id}}{{$a->text}}" id="{{$a->id}}" style="font-size: 20px;margin-right: 5px;margin-left: 10%"><label for="{{$a->id}}"> 
                                                                            
                                                                    @php
                                                                    $a = substr($a->text , 1 );
                                                                    echo $a;
                                                                    @endphp
                                                                        
                                                         </label>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                        @endif
                                                        @if($q->typeq_id == 1)
                                                    @foreach($rowans as $a)
                                                        @if($a->question_id == $q->id)
                                                            <li style="display: inline;" class="d-flex justify-content-center align-items-center row">
                                                                <input type="checkbox" name="answer{{$a->id}}" value="{{$q->id}}{{$a->text}}" id="{{$a->id}}" style="font-size: 20px;margin-right: 5px;margin-left: 10%"><label for="{{$a->id}}"> 
                                                                            
                                                                    @php
                                                                    $a = substr($a->text , 1 );
                                                                    echo $a;
                                                                    @endphp
                                                                        
                                                         </label>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                        @endif
                                                        @if($q->typeq_id == 2)
                                                            <li style="display: inline;">
                                                                <textarea class="form-control" cols="5" rows="10" name="{{$q->id}}" placeholder="ادخل اجابتك ..." value="{{old($q->id)}}"></textarea>
                                                            </li>
                                                        @endif
                                                </ol>
                                        </li><hr>
                        @endif
                    @endforeach
             @endforeach
            </ol>
            <center>
                <input class="btn btn-primary col-6" type="submit" value="انهاء الامتحان" style="margin-bottom:2vh">
</center>
            </form>
        </div>
    </div>
</section>
<script>

$(document).ready(function(){
   
   window.onbeforeunload = function(event)
   {
       return confirm("اعادة تحميل الصفحه سيؤدي لفقدان جميع اجاباتك !!");
   };
        
})
var seconds = {{$time}},
                secondPass,
                intervals = document.getElementById('intervals'),
                countDown = setInterval(function(){
                    "use strict";
                    secondPass();
                },1000);
            function secondPass(){
                "use strict";
                var hour = Math.floor(seconds / 3600);
                var min =  Math.floor((seconds % 3600)/60);
                var remSeconds = seconds % 60;
                var hours ;
                if(hour >= 12){
                    hours = hour - 12;
                }else{
                    hours = hour;
                }
                intervals.innerHTML = hours + ":" +  min + ":" + remSeconds;

                if(seconds > 0 ){

                    seconds = seconds - 1;
                }
                else{
                    clearInterval(countDown);
                   $('form.my_form').trigger('submit');
                }
            }
</script>
</body>
</html>
