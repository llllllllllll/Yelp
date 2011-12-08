<?php
    require_once("libs/OAuth.php");
    class Yelp_api extends PG_Yelp_db
    {
        public function run($record_count,$url)
        {
            if($record_count > 0)
            {
                // GENERAL CATEGORY
                $unsigned_url       = $url;
                $values             = $this->PG_Yelp_values("PG_Yelp_api_key");
                
                // Set your keys here
                $consumer_key       = $values["consumer_key"];
                $consumer_secret    = $values["consumer_secret"];
                $token              = $values["token"];
                $token_secret       = $values["token_secret"];
                
                // Token object built using the OAuth library
                $token              = new OAuthToken($token, $token_secret);
                
                // Consumer object built using the OAuth library
                $consumer           = new OAuthConsumer($consumer_key, $consumer_secret);
                
                // Yelp uses HMAC SHA1 encoding
                $signature_method   = new OAuthSignatureMethod_HMAC_SHA1();
                
                // Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
                $oauthrequest       = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $unsigned_url);
                
                // Sign the request
                $oauthrequest->sign_request($signature_method, $consumer, $token);
                
                // Get the signed URL
                $signed_url         = $oauthrequest->to_url();
                
                // Send Yelp API Call
                $ch = curl_init($signed_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                $data = curl_exec($ch); // Yelp response
                curl_close($ch);
                
                // Handle Yelp response data
                //return json_decode($data, true);
                return $data;
            }
            else
            {
                return false;
            }
        }
        
        public function def_generalUrl()
        {
            //$unsigned_url   = "http://api.yelp.com/v2/search?term=yelp&location=sf";
            $unsigned_url   = "http://api.yelp.com/v2/search?category_filter=restaurants&location=sf";
            //$unsigned_url   = "http://api.yelp.com/v2/business/yelp-san-francisco";
            
            return $unsigned_url;
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    