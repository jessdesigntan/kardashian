<?php
  include("controllers/template.php");
  $key = $_GET['q'];
  $result = search($key);
?>

<!DOCTYPE html>
<html lang="en">
  <?php head("Keeping up with the Kardashians"); ?>
  <body>

    <?php navbar(); ?>
    <div class="page-container">
      <div class="main-search-bar light">
        <form action="listing.php" method="GET">
          <input name="q" type="text" placeholder="Search anything ..." value="<?=$key;?>" id="searchBar" role="search" onfocus="this.value = this.value;">
          <button type="submit" class="hidden-submit"></button>
        </form>
      </div>

      <?php category(); ?>

      <div class="row">
        <div class="col-sm-3 hide-mobile">
          <div class="search-results side-filter">
            <h1>Filters</h1>
            <form method="get" action="listing.php">
                <div class="checkbox">
                  <label><input type="checkbox" value="twitter" name="q">Twitter</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="news" name="q">News</label>
                </div>
                <button type="submit" class="btn-primary btn">Filter</button>
              </form>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="search-results listing">
            <h1>Search Results</h1>
            <?php
              $length = count($result['response']['docs']);
              if ($length != 0) {
                for($i = 0; $i < $length; $i++) {
                  $type =  $result['response']['docs'][$i]['type'];


                  if ($type == "news") {
                    $source =  $result['response']['docs'][$i]['source'].'<br/>';
                    $title = $result['response']['docs'][$i]['title'].'<br/>';
                    $content = $result['response']['docs'][$i]['content'].'<br/>';
                    $date = $result['response']['docs'][$i]['date'].'<br/>';
                    $url = $result['response']['docs'][$i]['url'].'<br/>';
                    cardNews($source, $title, $content, $date, $url);
                  }

                  if ($type == "twitter") {
                    $user = $result['response']['docs'][$i]['user'];
                    $tweet =$result['response']['docs'][$i]['text'];
                    $date = $result['response']['docs'][$i]['date'];
                    cardTwitter($user, $tweet, $date);
                  }
                }
              }
              else {
              ?>
              <div class="post-empty-state">
                <div>
                  <h4>Nothing found</h4>
                </div>
              </div>
              <?php
              }
              ?>
          </div>
        </div>
      </div>
    </div>



    <script>
      document.getElementById("searchBar").focus();
      function card(e) {
        if (document.getElementById(e).classList.contains("active")) {
          removeActive(e);
          return;
        }
        removeActive();
        $("#"+e).addClass("active");
      }
      function removeActive(e) {
        $("#"+e).removeClass("active");
      }


    </script>
  </body>
</html>
