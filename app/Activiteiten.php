<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activiteiten extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Takken_activiteiten';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
}
