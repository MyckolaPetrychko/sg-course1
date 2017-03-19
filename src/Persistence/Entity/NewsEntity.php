<?php
  namespace App\Persistence\Entity;

  class NewsEntity{
    private $id;
    private $title;
    private $link;
    private $description;
    private $source;
    private $pub_data;

    public function __construct($id, $title, $link, $description, $source, $pub_data) {
      $this->id = $id;
      $this->title = $title;
      $this->link = $link;
      $this->description = $description;
      $this->source = $source;
      $this->pub_data = $pub_data;
    }

    public function getId(){
      return $this->id;
    }
    
    public function getTitle() {
      return $this->title;
    }

    public function getLink() {
      return $this->link;
    }

    public function getDescription() {
      return $this->description;
    }

    public function getSource() {
      return $this->source;
    }

    public function getPubData() {
      return $this->pub_data;
    }

    public function setTitle($title) {
      $this->title = $title;
    }

    public function setLink($link) {
      $this->link = $link;
    }

    public function setDescription($description) {
      $this->description = $description;
    }

    public function setSource($source) {
      $this->source = $source;
    }

    public function setPubData($pub_data) {
      $this->pub_data = $pub_data;
    }
  }
