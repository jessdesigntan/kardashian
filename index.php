<?php include("controllers/template.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <?php head("Keeping up with the Kardashians"); ?>
  <body>
    <div class="hero-banner main-banner-bg">
      <div class="text">
        <h1>Keeping up with your favourite</h1>
        <h1 class="hero">Kardashian</h1>
        <div class="main-search-bar">
          <form action="listing.php" method="post">
            <input name="q" type="text" placeholder="Search anything ..." id="searchBar" role="search">
            <button type="submit" class="hidden-submit"></button>
          </form>
        </div>
      </div>
    </div>

    <script>
      document.getElementById("searchBar").focus();
    </script>
  </body>
</html>
