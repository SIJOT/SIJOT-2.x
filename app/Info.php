<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed Title
 * @property mixed Sub_title
 * @property mixed Beschrijving
 */
class Info extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Takken_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['URI_fragment', 'Title', 'Sub_title', 'Beschrijving'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
}
