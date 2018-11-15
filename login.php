<?php
session_start();

require 'vendor/autoload.php';

/*
 * Init Facebook object with credentials
 */
$fbConnect = new \Facebook\Facebook(
    [
        'app_id' => '595587040861164',
        'app_secret' => 'c5c64a0e6edfc4b83e90fea33c3befa6',
        'default_graph_version' => 'v2.5'
    ]
);

// get the helper
$helper = $fbConnect->getRedirectLoginHelper();

// what you want to retrieve
$permissions = ['email'];

// redirect after user acceptation
$loginUrl = $helper->getLoginUrl('http://localhost:8000/fb-callback.php', $permissions);

?>
<html class="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
</head>
<body>
<div class="container">
    <div class="row" style="padding-top: 2em">
        <!-- button to redirect to facebook user acceptation -->
        <a href="<?= $loginUrl ?>" class="btn btn-primary">Login | <i class="fab fa-facebook-f"></i></a>
    </div>
</div>
</body>
</html>

