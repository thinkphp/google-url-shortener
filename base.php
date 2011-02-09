<?php

require_once('google.url.shortener.class.php');

$key = 'AIzaSyBkOhgCG8LUdWy5FGTcXVf-UTfPhYHEz00';    	  

echo"<h1>Google URL Shortener</h1>";
echo"<p>The Google URL Shortener at <a href=\"http://goo.gl/\">goo.gl</a> is a service that takes long URLs and squeezes them into fewer characters to make a link that is easier to share, tweet, or email to frieds.</p>";

$url = "https://github.com/shurizzle/UrlShortner/blob/master/index.php";

$google = new GoogleUrlApi($key);

//test: Shorten a URL
$short = $google->shorten($url);

echo sprintf("<strong>%s</strong> is shorten to <strong>%s</strong><br/>",$url,$short);

//test: Expand a URL
$long = $google->expand($short);

echo sprintf("<strong>%s</strong> is expanded to <strong>%s</strong>",$short,$long);

echo"<br/><br/>Written By @<a href='http://twitter.com/thinkphp'>thinkphp</a> | <a href='google.url.shortener.class.phps'>shortener.class.php</a> | download on <a href='https://github.com/thinkphp/google-url-shortener'>GitHub</a>";
?>