<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Http\Requests\StatusRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function all()
    {
        $members=new \stdClass();
        $members->Unclaimed=Member::where('status','Unclaimed')->get();
        $members->FirstContact=Member::where('status','FirstContact')->get();
        $members->PreparingWorkOffer=Member::where('status','PreparingWorkOffer')->get();
        $members->SendTherapist=Member::where('status','SendTherapist')->get();
        return response()->json([
            'status' => 'success',
            'data' => $members,
        ], 200);
    }
    public function create(MemberRequest $req)
    {
        $member=Member::create($req->validated());
        return response()->json([
            'status' => 'success',
            'data' => $member,
        ], 200);
    }


    public function editStatus(StatusRequest $req)
    {

         $member=Member::find($req->validated()['item']['id']);
         $member->update([
            'status'=>$req->validated()['type'],
         ]);
        return response()->json([
            'status' => 'success',
            'data' =>  $member,
        ], 200);
    }

    public function editMember($id,MemberRequest $req)
    {

         $member=Member::find($id);
         if($member){
            $data=$req->validated();
            $member->update($data);
         }
         else{
            return response()->json(['status' => 'fail to find id' ], 203);
         }

        return response()->json([
            'status' => 'success',
            'data' =>  $member,
        ], 200);
    }
    public function deleteMember($id)
    {

         $member=Member::find($id);
         if($member)
         $member->delete($member);
        else
        return response()->json([
            'status' => 'fail find member',
            'data' => '201',
        ], 201);
        return response()->json([
            'status' => 'success',
            'data' => '',
        ], 200);
    }
}
