<?php
// Проверить по ssh php -r 'mail("algauco@gmail.com", "My Subject", "test");'

// TODO Добавить проверку методов битрикса
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();

$email = $request->get("email") ?: 'test@zvezda-studio.ru';
$subject = $request->get("subject") ?: 'тест функции mail()';
$body = $request->get("body") ?: 'Функция mail() в порядке';

$message = '';

if ($request->isPost() && $request->get("submit") && $email) {
	$sendStatus = mail($email, $subject, $body, '');

	if ($sendStatus) {
		$message = "Email has been sent to <b>" . $_POST['email'] . "</b>.<br>";
	} else {
		$message = "Failed sending message to <b>" . $_POST['email'] . "</b>.<br>";
	}
} else {
	if (isset($_POST['submit'])) {
		$message = "No email address specified!<br>";
	}
}
?>
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			Mail test
		</title>
	</head>
	<body>


	<?php
	if (!empty($message)) {
		echo $message . "<br><br>";
	}

	if ( function_exists( 'mail' ) )
	{
		echo 'Функция mail() Включена';
	}
	else
	{
		echo 'Функция mail() Выключена';
	}


	?>
	<form method="post" action="">
		<table>
			<tr>
				<td>
					e-mail
				</td>
				<td>
					<input name="email" value="<?= $email ?>">
				</td>
			</tr>
			<tr>
				<td>
					subject
				</td>
				<td>
					<input name="subject" value="<?= $subject ?>">
				</td>
			</tr>
			<tr>
				<td>
					message
				</td>
				<td>
					<textarea name="body"><?= $body ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					<input type="submit" value="send" name="submit">
				</td>
			</tr>
		</table>
	</form>
	</body>
	</html>

<?
/**/

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
