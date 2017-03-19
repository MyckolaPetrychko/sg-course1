<?php
  namespace App\Logger;

  use Monolog\Logger;
  use Monolog\Handler\StreamHandler;

  class MyLogger {
    private $monolog;

    public function __construct(){
      $this->monolog = new  Logger('log');
    }

    public function info($message) {
      $this->monolog->pushHandler(new StreamHandler('/var/www/sg-course1.dev/log/success.log', Logger::INFO));
      $this->monolog->info(date("Y-m-d H:i:s") . " - " . $message);
    }

    public function error($message) {
      $this->monolog->pushHandler(new StreamHandler('/var/www/sg-course1.dev/log/error.log', Logger::ERROR));
      $this->monolog->error(date("Y-m-d H:i:s") . " - " . $message);
    }
  }
