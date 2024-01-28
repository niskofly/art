<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("���� ��������� �������");

/***
 *
 *   �������� ������� ������ �� ������� � �������� ����� ��� �������� ����� �������
 *
 *   �����!!!
 *   ����� �������� ������ $arEvent_name � ������������ � ���� ��� ����� ���������
 *   � �������� ���� � CSS ��������� �������, ���� �� ������������
 *
 *
 **/

use Bitrix\Main\Mail\Event;
use Bitrix\Main\Page\Asset;

global $USER;
if ($USER->IsAdmin()) {
	Asset::getInstance()->addCss('/local/templates/mail_general_2020/template_styles.css');


	$arEvent_name = [
		"test" => "test",
	];

	if (isset($_GET['send']) && $_GET['send'] === "Y") {
		if (
			(isset($_GET['order_id']) && $_GET['order_id'] != "")
			&& (isset($_GET['EVENT_NAME']) && $_GET['EVENT_NAME'] != "")
		) {
			Event::send([
				"EVENT_NAME" => $_GET["EVENT_NAME"],
				"LID" => "s1",
				"C_FIELDS" => array(
					"ORDER_ID" => $_GET['order_id'],
					"EMAIL" => "test@zvezda-studio.ru"
				),
			]);
		} else {
			echo "Тестирование сообщения";
		}
		$uri = new \Bitrix\Main\Web\Uri($request->getRequestUri());
		pre($uri->getUri());
		$uri->deleteParams(["send"]);
		header("Location: " . $uri->getUri());
	}
	?>
	<form action="" method="get">
		<label for=""> Введите ID заказа
			<input type="number" name="order_id" value="<?= $_GET['order_id'] ?: "" ?>" required/>
		</label>
		<br>
		<br>
		<label for=""> Введите email получателя
			<input type="email" name="EMAIL" value="<?= $_GET['EMAIL'] ?: "test@zvezda-studio.ru" ?>"/>
		</label>
		<br>
		<br>
		<label for=""> Код шаблона сообщения (EVENT_NAME)
			<select name="EVENT_NAME">
				<?php
				foreach ($arEvent_name as $EVENT_NAME => $EVENT_TITLE) {
					?>
					<option value="<?= $EVENT_NAME ?>" <?
					if ($_GET["EVENT_NAME"] === $EVENT_NAME) echo 'selected' ?>><?= $EVENT_TITLE ?></option>
					<?php
				}
				?>
			</select>
		</label>

		<br>
		<br>
		<label for="">Отправить
			<input type="checkbox" name="send" value="Y">
		</label>
		<br>
		<br>
		<button>Проверить</button>
	</form>
	<br><br><br><br><br>

	<?php
	if (isset($_GET['order_id']) && $_GET['order_id'] != "") {
		$APPLICATION->includeComponent(
			"bitrix:sale.business.value.mail",
			"",
			array(
				"DISPLAY_EMPTY" => "N",
				"DISPLAY_NAME" => "Y",
				"FIELD" => array("ID", "NAME", "SECOND_NAME", "LAST_NAME", "EMAIL"),
				"GROUP" => "CLIENT",
				"ORDER_ID" => $_GET['order_id'],
				"PROVIDER" => "USER"
			)
		);

		$APPLICATION->includeComponent(
			"bitrix:sale.personal.order.detail.mail",
			"",
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "A",
				"CUSTOM_SELECT_PROPS" => array(
					1 => "NAME",
					2 => "PROPERTY_CML2_ARTICLE",
					3 => "QUANTITY",
					4 => "PRICE_FORMATED",
				),
				"ID" => $_GET['order_id'],
				"PATH_TO_CANCEL" => "",
				"PATH_TO_LIST" => "",
				"PATH_TO_PAYMENT" => "payment.php",
				"PICTURE_HEIGHT" => "110",
				"PICTURE_RESAMPLE_TYPE" => "1",
				"PICTURE_WIDTH" => "110",
				"PROP_1" => array(),
				"PROP_2" => array(),
				"SHOW_ORDER_BASE" => "N",
				"SHOW_ORDER_BASKET" => "Y",
				"SHOW_ORDER_BUYER" => "N",
				"SHOW_ORDER_DELIVERY" => "N",
				"SHOW_ORDER_PARAMS" => "N",
				"SHOW_ORDER_PAYMENT" => "Y",
				"SHOW_ORDER_SUM" => "Y",
				"SHOW_ORDER_USER" => "N"
			)
		);
	} else {
		echo '������� id ������';
	}
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
