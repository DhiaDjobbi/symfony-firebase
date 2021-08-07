<?php

namespace App\Service;

use Kreait\Firebase\Database;


class UserService
{

    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function findAll(): array
    {
        return $this->database->getReference('User')->getValue();
    }


    public function new($user)
    {
        $newKey = $this->database->getReference('User')->push()->getKey();
        $this->database->getReference('User/' . $newKey . "/")->set($user);
    }

    public function edit($key,$newuser)
    {
        $this->database->getReference('User/' . $key . "/")->set($newuser);
    }


    public function findByEmail($username): array
    {
        $userTable = $this->database->getReference('User');
        $user = $userTable
            ->orderByChild("email")
            ->limitToFirst(1)
            ->equalTo($username)
            ->getSnapshot()
            ->getValue();
        return $user;
    }

    public function findByEmailLike($username)
    {
        $userTable = $this->database->getReference('User');
        $user = $userTable
            ->orderByChild("email")
            ->startAt($username)  
            ->endAt($username."\uf8ff")
            ->getSnapshot()
            ->getValue();
        return $user;
    }

    public function remove($key)
    {
        $this->database->getReference('User/' . $key)->remove();
    }
}
