<?php
namespace App\GraphQL\Query;
use Xpromx\GraphQL\Query;
use Xpromx\GraphQL\Definition\Type;
class UserQuery extends Query
{
    protected $attributes = [
        'name' => __CLASS__,
    ];
    
    public function type()
	{
        return Type::type('User');
    }
    
}