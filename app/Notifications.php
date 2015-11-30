<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id
 */
class Notifications extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'Verhuring'];
}
