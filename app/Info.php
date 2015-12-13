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

    /**
     * Scope a query to only include the groups by uri segment.
     *
     * @param $query
     * @param $fragment, string, the uri fragment for the group
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetGroup($query, $fragment)
    {
        return $query->where('URI_fragment', $fragment);
    }
}
