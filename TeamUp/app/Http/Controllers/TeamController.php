<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    //
    public function index(){
        $team = DB::table('teams')->paginate(8);
        $position = Position::all();
        return view('team.index', compact(['team', 'position']));
    }

    public function search_leader(Request $request){
        $team = DB::table('teams')->where('creator_id', $request->id)->paginate(8);
        $position = Position::all();
        return view('team.index', compact(['team', 'position']));
    }

    public function insert(){
        $data = DB::table('positions')->get();
        
        if ($data == null) return redirect('/');
        return view('team.create', compact(['data']));
    }

    public function details(Request $request){
        $data = Team::where('id', $request->id)->first();
        if($data == null){
            $this->index();
        }
        $creator = User::where('id', $data->creator_id)->first();
        $position = Position::all();
        return view('team.detail', compact(['data', 'creator', 'position']));
    }

    public function make(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'short_description' => 'required|max:80',
            'full_description' => 'required',
            'salary' => 'required|between:1,100000',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'regex:/^[0-9]+$/'
        ]);

        $position_list = array();
        if(isset($request->position_list)){
            foreach($request->position_list as $key => $value){
                $data['id'] = $value;
                array_push($position_list, json_encode($data));
            }
        }

        sort($position_list);

        $address_data['street'] = $request->street;
        $address_data['city'] = $request->city;
        $address_data['state'] = $request->state;
        $address_data['postal_code'] = $request->postal_code;

        DB::table('teams')->insert([
            'id' => Str::uuid(),
            'creator_id' => Auth::user()->id,
            'name' => $request->name,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'salary' => $request->salary,
            'position_list' => $position_list == [] ? null : json_encode($position_list),
            'address' => json_encode($address_data)
        ]);
        return redirect('/');
    }
}
