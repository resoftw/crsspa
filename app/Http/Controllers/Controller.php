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
        $mainmenu = [
            ["text" => "Home", "icon" => "home", "url" => "/"],
            ["text" => "Dashbard", "icon" => "dashboard", "url" => "/dashboard"],
            [
                "text" => "Information", "icon" => "live_help",
                "icon-alt"=>"keyboard_arrow_down",
                "model"=>true,
                "children" => [
                    ["text" => "Cara Pengaduan", "url" => "/help/cara"],
                    ["text" => "Event Promotion", "url" => "#"],
                    ["text" => "Products & Packaged", "url" => "#"],
                    ["text" => "List Distribution", "url" => "#", "icon" => "report"]
                ],
            ],
            [
                "text" => "Issues", "icon" => "report",
                "children" => [
                    ["text" => "Progress", "url" => "#"],
                    ["text" => "Kritik dan Saran", "url" => "#"],
                    ["text" => "Reporting", "url" => "#"],
                ],
            ],
            ["header" => "E-Ticketing"],
            ["text" => "Nomor Tiket", "icon" => "style", "url" => "#"],
            ["divider" => "true"],
            ["text" => "Kuesioner", "icon" => "star", "url" => "#"],
            ["divider" => "true"],
            [
                "text" => "Settings", "icon" => "settings",
                "children" => [
                    ["text" => "Products"],
                    ["text" => "Event Promotion"],
                    ["text" => "Distributor"],
                    ["text" => "Template"],
                    ["text" => "Users", "url" => "/users"],
                    ["text" => "Reports"],
                ],
            ],
        ];
        return response()->json(["menu"=>$mainmenu],200);
    }
}
