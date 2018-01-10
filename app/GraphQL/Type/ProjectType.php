<?php
namespace App\GraphQL\Type;
use Xpromx\GraphQL\Definition\Type;
use Xpromx\GraphQL\Type as BaseType;
class ProjectType extends BaseType
{
    protected $attributes = [
        'name' => 'Project',
        'description' => 'A Project',
        'model' => \App\Models\Project::class
     ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
            ],

            'user' => Type::hasOne('User'),

            'name' => [
                'type' => Type::string(),
            ],

            'slug' => [
				'type' => Type::string(),
            ],
            
            'website' => [
				'type' => Type::string(),
            ],

            'color' => [
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