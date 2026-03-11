<?php
// trouver le moyen de l'integrer a la class plus TARD!!!!
// $host = 'mysql-server';
// $dbname = 'csm_fight_team';
// $username = 'root';
// $password = 'root';

class Database
{
    // trouver le moyen de l'integrer a la class plus TARD!!!!
    private static $host = 'mysql-server';
    private static $dbname = 'csm_fight_team';
    private static $username = 'root';
    private static $password = 'root';
    private static ?PDO $instance = null;

    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = new PDO(
                'mysql:host='.self::$host.';dbname='.self::$dbname.';charset=utf8mb4',
                'root',
                'root',
                [
                    PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }
        return self::$instance;
    }
}
