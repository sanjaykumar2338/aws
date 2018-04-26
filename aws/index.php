<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
 // $ch = curl_init();
 //     $headers = array(
 //        'Accept:*/*',
 //        'Accept-Encoding:gzip, deflate, br',
 //        'Accept-Language:en-US,en;q=0.9',
 //        'Connection:keep-alive',
 //        'Cookie:cid=390783; G_ENABLED_IDPS=google; _ym_uid=1517984482748307011; G_AUTHUSER_H=0; _ym_isad=2; _gat=1; _ga=GA1.2.1105398486.1517984481; _gid=GA1.2.999250006.1520494716; _ym_visorc_47548942=w; __zlcmid=krh6UngOkWnKW3',
 //        'DNT:1',
 //        'Host:amzscout.net',
 //        'Referer:https://amzscout.net/sales-estimator',
 //        'User-Agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36
 //        X-Requested-With:XMLHttpRequest'
 //        );
 //    // set URL and other appropriate options
 //    curl_setopt($ch, CURLOPT_URL,"https://amzscout.net/estimator/v1/sales?domain=COM&category=Toys%20%26%20Games&rank=2");
 //    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 //    curl_setopt($ch, CURLOPT_HEADER, true);
 //    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
 //    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
 //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 //    curl_setopt($ch, CURLOPT_HTTPGET, 1);
 //    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
 //    $authToken = curl_exec($ch);
 //    $data = explode('keep-alive', $authToken);
 //    $sales_data = json_decode($data[1], true);
 //    $sale = $sales_data['sales'];

 //    echo $sale;
 //    die;

include('aws_signed_request.php');
$public_key = 'AKIAJDBS764437ALC74AS';
$private_key = 'yboG9cM8kxg1RpT6iDi1eVZOUaXu37tZE5VS9eb7A';
$associate_tag = 'davin01-20N';

// generate signed URL
$request = aws_signed_request('com', array(
        'Operation' => 'ItemLookup',
        'ItemId' => 'B00005C5H4', //B01LYXWPUZ,B00XC09WJK,B01LS0VJXM
        'ResponseGroup' => 'Offers,ItemAttributes,Variations,BrowseNodes,SalesRank,Images'), $public_key, $private_key, $associate_tag);


// do request (you could also use curl etc.)
$response = @file_get_contents($request);

if ($response === FALSE) {
    echo "Request failed.\n";
} else {
    // parse XML
    $pxml = simplexml_load_string($response);
    if ($pxml === FALSE) {
        echo "Response could not be parsed.\n";
    } else { 
      print_r($pxml);
      die;
      $data = (string) $pxml->Items->Request->Errors->Error->Code;
      echo $data;
      die;
      $data = $pxml->Items->Item->Variations;
      $ls = array();
        foreach ($data->Item as $movie) {
            $ls[] = (string) $movie->ASIN;
           
        }

      print_r($ls);
      die;
   
       if(isset($pxml->Items->Item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->IsCategoryRoot)){
            $category = (string) $pxml->Items->Item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;
       } 

     

       if(isset($pxml->Items->Item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->IsCategoryRoot)){
            $category = (string) $pxml->Items->Item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;
       }       
      



       if(isset($pxml->Items->Item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->IsCategoryRoot)){
        $category = (string) $pxml->Items->Item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;        
       }



       if(isset($pxml->Items->Item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->IsCategoryRoot)){       
        $category = (string) $pxml->Items->Item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;        
       }   

      if($category == ''){
            $category = (string) $pxml->Items->Item->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Name;
           
        
      }

        
   


    }
}

?>
