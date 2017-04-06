<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>02titlecontent</title>
</head>
<body>
<?php

header('Content-Type: text/plain');
$arr = array("gossipcenter","justjared","news","tweets");

for ($i=0;$i<4;$i++){
    $file = $arr[$i];
    $h = array('category','content');

    $oldjson = $file.".json";
    $json = $file.".json";
    $csv = $file.".csv";

    //replace
    $x = file_get_contents($oldjson,NULL,NULL);
    $newstr = $x;
    $newstr = htmlspecialchars_decode($newstr);
    $newstr = preg_replace('/[\x{2000}-\x{FFFFF}]/u', ' ', $newstr);
    $newstr = preg_replace('/\r\n|\n|\r/', ' ', $newstr);
    $newstr = str_replace(array('\n','\t','\u00a0','\"'), ' ', $newstr);
    $newstr = str_replace(array('&lsquo;','&rsquo;','&#8217;','&#039;'),"'",$newstr);
    $newstr = str_replace(array('&ldquo;','&rdquo;','&#8220;','&#8221;','&#8221','\\'),'',$newstr);
    $newstr = stripslashes($newstr);
    $newstr = str_replace(array('<br>','<br/>','<br\/>','<br />','<br \/>'), ' ', $newstr);
    $newstr = preg_replace('/(^(&nbsp;|\s|<br>|<br\/>)+|(&nbsp;|\s|<br>|<br\/>)+$)/', ' ', $newstr);
    $newstr = preg_replace('/\s+/S', ' ', $newstr);
    $newstr = preg_replace('!\s+!', ' ', $newstr);
    $newstr = trim($newstr);

    //format json special characters
    $newstr = str_replace(array('} , {','}, {','} ,{'),'},{',$newstr);
    $newstr = str_replace(array('" , "','", "','" ,"'),'","',$newstr);
    $newstr = str_replace(array('" : "','" :"','": "'),'":"',$newstr);
    $newstr = str_replace(array('{ "'),'{"',$newstr);
    $newstr = str_replace(array('" }'),'"}',$newstr);
    $newstr = str_replace(array('"'),'\\"',$newstr);
    $newstr = str_replace(array('\":\"'),'":"',$newstr);
    $newstr = str_replace(array('\",\"'),'","',$newstr);
    $newstr = str_replace(array('{\"'),'{"',$newstr);
    $newstr = str_replace(array('\"}'),'"}',$newstr);
    $newstr = str_replace(array('\"'),'',$newstr);


    //json to csv
    $newstr = "[".$newstr."]";

    // trace line by line
    // if ($i==2) {
    //     echo "init length: ".strlen($newstr);
    //     echo '<br/><br/>';
    //     $needle = '{"source":"';
    //     $lastPos = 0;
    //     $p = array();
    //     $str = "[";
    //
    //     while (($lastPos = strpos($newstr, $needle, $lastPos))!= false) {
    //         $p[] = $lastPos;
    //         $lastPos = $lastPos+strlen($needle);
    //     }
    //     echo "count: ".count($p);
    //     echo '<br/><br/>';
    //     $start = 60;
    //     $end = 61;
    //     //$max = 62;
    //     for($j=$start;$j<$end;$j++){
    //         // echo $j;
    //         // echo '<br/><br/>';
    //         // if($j!=$start) $str .= ",";
    //         // $str .= substr($newstr,$p[$j],$p[$j+1]-1-$p[$j]);
    //         if ($j==$end-1) {
    //             $str .= substr($newstr,$p[$j],strlen($newstr)-1-$p[$j]);
    //         } else {
    //             if($j!=$start) $str .= ",";
    //             $str .= substr($newstr,$p[$j],$p[$j+1]-1-$p[$j]);
    //         }
    //     }
    //     $str .= "]";
    //     echo 'last row: '.strlen($str);
    //     echo '<br/><br/>';
    //     echo $str;
    //     //$newstr = $str;
    // }

    file_put_contents($json, $newstr);

    $jsonDecoded = json_decode($newstr, true);

    $fp = fopen($csv, 'w');
    fputcsv($fp, $h);

    if ($i==3) {
        foreach($jsonDecoded as $k=>$v){
            $x = array();
            $x['category'] = '';
            $x['content'] = $v['text'];
            fputcsv($fp, $x);
        }
    }
    else {
        foreach($jsonDecoded as $k=>$v){
            $x = array();
            $x['category'] = '';
            $x['content'] = $v['title']." ".$v['content'];
            fputcsv($fp, $x);
        }
    }
    echo "<br/>success ".$file;
}
?>
</body>
</html>
