<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use DB;
use App\Support\Repository;
use App\Models\UserProject;

class Project extends Model
{
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

    public function user()
    {
        return $this->belongsTo( \App\Models\User::class );
    }

    /**
     * Create a database & run migrations for this project
    *
    * @param Array $project_id
    * @return Boolean
    */
    public function createDatabase()
    { 

        // 1) create database
        $db = env('DB_DATABASE') . '_' . $this->id;
        DB::connection('app')->statement("CREATE DATABASE {$db}");
        // 2) connect to database
        $this->connectDatabase();

        // 3) migrate
        Artisan::call('migrate', ['--path' => 'database/migrations/project', 
                                    '--database' => 'project',
                                    '--force' => true]);

        // 4) create user
        $password = str_random(20);
        DB::connection('app')->statement("DROP USER '{$db}'@'localhost' ");
        DB::connection('app')->statement("CREATE USER '{$db}'@'localhost' IDENTIFIED BY '{$password}';");
        DB::connection('app')->statement("GRANT SELECT ON {$db}.* TO '{$db}'@'localhost';");

    }

    public function connectDatabase()
    {

        config(['database.connections.project' => [

                      'driver' => 'mysql',
                      'host' => env('DB_HOST', '127.0.0.1'),
                      'port' => env('DB_PORT', '3306'),
                      'database' => env('DB_DATABASE') . '_' . $this->id,
                      'username' => env('DB_USERNAME', 'forge'),
                      'password' => env('DB_PASSWORD', ''),
                      'unix_socket' => env('DB_SOCKET', ''),
                      'charset' => 'utf8mb4',
                      'collation' => 'utf8mb4_unicode_ci',
                      'prefix' => '',
                      'strict' => false,
                      'engine' => null,

                  ]]);                                                                 

      DB::reconnect('project');
      return true;
    }


    public function getTokenAttribute($value)
    {
        if( auth() )
        {
            $relation = UserProject::where('user_id', auth()->id)->where('project_id', $this->attributes['id'])->first();
            return $relation->token;
        }

        return $value;
    }

}
