<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\User;
use App\Models\Room;
final readonly class DeleteRoom
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $room = Room::find($args['id']);
        $status = $room->delete();

        return [
            'status'=> $status,
            'message'=> 'Room deleted'
        ];
    }
}
