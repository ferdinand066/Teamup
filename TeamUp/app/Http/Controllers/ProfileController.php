<?php

namespace App\Http\Controllers;

use App\Rules\YearToValidation;
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
        $this->validate($request, [
            'picture-insert' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'name' => 'required',
            'balance' => 'required|integer',
            'year-from.*' => 'integer|between:1900,' . date("Y"),
            'year-to.*' => [new YearToValidation($request->{"year-from"}, $request->{"year-to"})],
            'experience.*' => 'required',
            'phone' => 'required|regex:/^[0-9]+$/'
        ]);


        $new_name = "";
        if(isset($request->{ 'picture-insert' })){
            $image = $request->file('picture-insert');
            $new_name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/profile'), $new_name);
        }

        $user = DB::table('users')->where('id', $id)->first();
        if ($user->{'picture_path'} != null){
            $filename = public_path() . '\\images\\profile\\' . $user->{'picture_path'};
            unlink($filename);
        }

        $data_list = array();
        if(isset($request->experience)){
            foreach($request->experience as $key => $value){
                if(isset($request->{ "year-from"}[$key]) 
                    && isset($request->{ "year-to" }[$key])){
                    $data['year-from'] = $request->{ "year-from"}[$key];
                    $data['year-to'] = $request->{ "year-to" }[$key] == 'Now' ? date('Y') : $request->{ "year-to" }[$key];
                    $data['experience'] = $value;
                    array_push($data_list, json_encode($data));
                }
            }
        }

        sort($data_list);

        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'balance' => $request->balance,
            'phone' => $request->phone,
            'experience' => (($data_list == []) ? null : json_encode($data_list)),
            'picture_path' => ($request->{'picture-insert'} == null) ? null : $new_name
        ]);
        return redirect('/');
    }
}
