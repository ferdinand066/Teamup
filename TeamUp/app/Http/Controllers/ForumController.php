<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Team;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForumController extends Controller
{

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $now->setTimeZone(new DateTimeZone('Asia/Bangkok'));

        $ago = new DateTime($datetime, new DateTimeZone('Asia/Bangkok'));

        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


    public function update(Request $request){
        dd('here toooo');
    }

    public function delete(Request $request){
        
    }

    public function add(Request $request){
        if (Team::where('id', '=', $request->team_id)->exists()){
            $date = (new DateTime('now', new DateTimeZone('Asia/Bangkok')))->format('Y-m-d H:i:s');
            DB::table('forums')->insert([
                'id' => Str::uuid(),
                'user_id' => Auth::user()->id,
                'team_id' => $request->team_id,
                'content' => $request->content,
                'created_at' => $date
            ]);

            return response()->json(array(
                'status' => 'Successfully insert the comment',
                'name' => Auth::user()->name,
                'date' => 'Just Now'));
        }
        return redirect('/');
    }
}
