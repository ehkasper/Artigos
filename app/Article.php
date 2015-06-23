<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body'];

    /**
     * Como queremos carregar sempre as tags, adicionamos no array $with
     * e elas estarão sempre à disposição
     */
    protected $with = ['tags'];

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
