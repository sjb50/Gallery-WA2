<?php
  include "includes/art-config.inc.php";
  include "includes/PaintingDB.php";
  include "includes/GalleryDB.php";
    include "includes/ShapeDB.php";

  $artist = new ArtistDB($pdo);
  $allArtists = $artist->getAll();

  $paintingDB = new PaintingDB($pdo);
  $paintings = $paintingDB->getPaintings();

  $galleryDB = new GalleryDB($pdo);
  $galleries = $galleryDB->getAll();

  $shapeDB = new ShapeDB($pdo);
  $shapes = $shapeDB->getAll();
?>
<html lang=en>

  <head>
    <meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>

    <link href="css/semantic.css" rel="stylesheet">
    <link href="css/icon.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <script>
      $(function() {

        // initialize semanticUI components

        $('.ui.menu .ui.dropdown').dropdown({
            on: 'hover'
        });

        $('.ui.menu a.item')
            .on('click', function() {
                $(this).addClass('active')
                       .siblings()
                       .removeClass('active');
            });
});

  </script>

  </head>

  <body>
    <?php include "includes/art-header.inc.php" ?>

    <main class="ui segment doubling stackable grid container">

      <section class="five wide column">
        <form class="ui form">
          <h4 class="ui dividing header">Filters</h4>

          <div class="field">
            <label>Artist</label>
            <select class="ui fluid dropdown">
                <option id = "artistLastName">Select Artist</option>
                <?php
                foreach ($allArtists as $row) {
                  echo   '<option>' . $row['LastName']. '</option>';
                }
                ?>
            </select>
          </div>

          <div class="field">
            <label>Museum</label>
            <select class="ui fluid dropdown">
              <option id="museum">Select Museum</option>
              <?php
              foreach ($galleries as $gallery) {
                echo   '<option>' . $gallery['GalleryName']. '</option>';
              }
              ?>
            </select>
          </div>

          <div class="field">
            <label>Shape</label>
            <select class="ui fluid dropdown">
                <option id="shape">Select Shape</option>
                <?php
                foreach ($shapes as $shape) {
                  echo   '<option>' . $shape['ShapeName']. '</option>';
                }
                ?>
            </select>
          </div>

          <button class="small ui orange button" type="submit">
              <i class="filter icon"></i> Filter
            </button>
        </form>
      </section>

      <section class="eleven wide column">
        <h1 class="ui header">Paintings</h1>
        <ul class="ui divided items" id="paintingsList">
          <?php
          foreach ($paintings as $painting) {
            echo $paintingDB->generateListItem($painting);
          }
          ?>

        </ul>
      </section>

    </main>



    <footer class="ui black inverted segment">
      <div class="ui container">footer for later</div>
    </footer>
  </body>

</html>
