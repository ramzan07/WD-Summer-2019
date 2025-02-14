<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'providers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['provider_name', 'feed_source', 'channel_description', 'channel_image', 'last_attempt_date', 'last_update_date'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}
