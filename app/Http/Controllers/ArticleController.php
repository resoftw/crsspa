<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    public function list(Request $req)
    {
        $rpp = $req->get('per_page');
        if ($rpp == '-1') $rpp = 1000;
        $q = $req->get('q');
        $sort = $req->get('sort');
        $desc = $req->get('desc');
        return ArticleResource::collection(Article::search($q)->sort($sort, $desc)->paginate($rpp));
    }
}
