<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class FollowController extends Controller
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
    public function store(User $user)
    {
    Auth::user()->followings()->attach($user->id);
    return redirect()->back();
    }

    // 🔽 編集
    public function destroy(User $user)
    {
    Auth::user()->followings()->detach($user->id);
    return redirect()->back();
    }

    public function show($id)
    {
    // ターゲットユーザのデータ
    $user = User::find($id);
    // ターゲットユーザのフォロワー一覧
    $followers = $user->followers;
    // ターゲットユーザのフォローしている人一覧
    $followings  = $user->followings;

    return view('user.show', compact('user', 'followers', 'followings'));
    }
}
