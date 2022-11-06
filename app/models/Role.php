<?php

class Role
{
    public function getAll()
    {
        $info  = Database::query('SELECT * FROM role');
        $result = $info['result'];
        return $result;
    }
}
