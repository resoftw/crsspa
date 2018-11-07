<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\SurveySection;
use App\Question;

class SurveyController extends Controller
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

    // array ([descending] => false [page] => 1
    //     [rowsPerPage] => 5
    //     [sortBy] => id
    //     [totalItems] => 0)

    public function list(Request $req)
    {
        $rpp=$req->get('per_page');
        if ($rpp=='-1')$rpp=1000;
        $q=$req->get('q');
        $sort=$req->get('sort');
        $desc=$req->get('desc');
        return Survey::with('sections')->search($q)->sort($sort,$desc)->paginate($rpp);
    }

/*
        {
        "j" :"Kuesioner Pertama" ,
        "d" :"Coba-coba bikin quesioner" ,
        "f" :"06-11-2018" ,
        "t" :"06-11-2018" ,
        "g" : [{
            "t" :"Grup pertanyaan 1" ,
            "d" :"lorem ipsum dolor" ,
            "q" : [{
                "t" :"apakah 1?" ,
                "a" : true
            }, {
                "t" :"apakah 2?" ,
                "a" : true
            }
            ]
            }, 
            {
            "t" :"Grup 2" ,
                "q" : [{
                "t" :"apakah 3?" ,
                "a" : true
            }
            ],
                "d" : "Grup lorem 2"
        }
        ]
    }
*/
    public function add(Request $req)
    {
        $judul=$req->get('j');
        $desc=$req->get('d');
        $from=$req->get('f');
        $to=$req->get('t');
        $grps=$req->get('g');
        $srv=Survey::create([
            "name"=>$judul,
            "description"=>$desc,
            "created_by"=>1,
            "start"=>$from,
            "end"=>$to,
        ]);
        foreach($grps as $g)
        {
            $ss=SurveySection::create([
                "title"=>$g['t'],
                "description"=>$g['d'],
                "survey_id"=>$srv->id,
            ]);
            foreach($g['q'] as $q)
            {
                $qq=Question::create([
                    "survey_section_id"=>$ss->id,
                    "title"=>$q['t'],
                ]);
            }
        }
        //print_r($req->all());
        return $srv;
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
