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