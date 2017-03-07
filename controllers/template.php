<?php
  function search($key) {
    $url = "http://localhost:8983/solr/data/select?indent=on&omitHeader=true&q=*$key*&wt=json";
    //$url = "http://localhost:8983/solr/data/get?id=1&id=2";
    $json = file_get_contents($url);
    $arr = json_decode($json, true);
    return $arr;
    /*
    $length = count($arr['response']['docs']);
    for($i = 0; $i < $length; $i++) {
      echo $arr['response']['docs'][$i]['source'].'<br/>';
    }
    */
  }
  function head($title) {
?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="All about the Kardashians! Even better than the reality show Keeping up with the Kardashians!" />
    <title><?=$title;?></title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>


    <!-- Own style & js -->
    <link href="css/style.css" rel="stylesheet">

    <!-- wow.js for css animations & initialization -->
    <script src="js/wow.js"></script>
    <script src="js/pace.js"></script>
    <script>new WOW().init();</script>
  </head>
<?php
}

function navbar() {
?>
  <nav>
    <div>
      <a href="index.php"><img src="images/logo.jpg" class="img-responsive"></a>
    </div>
  </nav>


<?php
}

function cardNews($source, $title, $content, $date, $url) {
?>
<div class="card cnn">
  <div class="header">
    <div class="image"><img src="images/cnn.jpg" alt="channel news asia"></div>
    <div class="desc">
      <div class="name"><?=$source;?></div>
      <div class="type">News</div>
      <div class="source-icon"></div>
    </div>
  </div><!-- end of header -->
  <div class="body">
    <div class="date">
      <?=$date;?>
    </div>
    <div class="title">
      <a href="<?=$url;?>">
        <?=$title;?>
      </a>
    </div>
    <div class="desc">
      <a href="<?=$url;?>">
        <?=$content;?>
      </a>
    </div>
    <a href="<?=$url;?>" class="read-more">Read more →</a>
  </div><!-- end of body -->
</div><!-- end of card -->
<?php
}

function cardInstagram() {
?>
<div class="card card-social instagram">
  <div class="header">
    <div class="image"><img src="images/kylie.jpg" alt="kylie jenner"></div>
    <div class="desc">
      <div class="name"><a href="https://www.instagram.com/kyliejenner/">@kyliejenner</a></div>
      <div class="type">Instagram</div>
      <div class="source-icon"></div>
    </div>
  </div><!-- end of header -->
  <div class="body">
    <div class="date">12 Jan 2017</div>
    <div class="desc">
      Tag your best friend!
    </div>
    <div class="image">
      <a href="https://twitter.com/"><img src="https://instagram.fsin1-1.fna.fbcdn.net/t51.2885-15/e35/16585604_181923268964002_6497664578246148096_n.jpg" class="img-responsive"></a>
    </div>
    <div class="details">
      <div class="likes">5000 likes</div>
      <div class="comments">123 comments</div>
    </div>
  </div><!-- end of body -->
</div><!-- end of card -->
<?php
}

function cardTwitter() {
?>
<div class="card card-social twitter">
  <div class="header">
    <div class="image"><img src="images/kendall.jpg" alt="kendall jenner"></div>
    <div class="desc">
      <div class="name"><a href="https://www.instagram.com/kyliejenner/">@kendalljenner</a></div>
      <div class="type">Twitter</div>
    </div>
    <div class="source-icon"></div>
  </div><!-- end of header -->
  <div class="body">
    <div class="date">12 Jan 2017</div>
    <a href="https://twitter.com/">
      <div class="desc">
        This is a tweet!
      </div>
    </a>
    <div class="details">
      <div class="likes">5000 likes</div>
      <div>123 retweets</div>
    </div>
  </div><!-- end of body -->
</div><!-- end of card -->
<?php
}

function category() {
?>
<div class="category">
  <div class="row">
    <div class="col-sm-12">
      <h4>Filter by people</h4>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('kim')" id="kim">
        <img src="images/kim.jpg" alt="kim kardashian" class="img-responsive">
        <p>Kim</p>
      </a>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('khloe')" id="khloe">
        <img src="images/khloe.jpg" alt="khloe kardashian" class="img-responsive">
        <p>Khloe</p>
      </a>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('kourtney')" id="kourtney">
        <img src="images/kourtney.jpg" alt="kourtney kardashian" class="img-responsive">
        <p>Kourtney</p>
      </a>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('kendall')" id="kendall">
        <img src="images/kendall.jpg" alt="kendall jenner" class="img-responsive">
        <p>Kendall</p>
      </a>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('kylie')" id="kylie">
        <img src="images/kylie.jpg" alt="kylie jenner" class="img-responsive">
        <p>Kylie</p>
      </a>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('robert')" id="robert">
        <img src="images/robert.jpg" alt="robert kardashian" class="img-responsive">
        <p>Robert</p>
      </a>
    </div>
  </div>
</div>
<?php
}
?>
