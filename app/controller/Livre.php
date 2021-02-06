<?php
use  mvc_php_crud\app\libraries\Controller\Controller;
class Livre extends Controller{
  
  
  public function __construct()
  {
  }
    public function index()
    {
        $this->template('livres/index');
    }

}
