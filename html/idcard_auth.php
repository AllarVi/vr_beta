<?php
/**
 * Created by PhpStorm.
 * User: allar
 * Date: 6.12.15
 * Time: 12:48
 */
include "config.php";
include "User.php";
include "Controller.php";
include "View.php";

$user = new User();
$controller = new Controller($user);
$view = new View($controller, $user);

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $controller = $controller->$_GET['action']();
}

function authenticate()
{
    session_start();
    if ($_SESSION['fingerprint'] != md5($_SERVER['HTTP_USER_AGENT'])) {
        session_destroy();
        echo 'die';
        header('HTTP/1.0 401 Unauthorized');
        exit();
    }
}

//    function debug_to_console($data)
//{
//
//    if (is_array($data))
//        $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
//    else
//        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
//
//    echo $output;
//}

authenticate();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="charset=utf-8">
    <title>Authenticated</title>
</head>
<body>
<h1><?php echo $view->output(); ?></h1>

<?php echo $view->outputEPersonData(); ?>

<h2><?php echo $view->outputParseMessage(); ?></h2>

</body>
</html>