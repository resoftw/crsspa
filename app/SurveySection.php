<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveySection extends Model
{
    protected $fillable =['survey_id','title','subtitle'];
    public $timestamps=false;

    function survey()
    {
        return $this->belongsTo('App\Survey');
    }

    function questions()
    {
        return $this->hasMany('App\Questions','survey_section_id');
    }
}
