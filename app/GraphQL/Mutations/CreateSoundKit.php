<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\SoundKit;
use App\Models\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
final readonly class CreateSoundKit
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        try {
            $author = User::findOrFail($args['input']['authorId']);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('Author not found.');
        }

        $soundKit = new SoundKit();
        $soundKit->name = $args['input']['name'];
        $soundKit->icon = $args['input']['icon'] ?? 'default_sound_kit_icon';
        $soundKit->author_id = $author->id;

        $soundKit->save();

        return $soundKit;
    }
}
