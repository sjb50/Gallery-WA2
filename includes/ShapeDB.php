<?php
class ShapeDB{
  private $pdo;

  function __construct($pdo){
    $this->pdo=$pdo;
  }

  function GetAll(){
    $sql = "SELECT * FROM shapes";
    //$paintings = $this->pdo->query($sql)->fetch(PDO::FETCH_BOTH);
    $shapes =  DatabaseHelper::runQuery($this->pdo, $sql, null);
    return $shapes;
  }
} ?>
