<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Avatar;
use Illuminate\Http\UploadedFile;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Storage;

final readonly class UploadAvatar
{
    /** @param  array{}  $args */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->request->get('user');
        if (!$user) {
            throw new \Exception('User not authenticated');
        }

        $currentAvatar = Avatar::where('user_id', $user['id'])->first();
        if ($currentAvatar && $currentAvatar->path) {
            Storage::disk('public')->delete($currentAvatar->path);
        }
    
        $path = $args['file']->store('avatars', 'public');
        $avatar = Avatar::updateOrCreate(
            ['user_id' => $user['id']],
            ['path' => $path]
        );
    
        return $avatar;
    }
}
