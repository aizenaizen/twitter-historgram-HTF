<?php
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

define('TWITTER_TIMELINE_USER', 'pewdiepie'); 

// load the tweets
$tweets = $cb->statuses_userTimeline([
  'screen_name' => TWITTER_TIMELINE_USER
]);

// check if tweet request was okay
if ($tweets->httpstatus === 200) { // HTTP 200 is OK
  // forget the httpstatus and rate limiting fields
  unset($tweets->httpstatus);
  unset($tweets->rate);

  foreach ($tweets as $tweet) {
    var_dump($tweet);
	echo "<br>";
  }
}
