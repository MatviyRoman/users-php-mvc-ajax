<?php

class Database
{
    private static $host = 'localhost'; // host
    private static $db = 'tasks_test'; // db
    private static $user = 'root'; // user
    private static $pw = 'root'; // pass

    private static function connect()
    {
        $pdo = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db . ';charset=utf8', self::$user, self::$pw);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $pdo;
    }

    public static function query($query, $params = array())
    {
        $data  = [];
        $stmt = self::connect()->prepare($query);

        if ($stmt->execute($params)) {
            $data['status'] = 'success';
            $result = $stmt->fetchAll();
            if (!empty($result)) {
                $data['result'] = $result;
            }
        } else {
            $data['status'] = 'error';
        }

        return $data;
    }
}
