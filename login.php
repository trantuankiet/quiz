<?php

class login extends controller {

  function index() {
    $data = $this->data;

    $validate = validateNullArray([
      isset($data["user"]) ?: "",
      isset($data["password"]) ?: "",
    ]);

    if ($validate) {
      $this->error();
      exit();
    }

    $user = $data["user"];
    $password = $data["password"];

    $model = new model();

    $sql = "SELECT id FROM user WHERE user = ? AND password = ?";
    $param = [$user, $password];
    $userInfo = $model->select($sql, false, $param);

    if ($userInfo) {
      $this->success();
    } else {
      $this->error();
    }

  }
}
