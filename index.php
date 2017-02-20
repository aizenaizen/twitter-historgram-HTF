<?php 
// TWITTER HISTOGRAM TEST FOR hardtofind JSON VERSION
// DATE: 20-FEB-17 
// AUTHOR: Josep Eisen Montellano a.k.a. Eisen Grimbourne ;)

// CHANGED TO TwitterAPIExchange, CANT FIND SOLUTION FOR RETIRIEVING 200 or MORE TWEETS for CODEBIRD

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
	$getfield = "?include_entities=true&include_rts=true&screen_name=taylorswift13&count=100&page=$a"; // Alright, lets use Ms. Swift's tweets.
	 
	$twitter = new TwitterAPIExchange($settings);
	 
	$response = $twitter->setGetfield($getfield)
						->buildOauth($url, $requestMethod)
						->performRequest();
	 
	$tweets[] = $response;
}

$total_count = 0;
$collect_time = array();
$collect_tweets = array();

foreach($tweets as $tweet_obj) {
	$tweet_array = json_decode($tweet_obj);
	foreach ($tweet_array as $t){
		$get_time = substr($t->created_at,11,8);
		$collect_time[] = $get_time;
		$collect_tweets[] = "TIME: ".$get_time." ; ID: ".$t->id_str." ; THE TWEET: ".$t->text;
		$total_count ++;
	}
}
echo "TIMEZONE : ".substr($tweet_array[0]->created_at, 20, 5);
echo "<br>";
echo "TOTAL TWEETS: $total_count <br>";


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//TIME OF DAY ACTIVE LOGIC HERE

$times = array();
$times['12:00 AM'] = 0;$times['01:00 AM'] = 0;$times['02:00 AM'] = 0;$times['04:00 AM'] = 0;$times['03:00 AM'] = 0;$times['05:00 AM'] = 0;
$times['06:00 AM'] = 0;$times['07:00 AM'] = 0;$times['08:00 AM'] = 0;$times['09:00 AM'] = 0;$times['10:00 AM'] = 0;$times['11:00 AM'] = 0;
$times['12:00 PM'] = 0;$times['01:00 PM'] = 0;$times['02:00 PM'] = 0;$times['03:00 PM'] = 0;$times['04:00 PM'] = 0;$times['05:00 PM'] = 0;
$times['06:00 PM'] = 0;$times['07:00 PM'] = 0;$times['08:00 PM'] = 0;$times['09:00 PM'] = 0;$times['10:00 PM'] = 0;$times['11:00 PM'] = 0;

foreach($collect_time as $tweet) {
	$hour = substr($tweet,0,2);
	
	switch($hour){
		case 00: $times['12:00 AM'] ++; break;
		case 01: $times['01:00 AM'] ++; break;
		case 02: $times['02:00 AM'] ++; break;
		case 03: $times['03:00 AM'] ++; break;
		case 04: $times['04:00 AM'] ++; break;
		case 05: $times['05:00 AM'] ++; break;
		case 06: $times['06:00 AM'] ++; break;
		case 07: $times['07:00 AM'] ++; break;
		case 08: $times['08:00 AM'] ++; break;
		case 09: $times['09:00 AM'] ++; break;
		case 10: $times['10:00 AM'] ++; break;
		case 11: $times['11:00 AM'] ++; break;
		case 12: $times['12:00 PM'] ++; break;
		case 13: $times['01:00 PM'] ++; break;
		case 14: $times['02:00 PM'] ++; break;
		case 15: $times['03:00 PM'] ++; break;
		case 16: $times['04:00 PM'] ++; break;
		case 17: $times['05:00 PM'] ++; break;
		case 18: $times['06:00 PM'] ++; break;
		case 19: $times['07:00 PM'] ++; break;
		case 20: $times['08:00 PM'] ++; break;
		case 21: $times['09:00 PM'] ++; break;
		case 22: $times['10:00 PM'] ++; break;
		case 23: $times['11:00 PM'] ++; break;
	}
}

arsort($times);
foreach($times as $i => $p_count) {
	echo " $p_count tweet(s) @ $i<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// echo 'ALL POSTS<br><br>';
// foreach($collect_tweets as $tweet) {
	// echo " $tweet <br>";
// }

