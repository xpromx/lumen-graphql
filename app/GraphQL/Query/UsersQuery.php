<?php
namespace App\GraphQL\Query;
use Xpromx\GraphQL\Query;
use Xpromx\GraphQL\Definition\Type;
class UsersQuery extends Query
{
    protected $attributes = [
        'name' => __CLASS__
    ];
    public function type()
	{
        return Type::connection('User');
    }
    
}