<?php

require_once __DIR__.'/User.php';

class Comment
{
    private User $_user;
    private string $_message;

    public function __construct(User $user, string $message)
    {
        $this->_user = $user;
        $this->_message = $message;
    }

    public function getUser(): User
    {
        return $this->_user;
    }

    public function getMessage(): string
    {
        return $this->_message;
    }
}
