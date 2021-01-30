<?php
namespace bibliotheque\app\libraries\Controller;

class Controller {
    private $pagefinale="default";
    
    public function model($model)
    {
        # code...
        if(file_exists(MODELS .$model . '.php')){
        require_once MODELS . $model . '.php';
        return new $model();
        }   else{
        echo "le model  n'existe pas";
       }
    }

    public function view($view)
    {
        # code...
        if(file_exists(VIEWS .$view . '.phtml')){
            require_once VIEWS. $view . '.phtml';

        } else{
            echo "la page demandée n'existe pas";
        }

    }
    public function template($view, $data=[])
    {
        ob_start();
        if(file_exists(VIEWS. $view . '.phtml')){ 
            require_once VIEWS . $view . '.phtml';
        } else {
            die('la page demande n\'existe pas !'.VIEWS . $view );
        }
        $page_body=ob_get_clean();
        require_once TEMPLATE . $this->pagefinale . '.phtml';

    }
}

?>
