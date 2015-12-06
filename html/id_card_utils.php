<?php
header("Content-Type: text/html; charset=utf-8");

// Get user information obtained by Apache from the Estonian ID card.
// Return list [last_name,first_name,person_code] or False if fails.

function getEPerson()
{
    // get relevant environment vars set by Apache
    // SSL_CLIENT_S_DN example:
    //  /C=EE/O=ESTEID/OU=authentication/CN=SMITH,JOHN,37504170511/
    //  SN=SMITH/GN=JOHN/serialNumber=37504170511
    $ident = getenv("SSL_CLIENT_S_DN");
    $verify = getenv("SSL_CLIENT_VERIFY");
    //echo $ident;
    //echo $verify;
    //echo "<p>";
    //return True;
    // check and parse the values
    if (!$ident || $verify != "SUCCESS") return False;
    $ident = certstr2utf8($ident); // old cards use UCS-2, new cards use UTF-8
    //if (strpos($ident,"/C=EE/O=ESTEID")!=0 && ) return False;
    $ps = strpos($ident, ",SN=");
    $pg = strpos($ident, ",GN=");
    $pc = strpos($ident, "serialNumber=");
    if (!$ps || !$pg) return False;
    $pse = strpos($ident, ",", $ps + 1);
    $pge = strpos($ident, ",", $pg + 1);
    $res = array(substr($ident, $ps + 4, $pse - ($ps + 4)),
        substr($ident, $pg + 4, $pge - ($pg + 4)),
        substr($ident, $pc + 13, 11));
    return $res;
}

// Convert names from UCS-2/UTF-16 to UTF-8.
// Function taken from help.zone.eu.

function certstr2utf8($str)
{
    $str = preg_replace("/\\\\x([0-9ABCDEF]{1,2})/e", "chr(hexdec('\\1'))", $str);
    $encoding = mb_detect_encoding($str, "ASCII, UCS2, UTF8");
    if ($encoding == "ASCII") {
        $result = mb_convert_encoding($str, "UTF-8", "ASCII");
    } else {
        if (substr_count($str, chr(0)) > 0) {
            $result = mb_convert_encoding($str, "UTF-8", "UCS2");
        } else {
            $result = $str;
        }
    }
    return $result;
}