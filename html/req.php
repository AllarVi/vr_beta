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

// TODO: Veriy if sender is in approved api-users list.

// Get and parse input
$json = file_get_contents('php://input');
$input = json_decode($json);

if( isset( $input['method'] )) {
    $method = $input->method;

    switch ($method) {
        case "id_to_google":
            $id = $input->data;
            // Query parse for Google username belonging to this ID
            $returndata = 1;
            break;
        case "id_to_facebook":
            $id = $input->data;
            // Query parse for Facebook username belonging to this ID
            $returndata = 2;
            break;
        case "facebook_to_id":
            $fb_id = $input->data;
            // Query Parse for ID belonging to this Facebook user.
            $returndata = 3;
            break;
        case "google_to_id":
            $google_id = $input->data;
            // Query Parse for ID belonging to this Google user.
            $returndata = 4;
            break;
        default:
            $returndata = "Incorrect method. See API manual for more information.";
    }
} else {
    $method = "Error: no method set";
    $returndata = "No method set. See API manual for more information.";
}


// Header details for return data
header("Content-type:application/json");

// Payload itself as JSON
echo "{";
echo '"method": "' . $method . '",';
echo '"input": "' . $input->data . '",';
echo '"result": "' . $returndata . '"';
echo "}";