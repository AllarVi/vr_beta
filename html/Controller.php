<?php
include "id_card_utils.php";
require "config.php";

use Parse\ParseException;
use Parse\ParseUser;

/**
 * Created by PhpStorm.
 * User: allar
 * Date: 6.12.15
 * Time: 11:38
 */
class Controller
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    // Currently example method, no real use of this
    public function clicked()
    {
        $this->user->string = "Updated Data, thanks to MVC and PHP!";
    }

    /**
     * Handles authentication via estonian id-card. Saves data into model User.
     */
    public function auth()
    {
        $ePerson = getEPerson();

        if (!$ePerson) {
//             TODO: echo("Authentication failed.");
            $this->user->string = "ID kaardiga audentimine ebaõnnestus!";
        } else {
            $this->user->lastName = $ePerson[0];
            $this->user->firstName = $ePerson[1];
            $this->user->nationalID = $ePerson[2];
            $this->user->string = "ID kaardiga audentimine õnnestus edukalt!";
            $this->signUp($this->user, $this->user->lastName, $this->user->firstName, $this->user->nationalID);
        }
    }

    private function signUp($user, $lastName, $firstName, $nationalID)
    {
        $parseUser = new ParseUser();
        $parseUser->set("username", $nationalID);
        // TODO: password generation
        $parseUser->set("password", "default");
        $parseUser->set("firstName", $firstName);
        $parseUser->set("lastName", $lastName);

        try {
            $parseUser->signUp();
            // Hooray! Let them use the app now.
            $user->parseMessage = "Hooray! User saved into Parse database.";
        } catch (ParseException $ex) {
            // Show the error message somewhere and let the user try again.
            $user->parseMessage = "Error: " . $ex->getCode() . " " . $ex->getMessage();
        }
    }

}