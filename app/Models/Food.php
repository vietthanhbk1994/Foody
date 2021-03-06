<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Food",
 *      required={name, image, category_id, content},
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
 *          property="content",
 *          description="content",
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
class Food extends Model
{
    use SoftDeletes;

    public $table = 'foods';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'image',
        'category_id',
        'content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'image' => 'string',
        'content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:100|unique:foods',
        'image' => 'required|image|max:1000',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required'
    ];
    public static $rulesUpdate = [
        'name' => 'required|max:100',
        'image' => 'image|max:1000',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required'
    ];
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id','id');
    }
    public function user() {
        return $this->belongsTo('App\Models\User', 'author','id');
    }
}
