<?php
class CheckValues {
    public static function checkForCorrectValues($value, $typeOfCheck, $length) {
        $correctCharacters = true;
        switch ($typeOfCheck) {
            case "digit":
                $correctCharacters = ctype_digit($value);
                break;
            case "alpha":
                $copy = CheckValues::sanitize($value);
                $copy = str_replace(' ', '', $copy);
                $correctCharacters = preg_match('/[a-zA-ZèéàòùìÀÉÈÌÒÙ]+/', $copy);
                break;
            case "alnum":
                $correctCharacters = ctype_alnum(CheckValues::sanitize($value));
                break;
            case "data":
                $correctCharacters = DateTime::createFromFormat('Y-m-d G:i:s', $value);
                break;
            //controllo mail
            case "email":
                $correctCharacters = filter_var($value, FILTER_VALIDATE_EMAIL);
                break;
            //SQL injection
        }
        $correctCharacters = $correctCharacters && (strlen($value) <= $length);
        return $correctCharacters;
    }

    public static function sanitize($var) {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }

    public static function createMsgError($value) {
        return "Error Processing Request, $value Has Incorrect Characters Or Is Too Long";
    }

}
?>
