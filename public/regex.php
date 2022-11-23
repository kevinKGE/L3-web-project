<?php

/**@param value : value to test
* @param regex : regex to test against
* @return true if value matches regex, false otherwise
*/

    function regex($value, $regex) {
        return preg_match($regex, $value);
    }
?>