<?php

class GoogleUrlApi {
 
   public $apiURL;    

      /* constructor if class */ 
      public function __construct($key, $apiURL='https://www.googleapis.com/urlshortener/v1/url') {
                                                
          $this->apiURL = $apiURL . '?key=' . $key;
      }

      public function shorten($url) {

          $response = $this->send($url);
          return isset($response['id']) ? $response['id'] : false;
      }     

      public function expand($url) {

          $response = $this->send($url,false);
          return isset($response['longUrl']) ? $response['longUrl'] : false;
      }

      /* send information to Google.com */
      public function send($url, $shorten=true) {
 
           //init curl
           $ch = curl_init();

           if($shorten) {
             curl_setopt($ch, CURLOPT_URL, $this->apiURL); 
             curl_setopt($ch, CURLOPT_POST, 1);             
             curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("longUrl"=>$url)));                              
             curl_setopt($ch, CURLOPT_HEADER, 0);
             curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
           } else {
             curl_setopt($ch, CURLOPT_URL, $this->apiURL . '&shortUrl='.$url); 
           }     
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
             curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2); 

             //execute the post
             $result = curl_exec($ch);

             //close the connection
             curl_close($ch);
  
          //assoc TRUE => return an array
          return json_decode($result,true);               
      }
}
?>