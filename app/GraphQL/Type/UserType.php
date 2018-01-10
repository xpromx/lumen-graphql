<?php
namespace App\GraphQL\Type;
use Xpromx\GraphQL\Definition\Type;
use Xpromx\GraphQL\Type as BaseType;
class UserType extends BaseType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A User',
        'model' => \App\Models\User::class
     ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
            ],

            'projects' => Type::hasMany('Project'),
            
            'role' => [
				'type' => Type::string(),
            ],

            'first_name' => [
				'type' => Type::string(),
            ],

            'last_name' => [
				'type' => Type::string(),
            ],
            
            'email' => [
				'type' => Type::string(),
            ],

            'token' => [
				'type' => Type::string(),
            ],

            'meta' => [
				'type' => Type::meta(),
            ],

            'created_at' => [
				'type' => Type::date(),
            ],

            'updated_at' => [
				'type' => Type::date(),
            ],
        ];
    }
}