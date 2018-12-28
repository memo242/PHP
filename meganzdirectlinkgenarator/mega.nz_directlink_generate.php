<?php
#	Kaynak1:	http://php.net/manual/tr/function.isset.php
#	Kaynak2:	http://www.aydinmahmut.com/json-nedir-json-parse-php-jquery/
#	Kaynak3:	http://php.net/manual/tr/function.curl-close.php

//Kaynak1
if (!isset($_GET['sourcelink']))	{
	echo "Erişim yetkiniz yok!\n";
	exit();
}
$sourcelink = $_GET['sourcelink'];

error_reporting(0);

//$url = "https://mega.nz/#!g8AFgLTa!OOU2bSmlMC7eDTGqmosemNh5busr5cC0eIITLMgZFq0";
preg_match("/!(.+?)!/", $sourcelink, $output_array);
$fileID = $output_array[1];
$domain = "meganz";
$lang = "en";
$apiURL = "https://eu.api.mega.co.nz/cs?domain=$domain&lang=$lang";
 
$value = array(
  array(
    'a' => 'g',
    'g' => 1,
    'ssl' => 0, //0, 1, 2 (default is 2)
    'p' => $fileID) // File id here
  );
 
  $rawPOST = json_encode($value);
 
  $ch = curl_init();
 
  curl_setopt($ch, CURLOPT_URL,            $apiURL );
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt($ch, CURLOPT_POST,           true );
  curl_setopt($ch, CURLOPT_POSTFIELDS,     $rawPOST );
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36');
  curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain;charset=UTF-8'));
 
  $result=curl_exec($ch);

//	Kaynak3
// cURL tanıtıcısını kapatıp sistem özkaynaklarını serbest bırakalım
curl_close($ch);
echo $result;	// json formatında gönderiyoruz.	--> Kaynak2

 /*
  $jsonResult = json_decode($result);
  $directLink = $jsonResult[0]->g;
  $fileSize = $jsonResult[0]->s;
 
  echo "URL: $directLink";
  echo '<br>';
  echo "File Size: $fileSize bytes";
  echo '<br>';
  */
  ?>