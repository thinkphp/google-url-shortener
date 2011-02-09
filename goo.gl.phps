<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Google URL Shortener</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
<style type="text/css">
  #shorten_container{margin-top: 20px;background: none repeat scroll 0 0 #E5ECF9; padding: 0.5em 1em; vertical-align: middle; white-space: nowrap;}
  #longUrl { border: 1px solid #666666;    height: 1.33em;    margin-right: 0.2em;    padding: 0;    width: 19em;font-size: 25px}
  input[type=submit]{font-size: 25px}
  table {font-size: 20px;padding: 10px}
  table td{border: 1px solid #999;padding: 5px}
  label{font-weight: bold}
</style>

</head>
<body>
<div id="doc2" class="yui-t7">
   <div id="hd" role="banner"><h1>Google URL Shortener</h1></div>
   <div id="bd" role="main">
      <p id="intro">The Google URL Shortener at goo.gl is a service that takes long URLs and squeezes them into fewer characters to make a link that is easier to share, tweet, or email to frieds.</p>
	<div class="yui-g">

<?php
      //grab your Shortner KEY
      define('GOOGLE_API_KEY',"AIzaSyBkOhgCG8LUdWy5FGTcXVf-UTfPhYHEz00"); 
      //define endpoint Shortner
      define('GOOGLE_ENDPOINT',"https://www.googleapis.com/urlshortener/v1/url"); 

      //function for shortner long URL
      function shortenUrl($longUrl) {

         $url = sprintf("%s?key=%s",GOOGLE_ENDPOINT,GOOGLE_API_KEY);
         $ch = curl_init();     
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
         curl_setopt($ch, CURLOPT_HEADER, 0);
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("longUrl"=>$longUrl)));
         $data = curl_exec($ch);
         curl_close($ch);

        return json_decode($data,true);
      }

      //function for reverse URL 
      function expandUrl($shortUrl) {

         $url = sprintf("%s?key=%s&shortUrl=%s",GOOGLE_ENDPOINT,GOOGLE_API_KEY,$shortUrl);
         $ch = curl_init();     
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
         $data = curl_exec($ch);
         curl_close($ch);

        return json_decode($data,true);
      }

      echo"<ul>";
      echo"<li>Visit the <a href=\"http://code.google.com/apis/console/\">Google APIs console</a></li>";
      echo"<li>Create a project</li>";
      echo"<li>Activate the URL Shortener API</li>";
      echo"<li>Click keys in the left navigation. You can then copy and paste the key from this page.</li>";
      echo"</ul>";   
      $short = shortenUrl("http://www.youtube.com/watch?v=i3_NtEq2JFo");
      echo"Prove:<br/>";
      //test: shorten
      echo sprintf("<strong>%s</strong> was shortened to <strong>%s</strong><br/>",$short['longUrl'],$short['id']);     
      //test: expand the shortUrl
      $long = expandUrl("http://goo.gl/LWvtn");
      echo sprintf("<strong>%s</strong> expanded to <strong>%s</strong><br/>",$long['id'],$long['longUrl']);

      echo"<div id='shorten_container'>";
      echo"<form action=".$_SERVER['PHP_SELF']." method='get'>";
      echo"<p><label for='longUrl'>Paste your long url here:</label></p>";
      echo"<p><input type='text' id='longUrl' name='longUrl'/><input type='submit' name='shorten' value='shorten'></p>";
      echo"</form>"; 
      echo"</div>";
      echo"<div id='result'>";
      if(isset($_GET['longUrl']) && isset($_GET['shorten'])) {
               $response = shortenUrl($_GET['longUrl']);
               $short= $response['id'];
               $long = $response['longUrl'];
               echo"<table>"; 
               echo"<thead><th>Long URL</th><th>Short URL</th></thead>";
               echo"<tr><td>$long</td><td>$short</td></tr>";
               echo"</table>";
      }
      echo"</div>"; 

      echo"Q.E.D";
?>



	</div>
	</div>
   <div id="ft" role="contentinfo"><p>By @<a href="http://twitter.com/thinkphp">thinkphp</a> | <a href="goo.gl.phps">source</a> | download on <a href='https://github.com/thinkphp/google-url-shortener'>GitHub</a></p></div>
</div>
</body>
</html>
