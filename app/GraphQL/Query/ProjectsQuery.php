<?php
namespace App\GraphQL\Query;
use Xpromx\GraphQL\Query;
use Xpromx\GraphQL\Definition\Type;
class ProjectsQuery extends Query
{
    protected $attributes = [
        'name' => __CLASS__
    ];
    public function type()
	{
        return Type::connection('Project');
    }
    
}