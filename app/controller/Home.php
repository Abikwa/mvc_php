<?php
use  mvc_php_crud\app\libraries\Controller\Controller;
class Home extends Controller{
  

  public function __construct()
  {
  }
    public function index()
    {
        $this->template('home/index');
    }

}
