<?php
namespace App\GraphQL\Mutation\Project;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Xpromx\GraphQL\Definition\Type;
use Xpromx\GraphQL\Authorize;
use App\Models\Project;

class CreateProject extends Mutation
{
    use Authorize;

    protected $attributes = [
        'name' => __CLASS__,
        'description' => ''
    ];

    public function type()
    {
        return Type::type('Project');
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],

            'website' => [
                'name' => 'website',
                'type' => Type::string(),
            ],

            'color' => [
                'name' => 'color',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        // if user already exists return the user
        $slug = str_slug($args['name']);
        $project = Project::where('slug', $slug)->first();
        
        if ( $project )
        {
            $slug .= '-' . rand(100,1000);
        }
        
        // store the project and return
        $project = Project::create([
            'user_id' => auth()->id,
            'name' => $args['name'],
            'slug' => $slug,
            'website' => $args['website'] ?? '',
            'color' => $args['color'] ?? '',
            'token' => str_random(60)
        ]);

        auth()->attachProject( $project->id );

        $project->createDatabase();

        return $project;
    }
    
}