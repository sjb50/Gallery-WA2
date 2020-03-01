<?php
class ReviewDB{
  private $pdo;

  function __construct($pdo){
    $this->pdo=$pdo;
  }

  public function findForPainting($ID){
    $sql = "SELECT * FROM reviews";
    $info = $this->pdo->query($sql);
    return $info;
  }
}
 ?>
