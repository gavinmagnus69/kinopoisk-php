<?php

namespace App\Kernel\Router;

use App\Kernel\Http\Redirect;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    private ViewInterface $view;

    private RequestInterface $request;

    private RedirectInterface $redirect;

    private SessionInterface $session;

    public function __construct(ViewInterface $view, RequestInterface $request,
        RedirectInterface $redirect, SessionInterface $session)
    {
        $this->request = $request;
        $this->view = $view;
        $this->redirect = $redirect;
        $this->session = $session;
        $this->initRoutes();

    }

    private function initRoutes()
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }

    }

    public function dispatch(string $uri, string $method): void
    {
        //returns function
        $route = $this->findRoute($uri, $method);

        if (! $route) {
            $this->notFound();

            return;
        }

        if (is_array($route->getAction())) {

            [$controller, $action] = $route->getAction();
            // dd($controller, $action);
            $controller = new $controller;
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);

            call_user_func([$controller, $action]);

        } else {
            call_user_func($route->getAction());
        }

    }

    private function notFound()
    {
        echo '404 | not found';
        exit;
    }

    private function findRoute(string $uri, string $method)
    {

        if (! isset($this->routes[$method][$uri])) {
            return false;
        }

        $tmp = $this->routes[$method][$uri];

        // $tmp();
        return $this->routes[$method][$uri];
    }

    private function getRoutes(): array
    {
        return require_once APP_PATH.'/config/routes.php';
    }
}
