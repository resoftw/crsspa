<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Silber\Bouncer\Database\Role;
use Bouncer;
class UserController extends Controller
{
    public function list(Request $req)
    {
        $rpp = $req->get('per_page');
        if ($rpp == '-1') $rpp = 1000;
        $q = $req->get('q');
        $sort = $req->get('sort');
        $desc = $req->get('desc');
//        foreach(auth()->user()->roles() as $r){
//            print_r($r);
//        }
        return User::with('roles')->search($q)->sort($sort, $desc)->paginate($rpp);
    }

    public function getroles(Request $req)
    {
        return Role::all();
    }

    public function store(Request $req)
    {
        $dat=$req->only(['username','name','email']);
        $dat['password']=password_hash($req->get('password'),PASSWORD_BCRYPT);
        $dat['remember_token'] = str_random(10);
        $rols=$req->get('roles');
        $u=User::create($dat);
        Bouncer::sync($u)->roles($rols);
        $u->save();
        return $u;
    }

    public function update(Request $req)
    {
        $dat = $req->only(['id','username', 'name', 'email']);
        if ($req->get('password'))$dat['password'] = password_hash($req->get('password'), PASSWORD_BCRYPT);
        $rols=$req->get('roles');
        $u=User::findOrFail($dat['id']);
        $u->update($dat);
        Bouncer::sync($u)->roles($rols);
        $u->save();
        return $u;
    }

    public function destroy($id)
    {
        $u=User::findOrFail($id);
        $u->delete();
        return response()->json([],200);
    }

}
