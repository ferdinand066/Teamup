<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index($id){
        $data = DB::table('users')->where('id', $id)->first();
        
        if ($data == null) return redirect('/');
        return view('profile.index', compact(['data']));
    }

    public function update(Request $request, $id){
        $data_list = array();
        foreach($request->all() as $key => $value){
            $exp_key = explode('-', $key);
            if ($exp_key[0] == 'experience'){
                if(isset($_POST['year-from-' . $exp_key[1]]) 
                    && isset($_POST['year-to-' . $exp_key[1]])){
                    $data['year-from'] = $_POST['year-from-' . $exp_key[1]];
                    $data['year-to'] = $_POST['year-to-' . $exp_key[1]];
                    $data['experience'] = $value;
                    array_push($data_list, json_encode($data));
                }
            }
        }

        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'balance' => $request->balance,
            'experience' => (($data_list == []) ? null : json_encode($data_list))
        ]);
        return redirect('/');
    }
}
