<?php

class signup extends controller {

  function index() {
    $data = $this->data;

    $validate = validateNullArray([
      isset($data["user"]) ?: "",
      isset($data["password"]) ?: "",
      isset($data["confirm"]) ?: "",
    ]);

    if ($validate || $data["password"] == $data["confirm"]) {
      $this->error();
      exit();
    }

    $user = $data["user"];
    $password = $data["password"];

    $model = new model();

    $sql = "SELECT id FROM user WHERE user = ?";
    $param = [$user];
    $userInfo = $model->select($sql, false, $param);

    if ($userInfo) {
      $this->error();
      exit();
    }

    $sql = "INSERT INTO user(user, password) VALUES (?, ?)";
    $param = [$user, $password];
    $result = $model->change($sql, $param);

    if ($result) {
      $this->success();
    } else {
      $this->error();
    }
  }
}
