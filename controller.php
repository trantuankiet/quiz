<?php

class controller {

  public $data = [];

  function __construct() {
    global $input;

    $this->data = $input;
  }

  function success($message = "SUCCESS") {
    $success = [
      "success" => true,
      "message" => $message
    ];

    echo json_encode($success);
  }

  function error($message = "ERROR") {
    $error = [
      "success" => false,
      "message" => $message
    ];

    echo json_encode($error);
  }
}
