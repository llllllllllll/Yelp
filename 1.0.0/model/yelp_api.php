<?php
    require_once("libs/OAuth.php");
    class Yelp_api extends utilDb
    {
        public function run($record_count)
        {
            if($record_count < 0)
            {
                //$unsigned_url = "http://api.yelp.com/v2/business/the-waterboy-sacramento";
                $unsigned_url = "http://api.yelp.com/v2/search?category_filter=active&location=San+Francisco";
                
                // Set your keys here
                $consumer_key = "uQbfJjWPd4VX1J1ayguJ_w";
                $consumer_secret = "uIqxXXiotaKJsw2BLmt7oZIYJNQ";
                $token = "-QxdkEGi9p38ENzsnwAUarLB-XeNzUa9";
                $token_secret = "y9EZvZAo366T82Rf5HD1_y2Kkuo";
                
                // Token object built using the OAuth library
                $token = new OAuthToken($token, $token_secret);
                
                // Consumer object built using the OAuth library
                $consumer = new OAuthConsumer($consumer_key, $consumer_secret);
                
                // Yelp uses HMAC SHA1 encoding
                $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
                
                // Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
                $oauthrequest = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $unsigned_url);
                
                // Sign the request
                $oauthrequest->sign_request($signature_method, $consumer, $token);
                
                // Get the signed URL
                $signed_url = $oauthrequest->to_url();
                
                // Send Yelp API Call
                $ch = curl_init($signed_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                $data = curl_exec($ch); // Yelp response
                curl_close($ch);
                
                // Handle Yelp response data
                $response   = json_decode($data, true);      
            }
            else
            {
                $response = false;
            }
            return $response;
        }
        
        public function test()
        {
            $msg = "Hello World";
            return $msg;
        }
    }