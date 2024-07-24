<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\Room;
use App\Models\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
final readonly class CreateRoom
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        try {
            $host = User::findOrFail($args['input']['host_id']);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('Host user not found.');
        }

        $room = new Room();
        $room->name = $args['input']['name'];
        $room->description = $args['input']['description'] ?? null;
        $room->password = $args['input']['password'] ?? null;
        $room->host_id = $host->id;

        $room->save();

        return $room;
    }
}
