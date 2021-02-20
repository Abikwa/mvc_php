<?php

function redirect_url_helper($page)
{
header('Location: ' . URL_ROOT . '/' . $page);
}