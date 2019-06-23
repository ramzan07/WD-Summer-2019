<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssChannel extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rss_channels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['channel_name', 'channel_source', 'channel_description', 'channel_image', 'last_attempt_date', 'last_update_date'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}
