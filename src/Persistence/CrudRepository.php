<?php
  namespace App\Persistence\Repository;

  require('Entity/NewsEntity.php');
  use App\Persistence\Entity as Entity;

  interface CrudRepository{
    public function findAll();
    public function findById($id);
    public function findByTitle($title);
    public function update($entity);
    public function create($entity);
    public function delete($entity);
  }
