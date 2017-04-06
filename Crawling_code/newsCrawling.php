<?php
include_once('simple_html_dom.php');
    //echo phpversion();
    $posts = array();
    $result = array();
    $url;
    $title;
    $content;
    $date;
    $source;
    $myFile = "news.json";
    $fh = fopen($myFile, 'w') or die("can't open file");
    
   
    $page = 250;
    $count = 0;
    ini_set('max_execution_time', 0);
    
    
    for($u = 0; $u < 6; $u++){
        $users = array("kim-kardashian", "khloe-kardashian", "kourtney-kardashian", "kendall-jenner", "kylie-jenner", "rob-kardashian");
        for($i = 1; $i < $page; $i++){
            $target_url = 'http://www.gossipcenter.com/'.$users[$u].'?page='.$i.'';
            $html = file_get_html($target_url);
            foreach($html->find('div#content-bottom') as $contents){
                foreach($contents->find('div.views-row') as $results){
                    foreach($results->find('h2.title') as $title){
                        foreach($title->find('a') as $link){
                            $url = $link->href;
                            //echo $url.'<br>';
                            $html=file_get_html($url);
                            foreach($html->find('h1.title') as $title){
                                $title =  $title->innertext;
                            //    echo $title.'<br>';
                            }
                            
                            foreach($html->find('div.node-content') as $text){
                                foreach($text->find('div.squeeze-more') as $detail){
                                    $string = nl2br(strip_tags($detail->innertext));
                                    $content = preg_replace('#<br />(\s*<br />)+#', '<br />', $string);
                             //       echo $content.'<br>';
                                }
                                foreach($text->find('div.publish-date') as $date1){
                                    $date = $date1->innertext;
                            //        echo $date.'<br>';
                                }
                            }
                            $source="Gossip Center";
                            $type = "news";
                            $posts[] = array('person' => $users[$u], 'source' => $source, 'url' => $url, 'title' => $title, 'content' => $content, 'date' => $date, 'type' => $type);
                            $count = $count + 1;
                        }
                    }
                }
            }
        }
    }
    echo $count;
    
    // encode array to json
    $result['results'][] = $posts;
    $stringData = json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    fwrite($fh, $stringData);
    fclose($fh);

    
    
//    $page = 121;
//    $count = 0;
//    ini_set('max_execution_time', 0);
//    
//    for($u = 0; $u < 6; $u++){
//        $changeName = array("kim-kardashian", "khloe-kardashian", "kourtney-kardashian", "kendall-jenner", "kylie-jenner", "rob-kardashian");
//        $users = array("kim+kardashian", "khloe+kardashian", "kourtney+kardashian", "kendall+jenner", "kylie+jenner", "robert+kardashian");
//        for($i = 1; $i < $page; $i++){
//            $target_url = 'http://www.justjared.com/page/'.$i.'/?s='.$users[$u].'';
//            $html = file_get_html($target_url);
//            foreach($html->find('div#content') as $content){
//                foreach($content->find('div.post') as $post){
//                    foreach($post->find('h2') as $title){
//                        foreach($title->find('a') as $link){
//                            $url = $link->href;
//                            //echo $url.'<br>';
//                            $html=file_get_html($url);
//                            libxml_use_internal_errors(true);
//                            $doc = new DOMDocument();
//                            $doc->loadHTMLFile($url);
//                            $xpath = new DOMXpath($doc);
//                            $title = $xpath->query('//div[@class="post"]/h1')->item(0)->nodeValue;
//                            //echo $title.'<br>';
//    
//                            $date = $xpath->query('//div[@class="post-date"]')->item(0)->nodeValue;
//                            //echo $date.'<br>';
//    
//                            $content = $xpath->query('//div[@class="entry"]/span')->item(0)->nodeValue;
//                            //echo $content.'<br>';
//    
//    
//                            $source="Just Jared";
//                            $type = "news";
//                            $posts[] = array('person' => $changeName[$u], 'source' => $source, 'url' => $url, 'title' => $title, 'content' => $content, 'date' => $date, 'type' => $type);
//                            $count = $count + 1;
//                        }
//                    }
//                }
//            }
//        }
//        echo $users[$u];
//    }
//    echo $count;
//    
//    // encode array to json
//    $result['results'][] = $posts;
//    $stringData = json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
//    fwrite($fh, $stringData);
//    fclose($fh);

    
    
    /*CNET*/
    
//    $html = file_get_html('https://www.cnet.com/tags/kim-kardashian/2/');
//
//    // Find all "A" tags and print their HREFs
//    foreach($html->find('div.assetBody') as $e){
//        foreach($e->find('time.assetTime') as $date1){
//            $date = $date1->innertext;
//        }
//        foreach($e->find('span.assetType') as $link){
//            foreach($link->find('a') as $path){
//                $path = $path->href;
//                //print($path.'<br>');
//                $url = "http://www.cnet.com".$path;
//                $html = file_get_html($url);
//                foreach($html->find('div.articleHead') as $title1){
//                    $title = strip_tags($title1->innertext);
//                }
//                // Find the DIV tag with a class of "article-main-body"
//                foreach($html->find('div.article-main-body') as $e){
//                    $content1 = strip_tags($e->innertext);
//                    $content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $content1);
//                    $source = "cnet";
//                    $type = "news";
//                    $url1 = utf8_encode($url);
//                    $posts[] = array('source' => $source, 'url' => $url, 'title' => $title, 'content' => $content, 'date' => $date, 'type' => $type);
//                    
//                    
//                }
//            }
//        }
//    }
//    
//    // encode array to json
//    $result['results'][] = $posts;
//    $stringData = json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
//    fwrite($fh, $stringData);
//    fclose($fh);
    
    
    
    
    /*CNN*/
    
//    set_time_limit(300);
    
//    $offset = 0;
//    $count = 1;
//    for($i = 1; $i < 3; $i++){
//        $url = 'http://www.dailymail.co.uk/home/search.html?offset='.$offset.'&size=50&sel=site&searchPhrase=kardashian&sort=recent&type=article&days=all';
//        $html = file_get_html($url);
//
//        // Find all "A" tags and print their HREFs
//        foreach($html->find('div.sch-res-content') as $content){
//            foreach($content->find('h3.sch-res-title') as $title){
//                foreach($title->find('a') as $link){
//                    $path = $link->href;
//                    $count++;
//                    echo $count;
//                    $url = 'http://www.dailymail.co.uk'.$path;
//                    //$url = 'http://www.dailymail.co.uk/news/article-3768716/Woman-accused-Chris-Brown-holding-gun-head-history-making-death-threats.html';
//                    libxml_use_internal_errors(true);
//                    $doc = new DOMDocument();
//                    $doc->loadHTMLFile($url);
//                    $xpath = new DOMXpath($doc);
//                    $title = $xpath->query('//div[@id="js-article-text"]/h1')->item(0)->nodeValue;
//                    
//                    //echo $title;
//                    $content1 = $xpath->query('//div[@itemprop="articleBody"]')->item(0);
//                    $elements = $xpath->query('//div[@class="related-carousel with-fb tvshowbiz half"]')->item(0);
//                    $countt = count($elements);
//                    if($countt > 0){
//                        foreach($elements as $e){
//                            $content1->removeChild($e);
//                        }
//                    }
//                    $content = $content1->nodeValue;
//        
//                    $date = $xpath->query('//span[@class="article-timestamp article-timestamp-published"]/text()[last()]')->item(0)->nodeValue;
//                    $source="Dailymail";
//                    $type = "news";
//                    $posts[] = array('source'=> $source, 'ur'=> $url, 'title'=> $title, 'content'=> $content, 'date'=> $date, 'type' => $type);
//                }
//            }
//        }
//        $offset = $offset + 50;
//    }
//    
//    echo $count;

?>
