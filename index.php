<?php
$doc = new DOMDocument();
$doc->loadHTML("https://www.flipkart.com/micromax-bolt-q346-champagne-8-gb/p/itmezery5jtgdvzz?pid=MOBEZERYGU8YCXJ9&srno=b_1_21&otracker=CLP_filters&lid=LSTMOBEZERYGU8YCXJ92UOFLV&fm=organic&iid=654037e3-0190-4c4f-ac19-ca33f886f8cb.MOBEZERYGU8YCXJ9.SEARCH");

$tags = $doc->getElementsByTagName('a');

foreach ($tags as $tag) {
       echo $tag->getAttribute('href').' | '.$tag->nodeValue."\n";
}
die;
$request = aws_signed_request('com', array(
			        'Operation' => 'ItemLookup',
			        'ItemId' => 'B075K98LJW',
			        'ResponseGroup' => 'ItemAttributes,Variations,BrowseNodes,SalesRank'), $public_key, $private_key, $associate_tag);

			// do request (you could also use curl etc.)
			$response = @file_get_contents($request);
			if ($response === FALSE) {
			   // echo "Request failed.\n";
			} else {
		    // parse XML
		    $pxml = simplexml_load_string($response);
		    if ($pxml === FALSE) {
		        echo "Response could not be parsed.\n";
		    } else {
		    	print_r($pxml);
		    	die;
			}			
		}
