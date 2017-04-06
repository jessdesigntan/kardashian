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
        <form action="index.php" method="GET">
          <input name="q" type="text" placeholder="Search anything ..." value="<?=$key;?>" id="searchBar" role="search" onfocus="this.value = this.value;">
          <button type="submit" class="hidden-submit"></button>
        </form>
        <div class="spellcheck">
          <?php
            if(count($result['response']['docs']) == 0 && $key != "") {
              $suggestion = spellcheck($key);
              if(count($suggestion) == 0) {
              ?>
              <p>Sorry! No results found :(</p>
              <?php
            } else {
          ?>
            <p>Did you mean
              <a class="label" href="index.php?q=<?=$suggestion;?>"><?php echo $suggestion; ?></a>
            ?</p>
          <?php } } ?>

        </div>
      </div>

      <?php category(); ?>

      <div class="row">
        <div class="col-sm-3 hide-mobile">
          <div class="search-results side-filter">
            <h1>Filters</h1>
            <form method="get" action="index.php">
                <div class="checkbox">
                  <label><input type="checkbox" value="type:twitter" name="q">Twitter</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="type:news" name="q">News</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="fashion" name="q">Fashion</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="fitness" name="q">Fitness</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="baby" name="q">Baby</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="health" name="q">Health</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="source:cnet" name="q">Cnet</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="source:Just%20Jared" name="q">Just Jared</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="source:Gossip%20Center" name="q">Gossip Center</label>
                </div>
                <button type="submit" class="btn-primary btn">Filter</button>
              </form>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="search-results listing">
            <?php
              $length = count($result['response']['docs']);
            ?>
            <h1>Search Results (<?=$length;?>)</h1>
            <?php
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
                  <?php if ($q == "") { ?>
                    <h4>Search anything!</h4>
                  <?php } else { ?>
                    <h4>Nothing found</h4>
                  <?php } ?>
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
