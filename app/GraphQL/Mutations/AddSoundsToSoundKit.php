<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\SoundKit;
use App\Models\Sound;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
final readonly class AddSoundsToSoundKit
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        try{
        $soundKit = SoundKit::findOrFail($args['soundKitId']);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('SoundKit not found.');
        }

        DB::transaction(function () use ($soundKit, $args) {
            foreach ($args['sounds'] as $soundData) {
                $sound = new Sound();
                $sound->icon = $soundData['icon'] ?? 'default_sound_icon';
                $sound->name = $soundData['name'];
                $sound->file_path = $soundData['file_path'];
                
                if (empty($sound->file_path)) {
                    throw new \Exception('file_path cannot be null or empty.');
                }

                $sound->sound_kit_id = $soundKit->id;
                $sound->save();
            }
        });
        return $soundKit->load('sounds');
    }
}
