<?php

class model extends database {

  function select($sql, $isLoadRows = true, $param = []) {
    $this->setquery($sql);
    if ($isLoadRows) {
      return $this->loadrows($param);
    } else {
      return $this->loadrow($param);
    }
  }

  function change($sql, $param = []) {
    $this->setquery($sql);
    try {
      $this->statement = $this->pdo->prepare($this->sql);
      return $this->statement->execute($param);
    } catch(PDOException $e) {
      exit('SQL Error '.$e->getMessage());
    }
  }
}
