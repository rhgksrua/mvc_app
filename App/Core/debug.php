<?php

/**
 * Debug function
 * displays values
 */
function zzz($comment = " ", $value) {
    if (DEBUG == TRUE) {
        if (is_array($value)) {
            echo "<div style='border-style:solid;border-width:2px;'>";
            echo "<pre>" . $comment . "</pre>";
            echo "<pre>";
            print_r($value);
            echo "</pre>";
            echo "</div>";
        } else {
            echo "<p style='border-style:solid;border-width:2px;'>{$comment} : {$value}</p>";
        }
    }
}
