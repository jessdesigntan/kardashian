<?php
  $url = "http://localhost:8983/solr/database/select?indent=on&q=*:*&rows=20000&start=0&wt=json&omitHeader=true";
  function search($key) {

    $keys = explode(" ", $key);
    foreach ($keys as $k) {
      $url = "http://localhost:8983/solr/database/select?indent=on&q=$k&rows=20000&start=0&wt=json&omitHeader=true";
      $json = file_get_contents($url);
      $arr = json_decode($json, true);
      return $arr;
    }

    $json = file_get_contents($url);
    $arr = json_decode($json, true);

    return $arr;

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
    <script src="//twemoji.maxcdn.com/2/twemoji.min.js?2.2.3"></script>

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

function spellcheck($key) {
  $url = "http://localhost:8983/solr/database/spell?spellcheck.q=$key&spellcheck=true&wt=json&omitHeader=true&onlyMorePopular=true&rows=1";
  $json = file_get_contents($url);
  $jsonDecoded = json_decode($json, true);

  $suggestion = array();
  foreach($jsonDecoded["spellcheck"]["suggestions"] as $k=>$v){
      foreach($v["suggestion"] as $k2 => $v2) {
          if(count($v2)>0) $suggestion[] = $v2;
      }
  }

  return $suggestion[0]["word"];

}

function cardNews($source, $title, $content, $date, $url) {
  $img = newsImage($source);
?>
<div class="card">
  <div class="header">
    <div class="image"><img src="<?=$img;?>" alt="<?=$source;?>"></div>
    <div class="desc">
      <div class="name"><?=removeBR($source);?></div>
      <div class="type">News</div>
      <div class="source-icon"></div>
    </div>
  </div><!-- end of header -->
  <div class="body">
    <div class="date">
      <?=$date;?>
    </div>
    <div class="title">
      <a href="<?=removeBRURL($url);?>">
        <?=$title;?>
      </a>
    </div>
    <div class="desc">
      <?php $url = removeBRURL($url); ?>
      <a href="<?=$url;?>">
        <?=$content;?>
      </a>
    </div>
    <a href="<?=$url;?>" class="read-more">Read more →</a>
  </div><!-- end of body -->
</div><!-- end of card -->
<?php
}

function removeBRURL($url) {
  return str_replace('<br/>', '', $url);
}

function removeBR($name) {
  return str_replace('<br>', '', $name);
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

function cardTwitter($user, $tweet, $date) {
  $image = twitterImage($user);
  $tweet = replaceBreakline($tweet);
  $tweet = makeClickableLinks($tweet);
  $tweet = highlightMention($tweet);
?>
<div class="card card-social twitter">
  <div class="header">
    <div class="image"><img src="<?=$image;?>" alt="kendall jenner"></div>
    <div class="desc">
      <div class="name"><a href="https://www.twitter.com/<?=$user;?>">@<?=$user;?></a></div>
      <div class="type">Twitter</div>
    </div>
    <div class="source-icon"></div>
  </div><!-- end of header -->
  <div class="body">
    <div class="date"><?=$date;?></div>
    <div class="desc">
      <?=$tweet;?>
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
      <h4>Keep up with</h4>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('kim')" id="kim" href="index.php?q=kim">
        <img src="images/kim.jpg" alt="kim kardashian" class="img-responsive">
        <p>Kim</p>
      </a>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('khloe')" id="khloe" href="index.php?q=khloe">
        <img src="images/khloe.jpg" alt="khloe kardashian" class="img-responsive">
        <p>Khloe</p>
      </a>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('kourtney')" id="kourtney" href="index.php?q=kourtney">
        <img src="images/kourtney.jpg" alt="kourtney kardashian" class="img-responsive">
        <p>Kourtney</p>
      </a>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('kendall')" id="kendall" href="index.php?q=kendall">
        <img src="images/kendall.jpg" alt="kendall jenner" class="img-responsive">
        <p>Kendall</p>
      </a>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('kylie')" id="kylie" href="index.php?q=kylie">
        <img src="images/kylie.jpg" alt="kylie jenner" class="img-responsive">
        <p>Kylie</p>
      </a>
    </div>
    <div class="col-sm-2 col-xs-4">
      <a class="category-card" onclick="card('robert')" id="robert" href="listing.php?q=rob">
        <img src="images/robert.jpg" alt="robert kardashian" class="img-responsive">
        <p>Robert</p>
      </a>
    </div>
  </div>
</div>
<?php
}

function newsImage($source) {
  if (strtolower($source) == "cnet<br/>") {
    return "images/cnet.png";
  }
  if (strtolower($source) == "dailymail<br><br/>") {
    return "images/daily.jpg";
  }
  if (strtolower($source) == "just jared<br/>") {
    return "images/justjared.jpg";
  }
  if (strtolower($source) == "gossip center<br/>") {
    return "images/gossipcenter.jpg";
  }
}

function twitterImage($user) {
  if(strtolower($user) == "kimkardashian") {
    return "https://pbs.twimg.com/profile_images/816328762606243840/sCT5hHSV_400x400.jpg";
  }
  if(strtolower($user) == "khloekardashian") {
    return "https://pbs.twimg.com/profile_images/761299925527252992/uksZ2ty0_400x400.jpg";
  }
  if(strtolower($user) == "kourtneykardash") {
    return "https://pbs.twimg.com/profile_images/771534291465416704/j54ot3E__400x400.jpg";
  }
  if(strtolower($user) == "kendalljenner") {
    return "https://pbs.twimg.com/profile_images/808859908498034688/YCn235s4_400x400.jpg";
  }
  if(strtolower($user) == "kyliejenner") {
    return "https://pbs.twimg.com/profile_images/838470532731281408/pH1zQ0pG_400x400.jpg";
  }
  if(strtolower($user) == "robkardashian") {
    return "https://pbs.twimg.com/profile_images/815079572399980544/67QmR9VU_400x400.jpg";
  }
  if(strtolower($user) == "ScottDisick") {
    return "https://pbs.twimg.com/profile_images/2429762235/image_400x400.jpg";
  }
  if(strtolower($user) == "KhloeKFanxo") {
    return "https://pbs.twimg.com/profile_images/841029197996937221/lwgrlqdo_400x400.jpg";
  }
  if(strtolower($user) == "KKW_updates") {
    return "https://pbs.twimg.com/profile_images/840708742337462272/j-GsmZj6_400x400.jpg";
  }
  if(strtolower($user) == "KimKourtKhloeK") {
    return "https://pbs.twimg.com/profile_images/829770255526424577/YHiOga8u_400x400.jpg";
  }
  if(strtolower($user) == "DASHGlobal") {
    return "https://pbs.twimg.com/profile_images/631548123941220352/2lmIP3Ki_400x400.jpg";
  }
  if(strtolower($user) == "KimKFanNet") {
    return "https://pbs.twimg.com/profile_images/830493690820956161/NRTdBpfc_400x400.jpg";
  }
  if(strtolower($user) == "KardashianOnly") {
    return "https://pbs.twimg.com/profile_images/653778970354315264/cLHfi7uQ_400x400.jpg";
  }
}


function makeClickableLinks($tweet) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $tweet);
}

function replaceBreakline($tweet) {
  $tweet = str_replace('\n', '<br/>', $tweet);
  return $tweet;
}

function highlightMention($tweet) {
  return preg_replace('(@([a-zA-Z0-9]+))', '<a class="blue-color" href="https://twitter.com/$1" target="_blank">$0</a>', $tweet);
}
?>
