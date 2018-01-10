<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Repository;

class UserProject extends Model
{
    use Repository;

    public $table = 'users_projects';
    
    /**
     * The connection type
     *
     * @var string
     */
    protected $connection = 'app';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

}
