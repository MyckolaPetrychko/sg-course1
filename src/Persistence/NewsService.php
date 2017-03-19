<?php
    namespace App\Persistence\Service;

    require('NewsRepository.php');
    use App\Persistence\RepositoryImpl as Repository;

    class NewsService{
      private $repository;

      public function __construct(){
        $this->repository = new Repository\NewsRepository();
      }

      public function findAll() {
        return $this->repository->findAll();
      }

      public function findById($id) {
        return $this->repository->findById($id);
      }

      public function findByTitle($title) {
          return $this->repository->findByTitle($title);
      }

      public function update($entity) {
        return $this->repository->update($entity);
      }
      public function create($entity) {
        return $this->repository->create($entity);
      }
      public function delete($id) {
        $this->repository->delete($id);
      }
    }
