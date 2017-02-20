<?php 
// error1: SSL certificate problem: unable to get local issuer certificate fixed with "curl.cainfo=[localpath]cacert.pem" in php.ini
// [localpath] is the path where the cacert.pem is
require_once('src/TwitterAPIExchange.php');
 
$settings = array(
    'oauth_access_token' => "833578446353690624-NXHh2cui4CZ55HlTl3dS2zVJ4t3sPgy",
    'oauth_access_token_secret' => "Kp66KyGlCeJEbva083NzouAIlHdXpEpb5wwNWHVciXonS",
    'consumer_key' => "VqNBgc0Ej0WJyptAcfEgVfKcL",
    'consumer_secret' => "Sg9xpVrhabOGarwdmnknpa8i3qYrEZmrCMM92UT6VYhVYI4b2j"
);

 
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
$getfield = '?screen_name=pewdiepie&count=200';
 
$twitter = new TwitterAPIExchange($settings);
 
$response = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();
 
print_r($response);