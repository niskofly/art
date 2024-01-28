<?php

/**
 * Отладочный вывод в консоль браузера
 * @param $var
 */
function _cons($var): void
{
	echo "<script type='text/javascript'>console.log(" . json_encode($var) . ");</script>";
}


function pre($var = "Нет данных для вывода", $only_admin = true, $only_ip = false, $stop_scrypt = false): void
{
// список адресов для которых показывать отладку
	$show_ip = array(
			'77.51.199.197', // Стас
			'217.72.11.15', // Алексей
	);
	global $USER;
	$b = debug_backtrace();
	$d = $_SERVER['DOCUMENT_ROOT'];
	$b[0]["file"] = str_replace($d, '', str_replace(str_replace('/', '\\', $d), '', $b[0]['file']));
	$show = false;
	if (isset($_REQUEST['dump'])) {
		$message = "Показано потому, что в GET указана опция &dump ";
		$show = true;
	} elseif ($only_ip !== true or in_array($_SERVER['REMOTE_ADDR'], $show_ip)) {
		$message =
				$only_ip !== true ?
						"для всех IP" :
						"для IP = " . $_SERVER['REMOTE_ADDR'];
		if ($only_admin !== true or $USER->IsAdmin()) {
			$message .=
					$only_admin === true ?
							" и вы авторизованы под учётной записью с правами администратора." :
							" и для всех пользователей";
			$show = true;
		}
	}
	if ($show) {
		?>
		<div style="font-size:9pt;color:#000;background:white; border:2px solid red; z-index: 10000; position: relative;">
			<div style="padding:5px;background:red; color: white;">Вы видите блок отладки потому, что это
				разрешено <?= $message ?></div>
			<div style="padding:5px;background:#A0C3FF;">Функция отладки вызвана в файле <b><?= $b[0]["file"] ?></b>, на
				<b><?= $b[0]["line"] ?></b> строке
			</div>
			<pre style="padding:10px;"><?
				print_r($var) ?></pre>
		</div>
		<?
	}
	if ($stop_scrypt) {
		die;
	}
}


?>
