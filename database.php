<?php
class database extends dbconfig
{
  //Properties
  var $sql, $pdo, $statement;
  //Construct
  function __construct()
  {
    try
    {
      $option = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES=>false];
      $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->name, $this->user, $this->pass);
      $this->pdo->query('set names utf8');
    }
    catch(PDOException $e )
    {
      exit('Server Error '.$e->getMessage());
    }
  }
  //Set Query
  function setquery($sql)
  {
    $this->sql = $sql;
  }
  //Load 1 row
  function loadrow($param = [], $type = PDO::FETCH_OBJ)
  {
    try
    {
      $this->statement = $this->pdo->prepare($this->sql);
      $this->statement->execute($param);
      return $this->statement->fetch($type);
    }
    catch(PDOException $e)
    {
      exit('SQL Error '.$e->getMessage());
    }
  }
  //Load many rows
  function loadrows($param = [], $type = PDO::FETCH_OBJ)
  {
    try
    {
      $this->statement = $this->pdo->prepare($this->sql);
      $this->statement->execute($param);
      return $this->statement->fetchAll($type);
    }
    catch(PDOException $e)
    {
      exit('SQL Error '.$e->getMessage());
    }
  }
  //Load 1 value
  function loadvalue($param = [])
  {
    try
    {
      $this->statement = $this->pdo->prepare($this->sql);
      $this->statement->execute($param);
      return $this->statement->fetchColumn(0);
    }
    catch(PDOException $e)
    {
      exit('SQL Error '.$e->getMessage());
    }
  }
  //Disconnect
  function disconnect()
  {
    $this->pdo = NULL;
    $this->sql = '';
    $this->statement = NULL;
  }
}
