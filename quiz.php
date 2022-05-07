<?php

class quiz extends controller {

  function create() {
    $data = $this->data;

    $validate = validateNullArray([
      isset($data["quantity"]) ?: "",
      isset($data["timer"]) ?: "",
    ]);

    if ($validate) {
      $this->error();
      exit();
    }

    $quantity = $data["quantity"];
    $timer = $data["timer"];

    $model = new model();

    $sql = "SELECT INTO quiz(quantity, timer) VALUES (?, ?)";
    $param = [$quantity, $timer];
    $result = $model->change($sql, $param);

    if ($result) {
      $this->success();
    } else {
      $this->error();
    }
  }
}
