<?php
namespace App\GraphQL\Mutation\User;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Xpromx\GraphQL\Definition\Type;
use App\Models\User;

class CreateUser extends Mutation
{
    protected $attributes = [
        'name' => __CLASS__,
        'description' => ''
    ];
    public function type()
    {
        return Type::type('User');
    }
    public function args()
    {
        return [
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => [],
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        // if user already exists return the user
        $user = User::where('email', $args['email'])->first();
        if ( $user )
        {
            return $user;
        }
        // store the user and return
        $user = User::create([
            'first_name' => $args['first_name'],
            'last_name' => $args['last_name'],
            'email' => $args['email'],
            'password' => app('hash')->make( $args['password'] ),
            'token' => str_random(60)
        ]);

        return $user;
    }
    
}