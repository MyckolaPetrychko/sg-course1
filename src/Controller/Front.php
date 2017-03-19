<?php

namespace App\Controller;

use \PDO;
use Symfony\Component\HttpFoundation\RedirectResponse;
require('/var/www/sg-course1.dev/src/Persistence/NewsService.php');
use App\Persistence\Service as Service;

class Front
{
    private $NewsService;

    public function __construct(){
      $this->NewsService = new Service\NewsService();
    }
    public function getIndex($request, $response)
    {
        $items = $this->NewsService->findAll();
        $response->setContent(include '../templates/index.tpl.php');
        return $response;
    }

    public function getLogin($request, $response)
    {
        return $response->setContent('<form action="/login" method="POST">
            <input name="name">
            <input name="pass">
            <input type="submit">
        </form>');
    }

    public function postLogin($request)
    {
        $login = $request->request->get('name');
        $pass = $request->request->get('pass');

        $session = $request->getSession();
        if ($login == 'test' && $pass == '123') {
            $session->set('logged', true);
            return new RedirectResponse('/cabinet');
        }

        return new RedirectResponse('/login');
    }

    public function getLogout($request, $response)
    {
        $session = $request->getSession();
        $session->invalidate();

        return new RedirectResponse('/');
    }
}
