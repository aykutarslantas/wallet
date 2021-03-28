<?php

namespace classWallet;
use database\query;

class User
{
    /**
     * @var mixed
     */
    public $id;

    static function find($id)
    {
        $users = new query();
        $userid = $users->getUser($id);
        $user = new User();
        $user->id=$userid['id'];

        return $user;
    }
}
