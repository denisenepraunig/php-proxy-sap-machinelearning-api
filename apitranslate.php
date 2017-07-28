<?php
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        
        header("WWW-Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.0 401 Unauthorized");
        echo "Sorry - you need valid credentials to be granted access!\n";
        exit;
        
    } else {
        
        if (($_SERVER['PHP_AUTH_USER'] == 'user') && ($_SERVER['PHP_AUTH_PW'] == 'password')) {
            
            $input = json_decode(file_get_contents('php://input'), true);
            $text_to_translate = $input['text'];
            
            $postdata = array(
                'sourceLanguage' => 'de',
                'targetLanguages' => array('en'),
                'units' => array(array('value' => $text_to_translate))
            );
            
            $payload = json_encode($postdata);
            
            /*
            
            {  
               "sourceLanguage":"de",
               "targetLanguages":[  
                  "en"
               ],
               "units":[  
                  {  
                     "value":"Der zu übersetzende Text/Text to translate"
                  }
               ]
            }
            
            */
            
            // POSTing JSON data with CURL
            // https://lornajane.net/posts/2011/posting-json-data-with-php-curl
            
            $headers = array(
                'Content-type: application/json',
                'Accept: application/json;charset=UTF-8',
                'APIKey: <YOUR API KEY>'
            );
            
            $url = 'https://sandbox.api.sap.com/ml/translation/translate';
            
            //initialize
            $ch = curl_init($url);
            // 2. set the options
            
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            //execute
            $output = curl_exec($ch);
            
            if ($output === FALSE) {
              echo "cURL Error: " . curl_error($ch);
            } else {
            	echo $output;
            }
            //free up the curl handle
            curl_close($ch);    
            
        } else {
            
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            echo "Sorry - you need valid credentials to be granted access!\n";
            exit;
        }
    }
?>
