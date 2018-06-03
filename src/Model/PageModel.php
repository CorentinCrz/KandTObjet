<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/06/2018
 * Time: 18:16
 */

namespace Model;

use Helper\PdoConnexion;

/**
 * Class PageModel
 * @package Model
 */
class PageModel
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * PageModel constructor.
     */
    public function __construct()
    {
        $this->pdo = PdoConnexion::get();
    }
    public function findAll(): ?array
    {
        $sql = "SELECT 
  `id`, 
  `slug` 
FROM 
  `page`
;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        PdoConnexion::errorHandler($stmt);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ([] === $data) {
            return null;
        }
        return $data;
    }
}