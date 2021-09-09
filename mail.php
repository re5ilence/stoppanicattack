<?php

require_once './vendor/autoload.php';

$user = 'root';
$pass = 'crashyes';

$successMessage = 'Письмо успешно отправлено!';
$failMessage = 'Возникла ошибка. Повторите попытку позже.';

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

try {
  $dbh = new PDO('mysql:host=localhost;dbname=stoppanicattack', $user, $pass);
  
  $stmt = $dbh->prepare("INSERT INTO subscribers (name, email) VALUES (?, ?)");
  $stmt->bindParam(1, $name);
  $stmt->bindParam(2, $email);

  $stmt->execute();
  
} catch (PDOException $e) {
  echo "Error!: " . $e->getMessage() . "<br/>";
  die();
}

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
  ->setUsername('stoppanicattack777@gmail.com')
  ->setPassword('justfly777')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Твоя персональная ссылка'))
  ->setFrom(['stoppanicattack777@gmail.com' => 'Надежда Леус'])
  ->setTo([$email])
  ->setBody('Ты стал(-ла) еще ближе на шаг к избавлению от Панических атак!

Подключайся к телеграмм каналу - и лови первое упражнение внутри!

https://t.me/joinchat/kn7XM3hqooJjNzFi')
;

// Send the message
$result = $mailer->send($message);

if ($result) {
    echo $successMessage;
    die;
}

echo $failMessage;