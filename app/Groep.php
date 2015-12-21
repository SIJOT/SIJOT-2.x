<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groep extends Model
{
    /**
     * The table that is used by the model.
     *
     * @var string
     */
    protected $table = 'user_groups';


    protected $fillable = ['group'];

    /**
     * Get the users wwhat are in this group.
     */
    public function users()
    {
        $this->belongsToMany('App\user', 'pivot_user_groups');
    }

}
