<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Taggable;
use App\User;

class Article extends Model
{
    use Taggable;
    protected $fillable=['author_id','title','subtitle','content','cover','view_count'];
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopeSearch($query, $q)
    {
        if ($q) {
            return $query
                ->where('title', 'like', '%' . $q . '%')
                ->orWhere('subtitle', 'like', '%' . $q . '%')
                ->orWhere('content', 'like', '%' . $q . '%');
        }
    }

    public function scopeSort($query, $s, $d)
    {
        if ($s) {
            return $query->orderBy($s, $d == 'true' ? 'desc' : 'asc');
        }
    }


}
