<?php

require_once 'config/config.php';
require_once 'helper/url_helper.php';
spl_autoload_register(function($class){
 $parts=explode('\\',$class); 
  require_once LIBRARIES . end($parts) . '.php';
});


?>
