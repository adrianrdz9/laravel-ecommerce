<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::admins()->get();

        return view('admins.index', ['admins' => $admins]);

    }

    public function newAdmin(){
        $users = User::all();

        return view('admins.new', ['users' => $users]);
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
        $admin = User::find($id);

        if ($request->action == "remove_admin") {
            if ($admin->isMaster()) {
                return redirect('/admins');
            }else{
                $admin->isadmin = false;
                $admin->save();
                return redirect('/admins');;
            }
        }elseif ($request->action == "add_admin") {
            $admin->isadmin = true;
            $admin->save();
            return redirect('/admins/new');
        }
    }


}
