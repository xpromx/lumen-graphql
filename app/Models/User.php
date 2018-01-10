<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Support\Repository;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    use Repository;
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

    /**
    * The cast attributes for this model
    *
    * @var boolean
    */
    protected $casts = [ 
        'meta' => 'json'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Get all of the projects related
     *
     * @return Collection
     */
    public function projects()
    {
        return $this->belongsToMany( \App\Models\Project::class, 'users_projects' );
    }

    public function attachProject( $id )
    {
        $this->projects()->attach( $id, [
            'token' => str_random(60), 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

}
