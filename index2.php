<?php
// TWITTER HISTOGRAM TEST FOR hardtofind
// DATE: 20-FEB-17 
// AUTHOR: Josep Eisen Montellano a.k.a. Eisen Grimbourne ;)

// FINISHED @ can only retrieve 200 posts, will try other library

/*
When creating a new twitter app, Callback URL must be set or else the application is locked to OOB mode and will not be able to use dynamic callbacks
*/
define('TWITTER_OAUTH_CONSUMER_KEY', 'VqNBgc0Ej0WJyptAcfEgVfKcL');
define('TWITTER_OAUTH_CONSUMER_SECRET', 'Sg9xpVrhabOGarwdmnknpa8i3qYrEZmrCMM92UT6VYhVYI4b2j');
define('TWITTER_OAUTH_TOKEN', '833578446353690624-NXHh2cui4CZ55HlTl3dS2zVJ4t3sPgy');
define('TWITTER_OAUTH_TOKEN_SECRET', 'Kp66KyGlCeJEbva083NzouAIlHdXpEpb5wwNWHVciXonS');	

require_once ('src/codebird.php');

\Codebird\Codebird::setConsumerKey(
  TWITTER_OAUTH_CONSUMER_KEY,
  TWITTER_OAUTH_CONSUMER_SECRET
);

$cb = \Codebird\Codebird::getInstance();

$cb->setToken(
  TWITTER_OAUTH_TOKEN,
  TWITTER_OAUTH_TOKEN_SECRET
);

define('TWITTER_TIMELINE_USER', 'pewdiepie'); // Because pewdiepie is currently on a hot seat, we shall use his account. :D

//////////////////////////////////

// load the tweets
$tweets = $cb->statuses_userTimeline([
  'screen_name' => TWITTER_TIMELINE_USER,
  'count' => '200'
  // ,'exclude_replies' => true
]);

// check if tweet request was okay
if ($tweets->httpstatus === 200) { // HTTP 200 is OK
  // forget the httpstatus and rate limiting fields
  unset($tweets->httpstatus);
  unset($tweets->rate);

  $total_count = 0;
  foreach ($tweets as $tweet) {
	$text = $tweet->text;
	$time = $tweet->created_at;
	$last_id = $tweet->id;
    echo "TIME: $time; ID: $last_id; <a href=''>$text</a>";
	echo "<br>";
	$total_count ++;
	// var_dump($tweet);
  }
  
  echo "TOTAL TWEETS: $total_count";
}