<?php
  namespace App\Persistence\RepositoryImpl;

  require('CrudRepository.php');
  require('DbConnection.php');
  use App\Persistence\Repository as Repositories;
  use App\Persistence\DbConnection as DbConnection;
  use App\Persistence\Entity as Entity;

  use \PDO;

  class NewsRepository implements Repositories\CrudRepository {

    private $dbConnection;

    public function __construct() {
        $this->dbConnection = new DbConnection\DbConnection();
    }

    public function findAll() {
      $sql = "SELECT * FROM news ORDER BY id DESC LIMIT 50";
      $db = $this->dbConnection->getPDO();
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $items;
    }
    public function findById($id) {
      $sql = "SELECT * FROM news WHERE id = $id";
      $db = $this->dbConnection->getPDO();
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $item = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $res = new Entity\NewsEntity($item[0]['id'], $item[0]['title'], $item[0]['link'], $item[0]['description'], $item[0]['source'], $item[0]['pub_data']);
      return $res;
    }

    public function findByTitle($title) {
      $sql = "SELECT * FROM news WHERE title='$title'";
      $db = $this->dbConnection->getPDO();
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $item = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $res = new Entity\NewsEntity($item[0]['id'], $item[0]['title'], $item[0]['link'], $item[0]['description'], $item[0]['source'], $item[0]['pub_data']);
      return $res;
    }

    public function update($entity) {
        $item = $this->findById($entity->getId());
        $id = $item->getId();
        $title = $entity->getTitle();
        $source = $entity->getSource();
        $description = $entity->getDescription();
        $pub_data = $entity->getPubData();
        $link = $entity->getLink();
        $item->setTitle($title);
        $item->setSource($source);
        $item->setDescription($description);
        $item->setPubData($pub_data);
        $item->setLink($link);

        $sql = "UPDATE news SET title='$title', source='$source',
                description='$description', link='$link', pub_data='$pub_data'
                WHERE id=$id";
        $db = $this->dbConnection->getPDO();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $item;
    }
    public function create($entity) {
      $title = $entity->getTitle();
      $source = $entity->getSource();
      $description = $entity->getDescription();
      $pub_data = $entity->getPubData();
      $link = $entity->getLink();

      $db = $this->dbConnection->getPDO();
      $sql = "INSERT IGNORE INTO news(title, link, description, source, pub_data) VALUES (?, ?, ?, ?, ?)";
      $stmt = $db->prepare($sql);
      $stmt->execute([
            $title,
            $link,
            $description,
            $source,
            $pub_data,
      ]);
      return $entity;
    }
    public function delete($id) {
      $sql = "DELETE FROM news WHERE id='$id'";
      $db = $this->dbConnection->getPDO();
      $stmt = $db->prepare($sql);
      $stmt->execute();
      if ($db->errorInfo){
        return false;
      }
      return true;
    }
  }
