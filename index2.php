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
$tweets = array();
$get_pages = 5;

for($a=1;$a<=$get_pages;$a++){
	$getfield = "?include_entities=true&include_rts=true&screen_name=twitterapi&count=100&page=$a";
	 
	$twitter = new TwitterAPIExchange($settings);
	 
	$response = $twitter->setGetfield($getfield)
						->buildOauth($url, $requestMethod)
						->performRequest();
	 
	$tweets[] = $response;

}

$total_count = 0;

foreach($tweets as $tweet_obj) {
	$tweet_array = json_decode($tweet_obj);
	foreach ($tweet_array as $tweet){
		echo $tweet->created_at." : ".$tweet->id_str." : ".$tweet->text;
		echo '<br>';
		$total_count ++;
	}
}

echo "TOTAL TWEETS: $total_count";
