<?php

require_once('twitter_proxy.php');
    
    $posts = array();
    $result = array();
    
    for($i = 0; $i < 6; $i++){
        
        $user_id = array("25365536", "32959253", "23617610", "157140968", "455206551", "27989078");
        $users = array("KimKardashian", "khloekardashian", "kourtneykardash", "KendallJenner", "KylieKJenner_", "robkardashian");
        
        
        $myFile = "twitter.json";
        $fh = fopen($myFile, 'w') or die("can't open file");
        // Twitter OAuth Config options
        $oauth_access_token = '74106752-MHvVDJsa9eU4VjGGM0rOj9LzyAMmIPJeXMGlNJhrz';
        $oauth_access_token_secret = 'DIJMPGO2sMi1UkOOM5dNic729bJL4RvVQVqSYQXNw1cHe';
        $consumer_key = 'UEDjExO8jCIypIwi1b0VFBYcW';
        $consumer_secret = 'NcJqgS81GsBCQb0LAV0YXfMvLrsAWh8cZHGhoEgA7iBeHqSQWf';
        $user_id = $user_id[$i];
        $screen_name = $users[$i];
        $count = 200;
        
        $twitter_url = 'statuses/user_timeline.json';
        $twitter_url .= '?user_id=' . $user_id;
        $twitter_url .= '&screen_name=' . $screen_name;
        $twitter_url .= '&count=' . $count;
        
        // Create a Twitter Proxy object from our twitter_proxy.php class
        $twitter_proxy = new TwitterProxy(
                                          $oauth_access_token,			// 'Access token' on https://apps.twitter.com
                                          $oauth_access_token_secret,		// 'Access token secret' on https://apps.twitter.com
                                          $consumer_key,					// 'API key' on https://apps.twitter.com
                                          $consumer_secret,				// 'API secret' on https://apps.twitter.com
                                          $user_id,						// User id (http://gettwitterid.com/)
                                          $screen_name,					// Twitter handle
                                          $count							// The number of tweets to pull out
                                          );
        
        
        
        // Invoke the get method to retrieve results via a cURL request
        $tweets = $twitter_proxy->get($twitter_url);
        foreach($tweets as $tweet){
            $date = $tweet['created_at'];
            $text = $tweet['text'];
            $type = "twitter";
            $posts[] = array('user' => $screen_name, 'text' => $text, 'date' => $date, 'type' => $type);
            
        
        }
    }
        $result['results'][] = $posts;
        $stringData = json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        fwrite($fh, var_export($stringData, true));
        fclose($fh);
    
    

?>
