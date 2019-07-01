<?php

namespace Controller;


use Core\JsonResponse;
use Model\User;
use Core\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction() {
        (new JsonResponse())->redirect('/user');
    }

    public function listAction() {
        $response = [
            'users' => User::getAll()
        ];
        return new JsonResponse($response);
    }

    public function viewAction($id) {
        $response = [
            'user' => User::getById($id)
        ];
        return (new JsonResponse($response))->send();
    }
}