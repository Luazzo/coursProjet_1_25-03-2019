<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;
use App\Entity\UserInterface as User;

class UserRegisteredEvent extends Event
{
    /** @var User */
    protected $user;

    /** ... */
    public function __construct(User $user)
    {
       $this->user = $user;
    }

    /** ... */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /** ... */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}