<?php
session_start();

if (isset($_SESSION['captcha_passed']) && $_SESSION['captcha_passed'] === true) {
    header("Location: " . $_SESSION['requested_url']);
    exit;
}

if (!isset($_SESSION['requested_url'])) {
    $_SESSION['requested_url'] = $_SERVER['HTTP_REFERER'] ?? '/';
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $jsonData = file_get_contents('captcha_data.json');
    $captchaData = json_decode($jsonData, true);

    $randomImages = array_rand($captchaData, 4);

    $correctIndex = array_rand($randomImages);
    $correctImage = $captchaData[$randomImages[$correctIndex]]['image'];

    $_SESSION['captcha_images'] = $randomImages;
    $_SESSION['captcha_correct_image'] = $correctImage;
}

$message = '';
$messageClass = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedImage = $_POST['captcha'] ?? null;

    if ($selectedImage === $_SESSION['captcha_correct_image']) {
        $_SESSION['captcha_passed'] = true;
        header("Location: " . $_SESSION['requested_url']);
        exit;
    } else {
        $message = 'CAPTCHA verification failed, please try again.';
        $messageClass = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAPTCHA</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .captcha-container {
            background: white;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            width: 300px;
            position: relative;
        }

        h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }

        .captcha-options {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .captcha-options label {
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .captcha-options label:hover {
            transform: scale(1.1);
        }

        .captcha-options img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 2px solid transparent;
            transition: border 0.2s ease;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked + img {
            border: 2px solid #4CAF50;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Success and error messages */
        .message {
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            font-weight: bold;
            display: none;
        }

        .message.success {
            background-color: #4CAF50;
            color: white;
            display: block;
        }

        .message.error {
            background-color: #f44336;
            color: white;
            display: block;
        }
    </style>
</head>
<body>
    <div class="captcha-container">
        <?php if ($message) : ?>
            <div class="message <?= $messageClass; ?>">
                <?= $message; ?>
            </div>
        <?php endif; ?>
        <h3>Select: <?= $captchaData[$randomImages[$correctIndex]]['title'] ?></h3>
        <form method="POST">
            <div class="captcha-options">
                <?php foreach ($_SESSION['captcha_images'] as $index) : ?>
                    <label>
                        <input type="radio" name="captcha" value="<?= $captchaData[$index]['image'] ?>">
                        <img src="<?= $captchaData[$index]['image'] ?>" alt="<?= $captchaData[$index]['title'] ?>">
                    </label>
                <?php endforeach; ?>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>