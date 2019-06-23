<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feeds extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feeds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['provider_id', 'title', 'link', 'description', 'pubDate', 'image'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}
