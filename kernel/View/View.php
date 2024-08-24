<?php

namespace App\Kernel\View;

use App\Kernel\Exceptions\ViewNotFoundException;
use App\Kernel\Session\SessionInterface;

class View implements ViewInterface
{
    public function __construct(
        private SessionInterface $session
    ) {}

    public function page(string $name): void
    {

        $viewPath = APP_PATH."/views/pages/$name.php";

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException('Page not found');
        }

        extract($this->defaultData());

        include_once $viewPath;
    }

    public function component(string $name)
    {
        $component_path = APP_PATH."/views/Components/$name.php";

        if (! file_exists($component_path)) {
            echo "Component $name not found";
        }

        include_once $component_path;
    }

    private function defaultData(): array
    {
        return [
            'view' => $this,
            'session' => $this->session,
        ];
    }
}
