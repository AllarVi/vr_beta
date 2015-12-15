<?php
require "config.php";

use Parse\ParseQuery;

// TODO: Veriy if sender is in approved api-users list (Optional).

header('Content-Type: application/json');

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $q = $_GET['search'];
    $returnData = "No result";

    // Query parse for Facebook username belonging to this ID
    $query = new ParseQuery("UserObject");
    $query->equalTo("nationalID", $q);
    $result = $query->first();

    if (empty($result)) {
        $query = new ParseQuery("UserObject");
        $query->equalTo("FB_email", $q);
        $result = $query->first();

        if (empty($result)) {
            // TODO:
        } else {
            $returnData = $result->get('nationalID') . ', ';
            $returnData = $returnData . $result->get('firstName') . " ";
            $returnData = $returnData . $result->get('lastName');
        }
    } else {
        $returnData = $result->get('FB_email');
    }

    // Build response
    $arr = array('method' => 'search', 'result' => $returnData);
    die(json_encode($arr));
} else {
    $method = "Error: no method set";
    $returnData = "";

    $arr = array('method' => $method, 'result' => $returnData);

    die(json_encode($arr));
}