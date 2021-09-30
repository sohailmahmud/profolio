<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function follow($id){
      $followCheck = Follower::query()->where([
          ['follower_id',Auth::id()],
          ['following_id',$id],
      ])->first();
      if(is_null($followCheck)){
          $follow = new Follower();
          $follow->follower_id = Auth::id();
          $follow->following_id = $id;
          $follow->save();
          Session::flash('success', 'You have followed successfully!');
          return redirect()->route('front.user.view');
      }
      else{
          return redirect()->route('front.user.view');
      }
    }

    public function follower(){
      $data['users'] = [];
      $followerListIds = Follower::query()->where('following_id',Auth::id())->pluck('follower_id');
      if(count($followerListIds) > 0){
          $data['users'] = User::whereIn('id',$followerListIds)->paginate(10);
      }
      return view('user.follower.index',$data);
    }

    public function following()
    {
        $data['users'] = [];
        $followingListIds = Follower::query()->where('follower_id', Auth::id())->pluck('following_id');
        if (count($followingListIds) > 0) {
            $data['users'] = User::whereIn('id',$followingListIds)->paginate(10);
        }
        return view('user.following.index', $data);
    }

    public function unfollow($id){
        $followCheck = Follower::query()
        ->where([
            ['follower_id',Auth::id()],
            ['following_id',$id],
        ])->first();
        if(!is_null($followCheck)){
           $followCheck->delete();
           Session::flash('success', 'You have unfollowed successfully!');
           return redirect()->back();
        }else{
            Session::flash('warning', 'You cannot unfollow the user!');
            return redirect()->back();
        }
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
