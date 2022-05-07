<?php

class answer extends controller {

  function create() {
    $data = $this->data;

    $validate = validateNull([
      isset($data["questionid"]) ?: "",
      isset($data["content"]) ?: "",
      isset($data["iscorrect"]) ?: "",
    ]);

    if ($validate) {
      $this->error();
      exit();
    }

    $questionid = $data["questionid"];
    $content = $data["content"];
    $iscorrect = $data["iscorrect"];

    $model = new model();

    $sql = "SELECT id, type FROM question WHERE id = ?";
    $param = [$questionid];
    $questionInfo = $model->select($sql, false, $param);

    if (!$questionInfo) {
      $this->error();
      exit();
    } else {
      $sql = "SELECT count(id) FROM answer WHERE questionid = ?";
      $param = [$questionid];
      $answerInfo = $model->select($sql, false, $param);

      if ($questionInfo->type == 1 && $answerInfo->count > 2) {
        $this->error();
        exit();
      }

      if ($questionInfo->type == 2 && $answerInfo->count > 4) {
        $this->error();
        exit();
      }
    }

    $sql = "INSERT INTO answer(questionid, content, iscorrect) VALUES (?, ?, ?)";
    $param = [$questionid, $content, $iscorrect];
    $result = $model->change($sql, $param);

    if ($result) {
      $this->success();
    } else {
      $this->error();
    }
  }
}
