<?php session_start();

require 'vendor/autoload.php';

if (!isset($_SESSION['FB_TOKEN'])) {
    header('Location: http://localhost:8000/login.php');
    exit();
}

// check if user want to logout
if (isset($_POST['action']) && $_POST['action'] == 'logout') {

    $accessToken = $_SESSION['FB_TOKEN'];

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

    session_destroy();
    header('Location: ' .$helper->getLogoutUrl($accessToken, 'http://localhost:8000/logout.php'));
    exit();
}

?>
<html class="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN USER</title>
</head>
<body>
<div class="container" style="padding-top: 2em">
    <h1>User info</h1>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <td scope="col">NOM</td>
                <td scope="col">EMAIL</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?= $_SESSION['FB_NAME'] ?></td>
                <td><?= $_SESSION['FB_EMAIL'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post">
                <input type="hidden" name="action" value="logout"/>
                <button class="btn btn-danger">Log Out</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>