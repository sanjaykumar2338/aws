<?php
function fba_fees($asin = false){ 
	$ch = curl_init();
	 $headers = array(
    'Accept:*/*',
	'Accept-Encoding:gzip, deflate, br',
	'Accept-Language:en-US,en;q=0.9',
	'Connection:keep-alive',
	'Cookie:cid=390783; G_ENABLED_IDPS=google; _ym_uid=1517984482748307011; G_AUTHUSER_H=0; _ym_isad=2; _ga=GA1.2.1105398486.1517984481; _gid=GA1.2.999250006.1520494716; _ym_visorc_47548942=w; __zlcmid=krh6UngOkWnKW3; _gat=1',
	'DNT:1',
	'Host:amzscout.net',
	'Referer:https://amzscout.net/fba-fee-calculator',
	'User-Agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36',
	'X-Requested-With:XMLHttpRequest'
    );
   
    curl_setopt($ch, CURLOPT_URL,"https://amzscout.net/api/v1/landing/fees?asin=".$asin."&domain=COM");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $authToken = curl_exec($ch);
    $data = explode('keep-alive', $authToken);
    $fees_data = json_decode($data[1], true);
    return round($fees_data['fees']['total'], 2);    
}

echo fba_fees('B00GGY85EC');
   
    