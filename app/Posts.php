<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    // protected $primaryKey = 'id_post';

    protected $fillable = ['title', 'description', 'content', 'image', 'id_cat'];

    public function category()
    {
        return $this->hasOne('App\Category', 'id_cat', 'id_cat');
    }
}
