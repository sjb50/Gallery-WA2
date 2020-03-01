<?php
class PaintingDB{
  private $pdo;
  private $painting;

  function __construct($pdo){
    $this->pdo=$pdo;
  }

  public function findbyID($ID){
    $sql = "SELECT * from Paintings INNER JOIN artists where Paintings.PaintingID = $ID";
    $painting = $this->pdo->query($sql)->fetch(PDO::FETCH_BOTH);
    return $painting;
  }

  public function getPaintings(){
      $sql = "SELECT * FROM Paintings LIMIT 20";
      //$paintings = $this->pdo->query($sql)->fetch(PDO::FETCH_BOTH);
      $paintings=  DatabaseHelper::runQuery($this->pdo, $sql, null);
      return $paintings;
  }

  public function generateListItem($painting){
    $item = "<li class='item'>
            <a class='ui small image' href='single-painting.php?id=" . $painting['PaintingID'] . "'><img src='images/art/works/square-medium/" . $painting['ImageFileName'] . ".jpg'></a>
            <div class='content'>
              <a class='header' href='single-painting.php?id=" . $painting['PaintingID'] . "'>". $painting['Title'] ."</a>
              <div class='meta'><span class='cinema'>". $painting['Title'] . "</span></div>
              <div class='description'>
                <p>" . $painting['Description'] . "</p>
              </div>
              <div class='meta'>
                <strong>$". $painting['Cost'] . "</strong>
              </div>
              <div class='extra'>
              <a class='ui icon orange button' href='cart.php?id=" . $painting['PaintingID'] . "'><i class='add to cart icon'></i></a>
              <a class='ui icon button' href='favorites.php?id=" . $painting['PaintingID'] . "'><i class='heart icon'></i></a>
            </div>
          </div>
            </li>";
            return $item;
  }
}
 ?>
