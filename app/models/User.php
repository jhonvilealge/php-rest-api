<?php

namespace App\Models;

use App\Models\Connection;

class User
{
    private static $table = 'users';

    public static function insertUser($data)
    {
        if (!isset($data['name']) || !isset($data['email']) || !isset($data['password'])) {
            http_response_code(400);
            return array('status' => 400, 'message' => 'Unable to create, missing or invalid field.', 'data' => []);
        }

        $db = new Connection();

        $user = $db->select('SELECT * FROM ' . self::$table . ' WHERE name = :name', [
            'name' => $data['name']
        ]);

        if ($user) {
            http_response_code(400);
            return array('status' => 400, 'message' => 'User already exists.', 'data' => []);
        }

        $id = $db->insert('INSERT INTO ' . self::$table . ' (name, email, password) VALUES (:name, :email, :password)', [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        $response = $db->select('SELECT * FROM ' . self::$table . ' WHERE id = :id', [
            'id' => $id
        ]);

        if ($response) {
            http_response_code(201);
            return array('status' => 201, 'message' => 'Successfully registered.', 'data' => $response);
        } else {
            http_response_code(500);
            throw new \Exception('Unable to create.', 500);
        }
    }

    public static function selectUser($id)
    {
        $db = new Connection();

        if ($id) {
            $response = $db->select('SELECT * FROM ' . self::$table . ' WHERE id = :id', [
                'id' => $id
            ]);
        } else {
            $response = $db->select('SELECT * FROM ' . self::$table);
        }

        if ($response) {
            http_response_code(200);
            return array('status' => 200, 'message' => 'Successfully fetched.', 'data' => $response);
        } else {
            http_response_code(404);
            throw new \Exception('Data not found.', 404);
        }
    }

    public static function updateUser($data, $id)
    {
        if (!isset($data['name']) || !isset($data['email']) || !isset($data['password'])) {
            http_response_code(400);
            return array('status' => 400, 'message' => 'Unable to update, missing or invalid field.', 'data' => []);
        }

        if (!$id) {
            http_response_code(400);
            return array('status' => 400, 'message' => 'Unable to update, missing or invalid :id parameter.', 'data' => []);
        }

        $db = new Connection();

        $user = $db->select('SELECT * FROM ' . self::$table . ' WHERE id = :id', [
            'id' => $id
        ]);

        if (!$user) {
            http_response_code(404);
            return array('status' => 404, 'message' => 'User not found.', 'data' => []);
        }

        $db->update('UPDATE ' . self::$table . ' SET name = :name, email = :email, password = :password WHERE id = :id', [
            'id' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        $response = $db->select('SELECT * FROM ' . self::$table . ' WHERE id = :id', [
            'id' => $id
        ]);

        if ($response) {
            http_response_code(200);
            return array('status' => 200, 'message' => 'Successfully updated.', 'data' => $response);
        } else {
            http_response_code(500);
            throw new \Exception('Unable to uptade.', 500);
        }
    }

    public static function deleteUser($id)
    {
        if (!$id) {
            http_response_code(400);
            return array('status' => 400, 'message' => 'Unable to delete, missing or invalid :id parameter.', 'data' => []);
        }

        $db = new Connection();

        $user = $db->select('SELECT * FROM ' . self::$table . ' WHERE id = :id', [
            'id' => $id
        ]);

        if (!$user) {
            http_response_code(404);
            return array('status' => 404, 'message' => 'User not found.', 'data' => []);
        }

        $db->delete('DELETE FROM ' . self::$table . ' WHERE id = :id', [
            'id' => $id
        ]);

        if ($user) {
            http_response_code(200);
            return array('status' => 200, 'message' => 'Successfully deleted.', 'data' => $user);
        } else {
            http_response_code(500);
            throw new \Exception('Unable to delete.', 500);
        }
    }
}
