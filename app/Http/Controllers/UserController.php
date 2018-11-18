<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function list(Request $req)
    {
        $rpp = $req->get('per_page');
        if ($rpp == '-1') $rpp = 1000;
        $q = $req->get('q');
        $sort = $req->get('sort');
        $desc = $req->get('desc');
        foreach(auth()->user()->roles() as $r){
            print_r($r);
        }
        return User::with('roles')->search($q)->sort($sort, $desc)->paginate($rpp);
    }

    public function getroles(Request $req)
    {
        return Role::all();
    }

}
