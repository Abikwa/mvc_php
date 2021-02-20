<?php
use  mvc_php_crud\app\libraries\Controller\Controller;
class Auteur extends Controller{
  private $auteurModel;

  public function __construct()
  {
    $this->auteurModel = $this->model('AuteurModel');
  }
    public function index()
    {
        $data = $this->auteurModel->getauteurs();
        $this->template('auteurs/index', $data);
    }

    public function create()
    {
        $data = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
           $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
           $data = [
                 'nomauteur' => rtrim($_POST['nomauteur']),
                 'adresse' => rtrim($_POST['adresse']),
                 'telephone' => rtrim($_POST['telephone']),
                 'ERROR' => ''
           ];
           if(!empty($data['nomauteur']))
           {
                if(!empty($data['adresse']))
                {
                    if(!empty($data['telephone']))
                    {
                        $this->auteurModel->creer($data);
                        redirect_url_helper('auteur');
                    }
                    else
                    $data['ERROR'] = "telephone obligatoire";
                }
                else
                $data['ERROR'] = "adresse obligatoire";
           }
           else
            $data['ERROR'] = "nom auteur obligatoire";
        }

        $this->template('auteurs/create', $data);
    }

    public function edit($id)
    {
        $auteur = $this->auteurModel->getauteurById($id);
        $data = [
            'id'=>$id,
             'nomauteur' => $auteur->nomauteur,
             'adresse' => $auteur->adresse,
             'telephone' => $auteur->telephone,
             'ERROR' => ''
       ];
        if($auteur)
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
               $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
               $data = [
                    'id'=>$id,
                     'nomauteur' => rtrim($_POST['nomauteur']),
                     'adresse' => rtrim($_POST['adresse']),
                     'telephone' => rtrim($_POST['telephone']),
                     'ERROR' => ''
               ];
               if(!empty($data['nomauteur']))
               {
                    if(!empty($data['adresse']))
                    {
                        if(!empty($data['telephone']))
                        {
                            $this->auteurModel->edit($data);
                            redirect_url_helper('auteur');
                        }
                        else
                        $data['ERROR'] = "telephone obligatoire";
                    }
                    else
                    $data['ERROR'] = "adresse obligatoire";
               }
               else
                $data['ERROR'] = "nom auteur obligatoire";
            } 
        }
        else
            $data['ERROR'] = "cet auteur n'existe pas";
        $this->template('auteurs/edit', $data);
    }
}
