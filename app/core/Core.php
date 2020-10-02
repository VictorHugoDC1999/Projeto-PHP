<?php

class Core {
    
    private $url;
    private $controller;
    private $method = 'index';
    private $params = array();
    private $user;
    private $error;

    public function __construct(){

        $this -> user = $_SESSION['usr'] ?? null;
        $this -> error = $_SESSION['msg_error'] ?? null;

        if (isset($this -> error)) {

            if ($this -> error['count'] === 0) {

                $_SESSION['msg_error']['count'] ++;

            } else {

                unset($_SESSION['msg_error']);

            }
            
        }
    }

    public function start($request) {

        if (isset($request['url'])) {//se existir algo neste atributo
            
            $this -> url = explode('/', $request['url']);//sempre que tiver uma barra ele vai quebrar ela e transformar num array

            //agora iremos separa-las em controller, method e params
            $this -> controller = ucfirst($this -> url[0]).'Controller';
            array_shift($this-> url);//apaga a primeira posição no array

            if (isset($this -> url[0]) && $this -> url != '') {//se existir url (ou seja, apos apagar o primeiro registro(linha 22), existe mais um outro registro?) na posição 0 e a url for diferente de vazio
                $this -> method = $this -> url[0];
                array_shift($this-> url);
                
                if (isset($this -> url[0]) && $this -> url != '') {
                    $this -> params = $this -> url;
                }

            }

        }
        
        if (isset($this -> user)){

            $pg_permission = ['DashboardController'];

            if (!isset($this -> controller) || !in_array($this -> controller, $pg_permission)) {//se o controlador não ta dentro do pg_permission, então o usuario não tem permissão para acessar esta pagina

                $this -> controller = 'DashboardController';
                $this -> method = 'index';
            }

        } else {

            $pg_permission = ['LoginController'];

            if (!isset($this -> controller) || !in_array($this -> controller, $pg_permission)) {

                $this -> controller = 'LoginController';
                $this -> method = 'index';

            }

        }

        //carregando a pagina (Controller)
        return call_user_func(array(new $this -> controller, $this -> method), $this -> params);

        //var_dump($this -> controller, $this -> method, $this -> params);

    }

}