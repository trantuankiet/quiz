<?php

class question extends controller {

  function create() {
    $data = $this->data;

    $validate = validateNullArray([
      isset($data["quizid"]) ?: "",
      isset($data["title"]) ?: "",
      isset($data["categoryid"]) ?: "",
      isset($data["difficulty"]) ?: "",
      isset($data["type"]) ?: "",
    ]);

    if ($validate) {
      $this->error();
      exit();
    }

    $quizid = $data["quizid"];
    $title = $data["title"];
    $categoryid = $data["categoryid"];
    $difficulty = $data["difficulty"];
    $type = $data["type"];

    $model = new model();

    $sql = "SELECT id FROM category WHERE id = ?";
    $param = [$categoryid];
    $categoryInfo = $model->select($sql, false, $param);

    if (!$categoryInfo) {
      $this->error();
      exit();
    }

    $sql = "INSERT INTO question(quizid, title, categoryid, difficulty, type) VALUES (?, ?, ?, ?, ?)";
    $param = [$quizid, $title, $categoryid, $difficulty, $type];
    $result = $model->change($sql, $param);

    if ($result) {
      $this->success();
    } else {
      $this->error();
    }
  }

  function update() {
    $data = $this->data;

    $validate = validateNullArray([
      isset($data["id"]) ?: "",
      isset($data["quizid"]) ?: "",
      isset($data["title"]) ?: "",
      isset($data["categoryid"]) ?: "",
      isset($data["difficulty"]) ?: "",
      isset($data["type"]) ?: "",
    ]);

    if ($validate) {
      $this->error();
      exit();
    }

    $id = $data["id"];
    $quizid = $data["quizid"];
    $title = $data["title"];
    $categoryid = $data["categoryid"];
    $difficulty = $data["difficulty"];
    $type = $data["type"];

    $model = new model();

    $sql = "SELECT id FROM category WHERE id = ?";
    $param = [$categoryid];
    $categoryInfo = $model->select($sql, false, $param);

    if (!$categoryInfo) {
      $this->error();
      exit();
    }

    $sql = "UPDATE question SET quizid = ?, title = ?, categoryid = ?, difficulty = ?, type = ? WHERE id = ?";
    $param = [$quizid, $title, $categoryid, $difficulty, $type, $id];
    $result = $model->change($sql, $param);

    if ($result) {
      $this->success();
    } else {
      $this->error();
    }
  }

  function delete() {
    $data = $this->data;

    $validate = validateNull(isset($data["id"]) ?: "");

    if ($validate) {
      $this->error();
      exit();
    }

    $id = $data["id"];

    $model = new model();

    $sql = "SELECT id FROM question WHERE id = ?";
    $param = [$id];
    $questionInfo = $model->select($sql, false, $param);

    if (!$questionInfo) {
      $this->error();
      exit();
    }

    $sql = "DELETE FROM question WHERE id = ?";
    $param = [$id];
    $result = $model->change($sql, $param);

    if ($result) {
      $this->success();
    } else {
      $this->error();
    }
  }

  function getAll() {
    $model = new model();

    $sql = "SELECT * FROM question";
    $questionInfo = $model->select($sql);

    echo json_encode($questionInfo);
  }

  function getFilter() {
    $data = $this->data;

    $difficulty = isset($data["difficulty"]) ?: "";
    $categoryid = isset($data["categoryid"]) ?: "";

    $model = new model();

    $sql = "SELECT * FROM question WHERE 1 = 1 ";

    $param = [];
    if ($difficulty) {
      $sql .= "AND difficulty = ? ";
      $param[] = $difficulty;
    }

    if ($categoryid) {
      $sql .= "AND categoryid = ? ";
      $param[] = $categoryid;
    }

    $questionInfo = $model->select($sql,true, $param);

    echo json_encode($questionInfo);
  }
}
