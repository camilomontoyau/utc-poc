<?php
function handleClientDate($dateString) {
    // Check if the date string is already in a format that PHP and MySQL can handle
    if (DateTime::createFromFormat('Y-m-d H:i:s', $dateString)) {
        return $dateString;
    }

    // If not, try to convert it from ISO 8601 format
    if (DateTime::createFromFormat(DateTime::ATOM, $dateString)) {
        $dateTime = new DateTime($dateString);
        return $dateTime->format('Y-m-d H:i:s');
    }

    // If it's not possible to convert the string to a valid date, throw an exception
    throw new Exception("Invalid date string: $dateString");
}
