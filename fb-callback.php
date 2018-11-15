<?php
session_start();

require 'vendor/autoload.php';
require 'vendor/symfony/var-dumper/VarDumper.php';

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

/**
 * Try to get accessToken
 */
try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

/**
 * Check if accessToken is not set to return error
 */
if (! isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

// accessToken == $accessToken->getValue()
//dump($accessToken->getValue());

// get oAuth2Client to manage token
$oAuth2Client = $fbConnect->getOAuth2Client();

// get the datas
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//dump($tokenMetadata->getIsValid());

// give long live
if(!$accessToken->isLongLived()){
    $oAuth2Client->getLongLivedAccessToken($accessToken);
}

if($accessToken){

    // get user information
    $userDatasResponse = $fbConnect->get("/me?fields=last_name, email",$accessToken);
    $userDatas = $userDatasResponse->getGraphNode()->asArray();

    //dump($userDatasResponse);
    //dump($userDatas);

    // init session variables to use it in session
    $_SESSION['FB_NAME'] = $userDatas['last_name'];
    $_SESSION['FB_EMAIL'] = $userDatas['email'];
    $_SESSION['FB_TOKEN'] = (string) $accessToken;

    header('Location: http://localhost:8000/index.php');
    exit();
}else{
    header('Location: http://localhost:8000/login.php');
    exit();
}