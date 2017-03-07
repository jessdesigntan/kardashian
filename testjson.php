<?php
  search("ky");
  function search($key) {
    $url = "http://localhost:8983/solr/data/select?indent=on&omitHeader=true&q=*$key*&wt=json";
    //$url = "http://localhost:8983/solr/data/get?id=1&id=2";
    $json = file_get_contents($url);
    $arr = json_decode($json, true);

    $length = count($arr['response']['docs']);
    for($i = 0; $i < $length; $i++) {
      echo $arr['response']['docs'][$i]['source'].'<br/>';
    }
  }
?>
