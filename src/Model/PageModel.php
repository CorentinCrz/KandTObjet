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

    /**
     * @return array|null
     */
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

    /**
     * @param string $slug
     * @return array|null
     */
    public function findBySlug(string $slug): ?array
    {
        $sql = "SELECT 
  `id`, 
  `slug`,
  `title`,
  `h1`,
  `p`,
  `span-class`,
  `span-text`,
  `img-alt`,
  `img-src`,
  `nav-title`
FROM 
  `page`
WHERE
  slug = :slug
;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":slug", $slug, \PDO::PARAM_STR);
        $stmt->execute();
        PdoConnexion::errorHandler($stmt);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ([] === $data) {
            return null;
        }
        return $data;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT 
  `id`, 
  `slug`,
  `title`,
  `h1`,
  `p`,
  `span-class`,
  `span-text`,
  `img-alt`,
  `img-src`,
  `nav-title`
FROM 
  `page`
WHERE
  id = :id
;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
        PdoConnexion::errorHandler($stmt);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ([] === $data) {
            return null;
        }
        return $data;
    }

    /**
     * @param array $data
     * @return int
     */
    public function addOne(array $data): int
    {
        $sql = "INSERT INTO `page`(
  `slug`,
  `title`,
  `h1`,
  `p`,
  `span-class`,
  `span-text`,
  `img-alt`,
  `img-src`,
  `nav-title`
) VALUES (
  :slug,
  :title,
  :h1,
  :p,
  :spanclass,
  :spantext,
  :imgalt,
  :imgsrc,
  :navtitle
)
;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":slug", htmlspecialchars($data['slug']));
        $stmt->bindValue(":title", htmlspecialchars($data['title']));
        $stmt->bindValue(":h1", htmlspecialchars($data['h1']));
        $stmt->bindValue(":p", htmlspecialchars($data['p']));
        $stmt->bindValue(":spanclass", htmlspecialchars($data['span-class']));
        $stmt->bindValue(":spantext", htmlspecialchars($data['span-text']));
        $stmt->bindValue(":imgalt", htmlspecialchars($data['img-alt']));
        $stmt->bindValue(":imgsrc", htmlspecialchars($data['img-src']));
        $stmt->bindValue(":navtitle", htmlspecialchars($data['nav-title']));
        $stmt->execute();
        PdoConnexion::errorHandler($stmt);
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * @param array $data
     */
    public function edit(array $data): void
    {
        $sql = "UPDATE
  `page`
SET
  `slug` = :slug,
  `title` = :title,
  `h1` = :h1,
  `p` = :p,
  `span-class` = :spanclass,
  `span-text` = :spantext,
  `img-alt` = :imgalt,
  `img-src` = :imgsrc,
  `nav-title` = :navtitle
WHERE
  `id` = :id
;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", htmlspecialchars($data['id']), \PDO::PARAM_INT);
        $stmt->bindValue(":slug", htmlspecialchars($data['slug']));
        $stmt->bindValue(":title", htmlspecialchars($data['title']));
        $stmt->bindValue(":h1", htmlspecialchars($data['h1']));
        $stmt->bindValue(":p", htmlspecialchars($data['p']));
        $stmt->bindValue(":spanclass", htmlspecialchars($data['span-class']));
        $stmt->bindValue(":spantext", htmlspecialchars($data['span-text']));
        $stmt->bindValue(":imgalt", htmlspecialchars($data['img-alt']));
        $stmt->bindValue(":imgsrc", htmlspecialchars($data['img-src']));
        $stmt->bindValue(":navtitle", htmlspecialchars($data['nav-title']));
        $stmt->execute();
        PdoConnexion::errorHandler($stmt);
    }

    /**
     * @param int $id
     */
    public function deleteOne(int $id): void
    {
        $sql = "DELETE FROM `page` WHERE `id` = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
        PdoConnexion::errorHandler($stmt);
    }
}