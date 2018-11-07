<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable =['survey_section_id','title'];
    public $timestamps=false;

    function section()
    {
        return $this->belongsTo('App\SurveySection','survey_section_id');
    }
}
