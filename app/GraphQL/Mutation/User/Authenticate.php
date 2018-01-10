<?php
namespace App\GraphQL\Mutation\User;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Xpromx\GraphQL\Definition\Type;
use App\Models\User;

class Authenticate extends Mutation
{
    protected $attributes = [
        'name' => 'Authenticate',
        'description' => 'Get the session token passing email and password'
    ];

    public function type()
    {
        return Type::type('User');
    }

    public function args()
    {
        return [

            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email', 'exists:users,email'],
            ],

            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'min:4'],
            ],
            
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = User::where('email', $args['email'])->first();

        if ( app('hash')->check( $args['password'] , $user->password) )
        {
            return $user;
        }
        
        throw new \Exception('Email or Password incorrect.');
    }

}