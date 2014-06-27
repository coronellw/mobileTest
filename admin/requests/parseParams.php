<?php

function validateNullString($param) {
    if ($param === null) {
        return '';
    } {
        return "'" . $param . "'";
    }
}
