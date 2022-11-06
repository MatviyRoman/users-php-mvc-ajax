<?php

class User
{
    public function getAll()
    {
        $sql   = 'SELECT a.*, b.name as role FROM users as a LEFT JOIN role as b ON a.role_id = b.id';

        return Database::query($sql);
    }

    public function getOne(int $user_id)
    {
        if (empty($user_id)) {
            return false;
        }
        $sql = 'SELECT a.*, b.name as role FROM users as a LEFT JOIN role as b ON a.role_id = b.id WHERE a.id = ' . $user_id . ' LIMIT 1';

        $info = Database::query($sql);

        $user  = $info['result'][0] ?? false;

        if (!empty($user->id)) {
            return $user;
        }

        return false;
    }

    public function save(int $user_id = NULL, $fname = false, $lname = false, $role_id = NULL)
    {
        if (!empty($user_id)) {
            $sql = "UPDATE users
            SET fname = '{$fname}', lname = '{$lname}', role_id = '{$role_id}'
            WHERE id = '{$user_id}'";

            return Database::query($sql);
        }

        $sql = "INSERT INTO users (id, fname, lname, role_id)
        VALUES (0, '{$fname}', '{$lname}', '{$role_id}')";

        return Database::query($sql);
    }

    public function delete(int $user_id)
    {
        if (!empty($user_id)) {
            $sql = 'DELETE FROM users WHERE id = ' . (int)$user_id;
            return Database::query($sql);
        }
        return false;
    }
}
