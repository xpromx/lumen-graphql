<?php
namespace App\GraphQL\Query;
use Xpromx\GraphQL\Query;
use Xpromx\GraphQL\Definition\Type;
class ProjectQuery extends Query
{
    protected $attributes = [
        'name' => __CLASS__,
    ];
    
    public function type()
	{
        return Type::type('Project');
    }
    
}