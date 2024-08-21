<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\Session\Session;
use App\Kernel\View\View;

abstract class Controller
{
    private View $view;

    private Request $request;

    private Redirect $redirect;

    private Session $session;

    public function session(): Session
    {
        return $this->session;
    }

    public function setSession(Session $session): void
    {
        $this->session = $session;
    }

    public function setRequest(Request $req): void
    {
        $this->request = $req;
    }

    public function request()
    {
        return $this->request;
    }

    public function setView(View $view)
    {
        $this->view = $view;
    }

    public function setRedirect(Redirect $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $url): void
    {
        $this->redirect->to($url);
    }

    public function view(string $name)
    {
        $this->view->page($name);
    }
}
