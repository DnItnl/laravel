<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\SoundKit;
use App\Models\Sound;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Http\UploadedFile;
final readonly class CreateSoundKit
{
    /** @param  array{}  $args */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->request->get('user');
        if (!$user) {
            throw new \Exception('User not authenticated');
        }


        $soundKit = SoundKit::create([
            'name' => $args['name'],
            'author_id' => $user['id'],
        ]);

        foreach ($args['sounds'] as $soundFile) {
            /** @var UploadedFile $soundFile */
            $path = $soundFile->store('sounds', 'public');

            Sound::create([
                'name' => $soundFile->getClientOriginalName(),
                'path' => $path,
                'sound_kit_id' => $soundKit->id,
            ]);
        }

        return $soundKit;
    }
}
