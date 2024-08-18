<?php
    namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\View\View;

    abstract class Controller{

        private View $view;

        private Request $request;


        public function setRequest(Request $req): void{
            $this->request = $req;
        }

        public function request(){
            return $this->request;
        }

        public function setView(View $view){
            $this->view = $view;
        }

        public function view(string $name){
            $this->view->page($name);
        }
    };


?>