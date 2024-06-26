<?php
function handleClientDate($dateString) {
    // Check if the date string is already in a format that PHP and MySQL can handle
    if (DateTime::createFromFormat('Y-m-d H:i:s', $dateString)) {
        return $dateString;
    }

    // Remove the 'Z' at the end of the string if it exists
    $dateString_ = rtrim($dateString, 'Z');

    // If not, try to convert it from ISO 8601 format
    if (DateTime::createFromFormat('Y-m-d\TH:i:s.u', $dateString_)) {
        $dateTime = new DateTime($dateString_);
        return $dateTime->format('Y-m-d H:i:s');
    }

    // If it's not possible to convert the string to a valid date, throw an exception
    throw new Exception("Invalid date string: $dateString");
}