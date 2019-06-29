<?php

namespace App\Controller;


use App\Model\User;
use Core\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction() {
        $response = [
            'users' => User::getAll()
        ];
        return $this->jsonResponse($response);
    }

    public function viewAction($id) {
        return $this->jsonResponse([
            'user' => User::getById($id)
        ]);
    }
}