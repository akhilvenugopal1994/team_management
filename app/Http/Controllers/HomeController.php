<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Team;
use App\Models\Member;
use App\Models\MemberTeam;

class HomeController extends Controller
{
    public function showTeams(Request $request)
    {
        $teams = Team::get();
        $members = MemberTeam::select('m.id','m.name','m.email','m.position')
                    ->where('team_id',$teams[0]->id)
                    ->leftjoin('members as m','m.id','=','member_id')
                    ->get();
        return view('list_team', compact('teams','members'));
    }
    
    public function getMembers(Request $request)
    {
        $members = MemberTeam::select('m.id','m.name','m.email','m.position')
                    ->where('team_id',$request->team_id)
                    ->leftjoin('members as m','m.id','=','member_id')
                    ->get();
        if(count($members)> 0){
            return response()->json([
                'status' => 'sucess',
                'message' => 'members found',
                'data' => $members,
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Sorry no member found',
                'data' => $members,
            ]);
        }
    }
    
    public function teamDetail($id)
    {
        $team = Team::find($id);
        $members = MemberTeam::select('member_id')->where('team_id',$id)->get();
        $team_members = MemberTeam::select('m.id','m.name','m.email','m.position')
                    ->where('team_id',$id)
                    ->leftjoin('members as m','m.id','=','member_id')
                    ->get();
        $other_members =  Member::whereNotIn('id',$members)->get();
        return view('team', compact('team_members','other_members','team'));
    }
    
    public function updateMembers(Request $request)
    {
        try{
            MemberTeam::where('team_id',$request->team_id)->delete();
            foreach($request->members as $member){
                $tm = new MemberTeam();
                $tm -> member_id = $member;
                $tm -> team_id = $request->team_id;
                $tm ->save();
            }
            return response()->json([
                'success' => 'Data updated successfully!'
            ]);
        }catch (\Exception $e) {
            return back()->with('error','somethingwrong');
        }
    }
    
}
