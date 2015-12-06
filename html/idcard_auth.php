<?php
/**
 * Created by PhpStorm.
 * User: allar
 * Date: 6.12.15
 * Time: 12:48
 */
include "config.php";
include "id_card_utils.php";
include "Model.php";
include "Controller.php";
include "View.php";

$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);

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
<?php
$user = get_user();
if (!$user) echo("Authentication failed.");
else {
    echo "Last name: " . $user[0] . "<br>";
    echo "First name: " . $user[1] . "<br>";
    echo "Person code: " . $user[2] . "<br>";
}
?>
</body>
</html>