<?php

/*
 *
 * Debug function
 * displays values
 *
 */
function zzz($comment = " ", $value) {
    if (DEBUG == TRUE) {
        if (is_array($value)) {
            echo "<pre>" . $comment . "</pre>";
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        } else {
            echo "<p>{$comment} : {$value}</p>";
        }
    }
}
