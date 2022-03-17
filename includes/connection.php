<?php

class Connection{

    static public $pdo;

    public function beConnected()
    {
        try
        {
            global $pdo;
            // $pdo = new PDO('mysql:dbname=qos-fixe;host=localhost', 'dbadmin', 'Demo123*');
            $pdo = new PDO('mysql:dbname=qos-fixe;host=localhost', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND =>
                'SET NAMES utf8'));
        }
        catch(PDOException $e)
        {
            die('Connection failed: '. $e->getMessage());
        }
    }
}

?>
