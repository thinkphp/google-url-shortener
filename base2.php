<?php
    error_reporting (0);
    if(isset($_POST['shorten']) && isset($_POST['longUrl'])) {
             require_once('google.url.shortener.class.php');
             $longUrl = $_POST['longUrl'];
             $key = 'AIzaSyBkOhgCG8LUdWy5FGTcXVf-UTfPhYHEz00';    	  
             $google = new GoogleUrlApi($key);
             $short = $google->shorten($longUrl);
    }

    if(isset($_POST['reverse']) && isset($_POST['shortUrl'])) {
             require_once('google.url.shortener.class.php');
             $shortUrl = $_POST['shortUrl'];
             $key = 'AIzaSyBkOhgCG8LUdWy5FGTcXVf-UTfPhYHEz00';    	  
             $google = new GoogleUrlApi($key);
             $long = $google->expand($shortUrl);
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Shorten, share and track your links</title>
<link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
<style type="text/css">
html,body{background:#C5C7BE;margin:0;padding:0;}
#doc{background:#fff;border:1em solid #fff;}
h1{font-family:Calibri,Arial,Sans-serif;font-size:200%;margin:0 0 .5em 0; padding:0;}
h2{font-family:Calibri,Arial,Sans-serif;font-size:150%;margin:1em 0;padding:0;font-weight: bold}
input{border: 1px solid #ccc;padding: 4px;margin: 4px;font-size: 35px;text-align: center}
label{margin-right: 10px}
input{margin-left: 28px}
input:focus{background: #E2FFC1}
input[id=shortUrl]{margin-left: 17px;}
form{background: #69c;padding: 30px}
p{padding: 5px;font-family: georgia,arial,verdana,sans-serif}
#theShortUrl{background: #F9FF93;padding-left: 30px;margin-top: 10px}
#theShortUrl input{background: #fff}
#theShortUrl label{font-weight: bold}
#ft{ color:#ccc;margin: 4px;font-size: 14px;margin-top: 20px}
#ft a { color:#999;}
</style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Google URL Shortener PHP Class</h1></div>
   <div id="bd" role="main">
      <p>The Google URL Shortener at goo.gl is a service that takes long URLs and squeezes them into fewer characters to make a link that is easier to share, tweet, or email to frieds. The Google URL Shortener API allows you to develop applications that interface with this service. You can use simple HTTP methods to create, inspect, or manage goo.gl short URLs from your desktop, mobile, or web application.</p>
	<div class="yui-g">
         <form action="<?php echo$_SERVER['PHP_SELF'];?>" method="POST">
           <p><label for="longUrl">Long URL:</label><input type="text" name="longUrl" id="longUrl" value="<?php echo$long;?>"><input type="submit" name="shorten" value="Short"></p>
         </form>
         <form action="<?php echo$_SERVER['PHP_SELF'];?>" method="POST">
         <div id="theShortUrl">
            <p><label for="shortUrl">Short URL:</label><input type="text" name="shortUrl" id="shortUrl" value="<?php echo$short;?>" ><input type="submit" name="reverse" value="Long"></p>
         </div>
        </form>
	</div>
	</div>
   <div id="ft" role="contentinfo"><p>Created By @<a href="http://twitter.com/thinkphp">thinkphp</a> | download on <a href='https://github.com/thinkphp/google-url-shortener'>GitHub</a></p></div>
</div>
</body>
</html>
