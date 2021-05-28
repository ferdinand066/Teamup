<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    //
    public function index(){
        $data = DB::table('positions')->get();
        
        if ($data == null) return redirect('/');
        return view('team.create', compact(['data']));
    }

    public function insert(Request $request){
        dd($request);
    }
}
