<?php 

class Core {

    public function __construct()
    {
        $this->run();
    }
   
    public function run() 
    {
        if (isset($_GET['pag'])) 
        {
            $url = $_GET['pag'];
        }

        // possui informação após dominio
        if (!empty($url))
        {
           $url = explode('/', $url); //delimitando a url
           $controller = $url[0].'Controller';
           array_shift($url); //retirador de primeira posição



           // se o usuário mandou apenas a função
           if (isset($url[0]) && !empty($url[0])) //verifica se existe e se não está vazio
           {
                $metodo = $url[0];
                array_shift($url); //deixando apenas os parametros na posição 0
           
            } else  // enviou somente a class sem metodo
            {
                $metodo = 'index';
            }

            if (count($url) > 0) // verificar se ainda tem parametros
            {
                $params = $url;
            }
        }
        else //sem nada após o dominio 
        {
            $controller = 'homeController';
            $metodo = 'index';
        }

        $caminho = 'loguinMVC/Controllers/'.$controller.'.php';

        if (!file_exists($caminho) && !method_exists($controller, $metodo)) 
        {
            $controller = 'homeController';
            $metodo = 'index';
        }

        $c = new $controller;

        call_user_func_array(array($c, $metodo), $params);
    }

}