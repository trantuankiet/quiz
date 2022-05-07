<?php

function validateNull($data) {
  if (!isset($data) || is_null($data) || $data == "") {
    return true;
  }

  return false;
}

function validateNullArray($array) {
  foreach ($array as $item) {
    if (validateNull($item)) {
      return true;
    }
  }

  return false;
}
