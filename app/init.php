<?php

require_once 'config/config.php';
spl_autoload_register(function($class){
 $parts=explode('\\',$class); 
  require_once LIBRARIES . end($parts) . '.php';
});


?>
