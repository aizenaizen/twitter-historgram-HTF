<?php 
require_once('TwitterAPIExchange.php');
 
$settings = array(
    'oauth_access_token' => "VqNBgc0Ej0WJyptAcfEgVfKcL",
    'oauth_access_token_secret' => "Sg9xpVrhabOGarwdmnknpa8i3qYrEZmrCMM92UT6VYhVYI4b2j",
    'consumer_key' => "833578446353690624-NXHh2cui4CZ55HlTl3dS2zVJ4t3sPgy",
    'consumer_secret' => "Kp66KyGlCeJEbva083NzouAIlHdXpEpb5wwNWHVciXonS"
);

 
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
$getfield = '?screen_name=pewdiepie&count=3';
 
$twitter = new TwitterAPIExchange($settings);
 
$response = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();
 
print_r($response);