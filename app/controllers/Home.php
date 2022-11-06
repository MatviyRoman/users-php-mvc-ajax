<?php
class Home extends Controller
{
    public function index()
    {
        // init model User
        $user = $this->model('User');
        $users = $user->getAll() ?? false;

        // init model Role
        $roles = $this->model('Role');
        $roles = $roles->getAll() ?? false;

        $this->view('home/index', compact('users', 'roles'));
    }
}
