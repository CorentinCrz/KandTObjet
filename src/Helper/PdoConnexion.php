<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/06/2018
 * Time: 18:17
 */

namespace Helper;


class PdoConnexion
{
    /**
     * @var
     */
    private static $pdo;

    /**
     * PdoConnexion constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return \PDO
     */
    public static function get()
    {
        if (\is_null(self::$pdo)) {
            try {
                self::$pdo = new \PDO('mysql:host=localhost;dbname=kandtG1', 'root', 'root');
                self::$pdo->exec("SET NAMES UTF8");
            } catch (\PDOException $exception) {
                die($exception->getMessage());
            }
        }

        return self::$pdo;
    }

    /**
     * @param \PDOStatement $stmt
     * @throws \Exception
     */
    public static function errorHandler(\PDOStatement $stmt): void
    {
        if ($stmt->errorCode() !== '00000') {
            throw new \Exception($stmt->errorInfo()[1]);
        }
    }
}