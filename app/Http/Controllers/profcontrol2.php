<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\professor;
use App\rqust;
use App\subject;
use App\level;
use App\department;
use App\chapter;
class profcontrol2 extends Controller
{
    public function depart(level $lid){

        $idl = $lid->id;
        $rowd = DB::table('departments')
            ->where('level_id',$idl)
            ->get();
        $rowl2 = DB::table('levels')
            ->where('id',$idl)
            ->get();
        $y = session('profid');
        $row = DB::table('professors')
            ->where('id',$y)
            ->get();
        $imr = DB::table('images')
            ->where('professor_id',$y)
            ->get();
        $rowl = DB::table('levels')
            ->get();
        return view('as.pro-depart',compact('rowd','rowl','row','imr','rowl2'));
    }
    public function subject(department $did){
        $y = $did->id;
        $x = session('profid');
        $rows = DB::table('subjects')
            ->where('department_id',$y)
            ->where('professor_id',$x)
            ->get();
        $row = DB::table('professors')
            ->where('id',$x)
            ->get();
        $lid = session('id');
        $rowl2 = DB::table('levels')
            ->where('id',$lid)
            ->get();
        $rowl = DB::table('levels')
            ->get();
        $rowd = DB::table('departments')
            ->where('id',$y)
            ->get();
        $imr = DB::table('images')
            ->where('professor_id',$x)
            ->get();
        return view('as.pro-subject',compact('rows','row','rowl','rowd','imr','rowl2'));
    }
    public function delsub(subject $sid){
       DB::table('subjects')
            ->where('id',$sid->id)
            ->delete();
            return redirect()->back()->with('nulls','تم حذف ماده !!');
    }
    public function getsubject(subject $url){
        $sid = $url->id;
        session()->start();
        session()->put('subjectid',$sid);
        session()->save();
        $rowc = DB::table('chapters')
            ->where('subject_id',$sid)
            ->get();
        $rows = DB::table('subjects')
            ->where('id',$sid)
            ->get();
        $x = session('profid');
        $row = DB::table('professors')
            ->where('id',$x)
            ->get();
        $imr = DB::table('images')
            ->where('professor_id',$x)
            ->get();
        $rowl = DB::table('levels')
            ->get();
        return view('as.update-sub',compact('rowc','rows','row','imr','rowl'));
    }
    public function getch(){
        $x = session('profid');
        $row = DB::table('professors')
            ->where('id',$x)
            ->get();
        $rows = DB::table('subjects')
            ->get();
        $rowa = DB::table('answers')
            ->get();
        $imr = DB::table('images')
            ->where('professor_id',$x)
            ->get();
        $rowl = DB::table('levels')
            ->get();
        return view('as.insert-ch',compact('rows','row','rowa','imr','rowl'));
    }
    public function insch(Request $request){
        $name = $request->name;
        $sub = $request->subject;
        $before = filter_var($name, FILTER_SANITIZE_ENCODED, FILTER_FLAG_STRIP_HIGH);
        $after = filter_var($before,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if($after === $name){
        $t = new chapter();
        $t->name = $name;
        $t->subject_id=$sub;
        $t->save();
        return redirect()->back()->with('nulls','تم اضافه فصل!!');
        }
        else{
            return redirect()->back()->with('nulls','الاسم الذي ادخلته غير مفهوم !!');
        }
    }
    public function delch(chapter $chid){
        DB::table('chapters')
            ->where('id',$chid->id)
            ->delete();
        return redirect()->back()->with('nulls','تم حذف الفصل!!');
    }
    public function eee(){
        $eeid = 5;
        session()->start();
        session()->put('ee',$eeid);
        session()->save();

        return view('eee');
    }
    public function makea(professor $pid){
        DB::table('professors')
            ->where('id',$pid->id)
            ->update(['admin' => 1]);
        return redirect()->back()->with('nulls','تمت الترقيه بنجاح !!');
    }

    public function deleteprof(professor $pid){
        DB::table('professors')
            ->where('id',$pid->id)
            ->delete();
        return redirect()->back()->with('nulls','تم حذف المدرس !!');
    }
    public function upchna(Request $request){
        $name = $request->name;
        $sub = $request->subject;
        $before = filter_var($name, FILTER_SANITIZE_ENCODED, FILTER_FLAG_STRIP_HIGH);
        $after = filter_var($before,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if($after === $name){
        DB::table('chapters')
            ->where('subject_id',$sub)
            ->update(['name'=>$name]);
            return redirect()->back()->with('nulls','تم التعديل !!');
        }else{
            return redirect()->back()->with('nulls','الاسم الذي ادخلته غير مفهوم !!');

        }
    }
    public function rs(){
        $y = session('profid');
        $row = DB::table('professors')
            ->where('id',$y)
            ->get();
        $imr = DB::table('images')
            ->where('professor_id',$y)
            ->get();
        $rowl = DB::table('levels')
            ->get();
        $rows = DB::table('subjects')
            ->get();

        $rowstu = DB::table('students')
            ->get();

        $rowr = DB::table('results')
            ->get();
        $rowd = DB::table('departments')
            ->get();
        return view('as.results',compact('y','imr','row','rowl','rows','rowstu','rowr','rowd'));
    }
}
