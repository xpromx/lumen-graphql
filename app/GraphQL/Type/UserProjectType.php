<?php
namespace App\GraphQL\Type;
use Xpromx\GraphQL\Definition\Type;
use Xpromx\GraphQL\Type as BaseType;
class UserProjectType extends BaseType
{
    protected $attributes = [
        'name' => 'UserProject',
        'description' => 'A UserProject',
        'model' => \App\Models\UserProject::class
     ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
            ],
            
            'user' => Type::hasOne('User'),

            'project' => Type::hasOne('Project'),

            'created_at' => [
				'type' => Type::date(),
            ],
            
            'updated_at' => [
				'type' => Type::date(),
            ],
        ];
    }
}