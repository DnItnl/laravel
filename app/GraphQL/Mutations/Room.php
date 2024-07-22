<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

final readonly class Room
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $room->$args['name'];
        $room->$args['host_id'];
        $room->$args['description'];
        $room->$args['password'];
        $room->save();

        return $room;
    }
}
