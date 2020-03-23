<?php
session_start();
require 'framework/Router.php';

$routeur = new Router();
$routeur->routerRequest();
