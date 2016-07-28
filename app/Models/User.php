<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={username, email, avatar, password, is_admin},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="username",
 *          description="username",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="avatar",
 *          description="avatar",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password_confirmation",
 *          description="password_confirmation",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'username',
        'email',
        'avatar',
        'password',
        'password_confirmation',
        'is_admin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'username' => 'string',
        'email' => 'string',
        'avatar' => 'string',
        'password' => 'string',
        'password_confirmation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username' => 'required|max:100',
        'email' => 'required|max:100|email',
        'avatar' => 'required|max:1000|image',
        'password' => 'required|max:100|confirmed',
        'is_admin' => "required|in:1,2"
    ];
    public static $rulesUpdate = [
        'username' => 'required|max:100',
        'avatar' => 'max:1000|image',
        'password' => 'required|max:100|confirmed',
        'is_admin' => "required|in:1,2"
    ];
    public function users() {
        return $this->hasMany('App\Models\Food');
    }
}
