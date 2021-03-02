<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function post()
    {
        return User::insertUser(json_decode(file_get_contents('php://input'), true));
    }

    public function get($id = null)
    {
        return User::selectUser($id);
    }

    public function put($id = null)
    {
        return User::updateUser(json_decode(file_get_contents('php://input'), true), $id);
    }

    public function delete($id = null)
    {
        return User::deleteUser($id);
    }
}
