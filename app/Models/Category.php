<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Category",
 *      required={name, image},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          description="image",
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
class Category extends Model {

    use SoftDeletes;

    public $table = 'categories';
    protected $dates = ['deleted_at'];
    public $fillable = [
        'name',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'image' => 'string'
    ];
    public static $rules = [
        'name' => 'required|max:100|unique:categories',
        'image' => 'required|max:1000|image'
    ];
    public static $rulesUpdate = [
        'name' => 'required|max:100',
        'image' => 'max:1000|image'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public function foods() {
        return $this->hasMany('App\Models\Food');
    }
}
