<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable=['name','description','start','end','created_by'];

    public function sections(){
        return $this->hasMany('App\SurveySection');
    }
    public function scopeSearch($query,$q){
        if($q){
            return $query->where('name','like','%'.$q.'%')->orWhere('description','like','%'.$q.'%');
        }
    }

    public function scopeSort($query,$s,$d)
    {
        if($s){
            return $query->orderBy($s,$d=='true'?'desc':'asc');
        }
    }
}
