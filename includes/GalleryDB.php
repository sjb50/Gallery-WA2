<?php
class GalleryDB{
  private $pdo;

  function __construct($pdo){
    $this->pdo=$pdo;
  }

  function GetAll(){
    $sql = "SELECT * FROM galleries";
    //$paintings = $this->pdo->query($sql)->fetch(PDO::FETCH_BOTH);
    $galleries =  DatabaseHelper::runQuery($this->pdo, $sql, null);
    return $galleries;
  }
} ?>
