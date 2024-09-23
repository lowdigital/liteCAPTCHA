<?php
	session_start();
	$bots = [
		'Mail.RU_Bot', 'YandexBot', 'Googlebot', 'YandexImages', 'YandexVideo', 
		'YandexWebmaster', 'YandexMedia', 'YandexBlogs', 'YandexDirect', 'Yandex', 
		'Google', 'MSNBot'
	];
	
	function isBot($userAgent, $bots) {
		foreach ($bots as $bot) {
			if (stripos($userAgent, $bot) !== false) {
				return true;
			}
		}
		return false;
	}

	if (!isset($_SESSION['captcha_passed']) && !isBot($_SERVER['HTTP_USER_AGENT'], $bots)) {
		$_SESSION['requested_url'] = $_SERVER['REQUEST_URI'];
		header("Location: /captcha.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered GIF</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="index.gif" alt="Centered GIF">
    </div>
</body>
</html>
