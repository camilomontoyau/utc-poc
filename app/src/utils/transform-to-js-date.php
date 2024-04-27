<?php
  function transformToJsDate($phpDate) {
    $jsonFormat = 'Y-m-d\TH:i:s.u\Z';
    $jsDate = new DateTimeImmutable($phpDate);
    $jsDate = $jsDate->format($jsonFormat);
    return $jsDate;
  }
