<?php

class M_Posts
{
    private static $instance;

    public static function Instance()
    {
        if (self::$instance == null)
            self::$instance = new M_Posts();

        return self::$instance;
    }

    /**
     * Проверка на совпадение пароля/логина в БД
     */
    public function signIn($login, $pass)
    {
        $sql= "SELECT u_login, u_password FROM users WHERE u_login = ?";
        $res = M_DB::run($sql,[$login])->fetch();
        return password_verify($pass, $res['u_password']);
    }

    /**
     * Внесение нового пользователя в базу
     */
    public function signUp($login, $password, $day, $mounth, $year, $count=0)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $sql= "INSERT INTO users (u_login, u_password, u_day, u_mounth, u_year, u_count) VALUES (?,?,?,?,?,?)";
        $stmt = M_DB::run($sql, [$login, $hash, $day, $mounth, $year, $count]);
        if(!$stmt)
            return false;
        return true;
    }

    /**
     * Выводим (полных лет) пользователя
     */
    public function getUserAge($date, $mounth, $year)
    {
        $newDate = new DateTime();
        $oldDate = new DateTime("$year-$mounth-$date");
        return  $newDate->diff($oldDate);
    }

    /**
     * Получаем значение счетчика
     */
    public function getCount($user) {
        $sql= "SELECT u_count FROM users WHERE u_login = ?";
        $count = M_DB::run($sql, [$user])->fetchColumn();
        return $count;
    }

    /**
     * Поюсуем счетчик
     */
    public function countPlus($user) {
        $sql= "UPDATE users SET u_count = u_count + 1 WHERE u_login = ?";
        $count = M_DB::run($sql, [$user]);
    }

    /**
     * Очистка строки (нужно подумать, как еще можно очистить)
     */
    public function clearStr($str) {
        return htmlspecialchars($str);
    }


}