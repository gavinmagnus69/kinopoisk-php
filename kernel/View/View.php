<?php
    namespace App\Kernel\View;

use Exception;

    class View{

        public function page(string $name): void {
            
            $viewPath = APP_PATH."/views/pages/$name.php";
            
            if(!file_exists($viewPath)){
                throw new Exception("Page not found");
            }
            
            extract([
                'view' => $this,
            ]);
            
            include_once $viewPath;
        }

        public function component(string $name){
            include_once APP_PATH."/views/Components/$name.php";
        }
    };




?>