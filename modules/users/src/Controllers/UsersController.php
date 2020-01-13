<?php

namespace ErikFig\Framework\Users\Controllers;

use App\Controllers\AppController;
use ErikFig\Framework\Users\Models\User;

class UsersController extends AppController
{
    public function index()
    {
        return $this->twig->render('users/index.html', ['users' => User::all()]);
    }
}
