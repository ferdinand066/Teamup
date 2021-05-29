<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Team;
use App\Models\User;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Object_;

class TeamController extends Controller
{
    //
    public function index(){
        $position = Position::all();
        if (!request('team_name') && !request('position_name') && !request('creator_name')){
            $team = DB::table('teams')->paginate(8);
            return view('team.index', compact(['team', 'position']));
        }
        
        if(request('team_name')){
            $team = DB::table('teams')->
                where('name', 'like', '%' . request('team_name') . '%')->paginate(8);
            return view('team.index', compact(['team', 'position']));
        }

        if(request('position_name')){
            $temp = Position::where('name', 'like', '%' . request('position_name') . '%')->pluck('id')->toArray();

            if (count($temp) > 0){
                $team = DB::table('teams')->where('position_list', 'like', '%' . $temp[0] . '%');
                if (count($temp) > 1){
                    for($i = 1; $i < count($temp) - 1; $i++){
                        $team = $team->orWhere('position_list', 'like', '%' . $temp[$i] . '%');
                    }
                    $team = $team->orWhere('position_list', 'like', '%' . $temp[count($temp) - 1] . '%')->paginate(8);
                } else {
                    $team = DB::table('teams')->where('position_list', 'like', '%' . $temp[0] . '%')->paginate(8);
                }
                
                return view('team.index', compact(['team', 'position']));
            }
            
            $team = null;
            return view('team.index', compact(['team', 'position']));
            
        }

        if (request('creator_name')){
            $team = DB::table('teams')->join('users', 'users.id', '=', 'teams.creator_id')->
                select('teams.*')->where('users.name', 'like', '%' . request('creator_name') . '%')->paginate(8);
            return view('team.index', compact(['team', 'position']));
        }

        return redirect('/');
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

    public function make_detail(Request $request){
        
    }
}
