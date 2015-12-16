<?php
require "config.php";

use Parse\ParseQuery;

// TODO: Veriy if sender is in approved api-users list (Optional).

header('Content-Type: application/json');

/**
 * @param $id_code  Estonian national id-code as String.
 * @return bool     True, if valid id-code, false, if not.
 */
function validateEstonianID($id_code)
{
    $mod1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 1];
    $mod2 = [3, 4, 5, 6, 7, 8, 9, 1, 2, 3];
    $code_length = strlen($id_code);
    $res1 = 0;
    $res2 = 0;

    if ($code_length != 11)
        return false;

    for ($i = 0; $i < $code_length - 1; $i++) {
        if (is_numeric($id_code[$i])) {
            $res1 += intval($id_code[$i]) * $mod1[$i];
            $res2 += intval($id_code[$i]) * $mod2[$i];
        } else {
            return false;
        }
    }

    if (is_numeric($id_code[10])) {
        if ($res1 % 11 === intval($id_code[10])) {
            return true;
        } else if ($res1 % 11 === 0 && $res2 % 11 === intval($id_code[10])) {
            return true;
        } else if ($res1 % 11 === 0 && $res2 % 11 === 10 && intval($id_code[10]) === 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $q = $_GET['search'];
    $returnData = "No result";

    if (validateEstonianID($q)) {
        // Query parse for Facebook username belonging to this ID
        $query = new ParseQuery("UserObject");
        $query->equalTo("nationalID", $q);
        $result = $query->first();

        if (!empty($result)) {
            $returnData = $result->get('FB_email');
        }
    } else {
        // Query Parse for ID belonging to this Facebook username.
        $query = new ParseQuery("UserObject");
        $query->equalTo("FB_email", $q);
        $result = $query->first();

        if (!empty($result)) {
            $returnData = $result->get('nationalID') . ', ';
            $returnData = $returnData . $result->get('firstName') . " ";
            $returnData = $returnData . $result->get('lastName');
        }
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