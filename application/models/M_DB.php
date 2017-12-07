<?php
require_once 'application/dbconfig.php';

class M_DB
{
    private static $instance = null;

    public function __construct() {}

    public function __clone() {}

    public static function instance() //установили соединение с базой
    {
        if (self::$instance === null) {
            self::$instance = new PDO('sqlite:' . DB_NAME);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            if(filesize(DB_NAME)<=0) {

                try {

                    self::$instance->beginTransaction();

                    $sql = "CREATE TABLE users(
                    u_id INTEGER PRIMARY KEY AUTOINCREMENT,
                    u_login TEXT UNIQUE,
                    u_password TEXT,
                    u_day INTEGER,
                    u_mounth INTEGER,
                    u_year INTEGER,
                    u_count INTEGER 
                    )";
                    self::$instance->exec($sql);

                    self::$instance->commit();
                } catch (PDOException $e) {

                    self::$instance->rollBack();
                    echo $e->getMessage();
                    exit;
                }
            }
        }

        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array([self::instance(), $method], $args);
    }

    public static function run($sql, $args = [])
    {
        try {
            $stmt = self::instance()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        } catch (PDOException $e) {
            file_put_contents('log.txt', date('Y-m-d h:i:s', time()) . "/ " . $e->getMessage() . "\n", FILE_APPEND);
            return false;
        }

    }
}