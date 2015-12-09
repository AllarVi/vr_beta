<?php
/**
 * Created by PhpStorm.
 * User: Mart
 * Date: 7.12.2015
 * Time: 18:44
 *
 * avalik api, millega saab küsida nii isikukoodi kaudu nime kui
 * fb ja google kasutajanimesid kui vastupidi, fb või google
 * kasutajanime järgi saad isikukoodi ja nime.
 */

use Parse\ParseQuery;

// TODO: Veriy if sender is in approved api-users list (Optional).

// Get and parse input
$json = file_get_contents('php://input');
$input = json_decode($json);

if( isset( $input['method'] )) {
    $method = $input->method;

    switch ($method) {
        case "id_to_google":
            $id = $input->data;
            // Query parse for Google username belonging to this ID
            $query = new ParseQuery("User");
            $query->equalTo("isikukood", $id);
            $result = $query->first();
            if (empty($result)) {
                $returndata = "Error: User with provided identification code was not found.";
            } else {
                $returndata = $result->google;
            }
            break;
        case "id_to_facebook":
            $id = $input->data;
            // Query parse for Facebook username belonging to this ID
            $query = new ParseQuery("User");
            $query->equalTo("isikukood", $id);
            $result = $query->first();
            if (empty($result)) {
                $returndata = "Error: User with provided identification code was not found.";
            } else {
                $returndata = $result->facebook;
            }
            break;
        case "facebook_to_id":
            $fb_id = $input->data;
            // Query Parse for ID belonging to this Facebook user.
            $query = new ParseQuery("User");
            $query->equalTo("facebook", $fb_id);
            $result = $query->first();
            if (empty($result)) {
                $returndata = "Error: User with provided Facebook Account was not found.";
            } else {
                $returndata = $result->isikukood;
            }
            break;
        case "google_to_id":
            $google_id = $input->data;
            // Query Parse for ID belonging to this Google user.
            $query = new ParseQuery("User");
            $query->equalTo("isikukood", $google_id);
            $result = $query->first();
            if (empty($result)) {
                $returndata = "Error: User with provided Google Account was not found.";
            } else {
                $returndata = $result->isikukood;
            }
            break;
        default:
            $returndata = "Incorrect method. See API manual for more information.";
    }
} else {
    $method = "Error: no method set";
    $returndata = "No method set. See API manual for more information.";
}

// Page content as JSON
$content = "{"
 . '"method": "' . $method . '",'
 . '"input": "' . $input->data . '",'
 . '"result": "' . $returndata . '"'
 . "}";
$content_length = strlen($content);


// Header details for return data
header("Content-type:application/json");
header('Content-Length: ' . $content_length);

// Page content
echo $content;