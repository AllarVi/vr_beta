<?php
require "config.php";
//include "User.php";
//include "Controller.php";
//include "View.php";

//$model = new Model();
//$controller = new Controller($model);
//$view = new View($controller, $model);
//
//if (isset($_GET['action']) && !empty($_GET['action'])) {
//    $controller = $controller->$_GET['action']();
//}
use Parse\ParseObject;

//
$testObject = ParseObject::create("TestObject");
$testObject->set("Allar", "The Fatal");
$testObject->save();
?>
<html>
<head>
    <title>Title</title>
    <meta charset="UTF-8">

    <!-- Google sign-in APIs -->
    <meta name="google-signin-client_id" content="754123089612-ru560a6li4tcnbtaddd1425q0c4fq4js.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="/js/googleLogin.js"></script>

    <script src="/js/fblogintest.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<div class="wrapper">
    <div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false"
         data-auto-logout-link="true">
    </div>


    <!--<fb:login-button autologoutlink="true" scope="public_profile,email" onlogin="checkLoginState();">-->
    <!--</fb:login-button>-->

    <!-- Google Sign-in button -->
    <div class="g-signin2" data-onsuccess="onSignIn"></div>


    <a class="id-login-button" href="idcard_auth.php?action=auth"><img src="/img/idcard.gif"></a>

    <div id="status">

    </div>
</div>


<div id="allar-on-noob"></div>


</body>
</html>