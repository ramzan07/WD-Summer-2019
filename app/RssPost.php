<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssPost extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rss_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['channel_id', 'title', 'link', 'description', 'pubDate', 'image'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}
