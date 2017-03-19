<?php

namespace App\Controller;

require('/var/www/sg-course1.dev/src/Persistence/NewsService.php');
require('/var/www/sg-course1.dev/src/Logger/MyLogger.php');

use \PDO;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Persistence\Service as Service;
use App\Persistence\Entity as Entity;
use App\Logger as Logger;

class News
{
    private $NewsService;
    private $log;

    public function __construct(){
      $this->NewsService = new Service\NewsService();
      $this->log = new Logger\MyLogger();
    }

    public function editFeed($request, $response)
    {
      $logged = $request->getSession()->get('logged');
      if ($logged) {
          $id = $request->request->get('id');
          $item = $this->NewsService->findById($id);
          $response->setContent(include '../templates/edit-feed.tpl.php');
      } else {
          $response->setStatusCode('403');
          $response->setContent('Forbidden.');
      }
      return $response;
    }

    public function saveEditFeed($request)
    {
        $id = $request->request->get('id');
        $title = $request->request->get('title');
        $link = $request->request->get('link');
        $description = $request->request->get('description');
        $source = $request->request->get('source');
        $pub_date = date("Y-m-d H:i:s");
        $upd = new Entity\NewsEntity($id, $title, $link, $description, $source, $pub_date);
        $this->NewsService->update($upd);
        $this->log->info("Updated new news with id $id");
        return new RedirectResponse('/');
    }

    public function deleteFeed($request)
    {
        $id = $request->request->get('id');
        $this->NewsService->delete($id);
        $this->log->info("Deleted news with id $id");
        return new RedirectResponse('/');
    }

    public function createFeedForm($request, $response)
    {
      $logged = $request->getSession()->get('logged');
      if ($logged) {
          $response->setContent(include '../templates/add-feed.tpl.php');
      } else {
          $response->setStatusCode('403');
          $response->setContent('Forbidden.');
      }
      return $response;
    }

    public function createFeed($request, $response)
    {
      $logged = $request->getSession()->get('logged');
      if ($logged) {
          $id = $request->request->get('id');
          $title = $request->request->get('title');
          $link = $request->request->get('link');
          $description = $request->request->get('description');
          $source = $request->request->get('source');
          $pub_date = date("Y-m-d H:i:s");
          $upd = new Entity\NewsEntity($id, $title, $link, $description, $source, $pub_date);
          $this->NewsService->create($upd);
          $this->log->info("Created new news with id  $id");
      } else {
          $response->setStatusCode('403');
          $response->setContent('Forbidden.');
      }
      return new RedirectResponse('/');
    }

}
