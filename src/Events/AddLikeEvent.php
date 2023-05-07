<?php

namespace App\Events;

use App\Entity\Like;
use Symfony\Contracts\EventDispatcher\Event;

class AddLikeEvent extends Event
{
    const ADD_LIKE_EVENT = 'like.add';
    public function __construct(private Like $like){}
    public function getNotification(): Like{
        return $this->like;
    }

}