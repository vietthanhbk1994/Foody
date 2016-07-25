<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username'=>'like',
        'email'=>'like',
        'is_admin'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
