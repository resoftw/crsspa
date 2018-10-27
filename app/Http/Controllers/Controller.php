<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getMainMenu(Request $req)
    {
        $id=$req->get('p');
        $mnu=[];
        $mnu = [
            ["icon" => 'contacts', "text" => 'Contacts'],
            ["icon" => 'history', "text" => 'Frequently contacted'],
        ];
        if (!$id){
        }
        return response()->json(["menu"=>$mnu],200);
    }
}
