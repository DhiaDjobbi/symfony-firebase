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

    public function findByEmail($username): array
    {
        $userTable = $this->database->getReference('User');
        $user=$userTable
        ->orderByChild("email")
        ->equalTo($username)
        ->getSnapshot()
        ->getValue();
        return $user;
    }

}
