<?php
  include "includes/art-config.inc.php";
  include "includes/PaintingDB.php";
  include "includes/ReviewDB.php";

  $id = 441;
  if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
    }
  }

  $paintings = new PaintingDB($pdo);
  $reviews = new ReviewDB($pdo);


  $painting = $paintings->findById($id);
  $review = $reviews->findForPainting($id)->fetch();

  $img = $painting['ImageFileName'];
  $artistName = $painting['FirstName'] . ' ' . $painting['LastName'];
  $excerpt = $painting['Excerpt'];
  $title = $painting['Title'];
  $rating = $review['Rating'];
  $year = $painting['YearOfWork'];
  $medium = $painting['Medium'];
  $dimensions = $painting['Width'] . 'cm x ' . $painting['Height'] . 'cm';
  $description = $painting['Description'];
  $wikiLink = $painting['WikiLink'];
  $gooleLink = $painting['GoogleLink'];

?>
<html lang=en>
<head>
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>

    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
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

        $('.menu .item').tab();

        $('.event.example .image').dimmer({
            on: 'hover'
        });


        $('#artwork').on('click', function () {
            $('.ui.fullscreen.modal').modal('show');
        });

});

  </script>

</head>
<body>
<?php require "includes/art-header.inc.php" ?>
<main>
    <!-- Main section about painting -->
    <section class="ui segment grey100">
        <div class="ui doubling stackable grid container">
            <div class="nine wide column">
              <img src="images/art/works/medium/<?php echo $img . '.jpg'; ?>" alt="..." class="ui big image" id="artwork">

                <div class="ui fullscreen modal">
                  <div class="image content">
                      <img src="images/art/works/medium/<?php echo $img . 'jpg' ?>" alt="..." class="image" >
                      <div class="description">
                      <p></p>
                    </div>
                  </div>
                </div>

            </div>
            <div class="seven wide column">

                <!-- Main Info -->
                <div class="item">
                    <h2 class="header"><?php echo $title; ?></h2>
                    <h3 ><?php echo $artistName; ?></h3>
                      <div class="meta">

                    <p>
                      <?php
                          for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating)
                                echo '<i class="orange star icon"></i>';
                            else
                                echo  '<i class="empty star icon"></i>';
                          }
                        ?>
                    </p>

                        <p><?php echo $excerpt; ?> </p>
                      </div>

                </div>

                <!-- Tabs For Details, Museum, Genre, Subjects -->
                <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                </div>

                <div class="ui bottom attached active tab segment" data-tab="details">
                    <table class="ui definition very basic collapsing celled table">
                  <tbody>
                      <tr>
                     <td>
                          Artist
                      </td>
                      <td>
                        <a href="#"><?php echo $artistName; ?></a>
                      </td>
                      </tr>
                    <tr>
                      <td>
                          Year
                      </td>
                      <td>
                        <?php echo $year; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          Medium
                      </td>
                      <td>
                        <?php echo $medium; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          Dimensions
                      </td>
                      <td>
                        <?php echo $dimensions; ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
                </div>

            </div>
        </div>
    </section>

    <!-- Tabs for Description, On the Web, Reviews -->
    <section class="ui doubling stackable grid container">
        <div class="sixteen wide column">

            <div class="ui top attached tabular menu ">
              <a class="active item" data-tab="first">Description</a>
              <a class="item" data-tab="second">On the Web</a>
            </div>

            <div class="ui bottom attached active tab segment" data-tab="first">
              <?php echo $description; ?>
            </div>

            <div class="ui bottom attached tab segment" data-tab="second">

                  <table class="ui definition very basic collapsing celled table">
                  <tbody>
                      <tr>
                     <td>
                          Wikipedia Link
                      </td>
                      <td>
                        <a href="<?php echo $wikiLink; ?>">View painting on Wikipedia</a>
                      </td>
                      </tr>

                      <tr>
                     <td>
                          Google Link
                      </td>
                      <td>
                        <a href="<?php echo $gooleLink; ?>">View painting on Google Art Project</a>
                      </td>
                      </tr>

                      <tr>
                     <td>
                          Google Text
                      </td>
                      <td>

                      </td>
                      </tr>
                  </tbody>
                </table>


            </div>
            <div class="ui bottom attached tab segment" data-tab="third">

            </div>

        </div>
    </section>
</main>



  <footer class="ui black inverted segment">
      <div class="ui container">footer</div>
  </footer>
</body>
</html>
