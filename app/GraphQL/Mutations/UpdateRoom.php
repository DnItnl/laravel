<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\Room;
final readonly class UpdateRoom
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $room = Room::find($args['id']);

        if(isset($args['password'])){
            $room->password = $args['password'];
        }

        if(isset($args['name'])){
            $room->name = $args['name'];
        }

        if(isset($args['description'])){
            $room->description = $args['description'];
        }

        if(isset($args['host_id'])){
            $room->host_id = $args['host_id'];
        }


        $room->save();

        return $room;
    }
}
