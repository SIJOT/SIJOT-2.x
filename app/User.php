<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * MySQL Database columns.
 *
 * @property string password
 * @property string name
 * @property string email
 * @property string role
 * @property int blocked
 * @property mixed id
 */
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
    protected $hidden = ['password', 'remember_token'];

    /**
     * Set the permission relation.
     */
    public function permission()
    {
        return $this->hasOne('App\Permission', 'user_id', 'id');
    }

    public function notification()
    {
        return $this->hasOne('App\Notifications', 'user_id', 'id');
    }

    /**
     * Get the groups of the user.
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }
}
