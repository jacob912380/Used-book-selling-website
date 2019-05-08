<?php

require_once('vendor/autoload.php');

$sp = [
'publishable' => '',
'private' => '' ];


\Stripe\Stripe::setApiKey($sp['private']);
?>
