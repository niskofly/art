<?php

class CFormCustomValidatorRuEnEx
{
	function GetDescription()
	{
		return array(
			"NAME" => "custom_ru_en_ex",
			// идентификатор
			"DESCRIPTION" => "русские обязательно и английские, ссылки запрещены",
			// наименование
			"TYPES" => array("text", "textarea"),
			// типы полей
			"SETTINGS" => array("CFormCustomValidatorRuEnEx", "GetSettings"),
			// метод, возвращающий массив настроек
			"CONVERT_TO_DB" => array("CFormCustomValidatorRuEnEx", "ToDB"),
			// метод, конвертирующий массив настроек в строку
			"CONVERT_FROM_DB" => array("CFormCustomValidatorRuEnEx", "FromDB"),
			// метод, конвертирующий строку настроек в массив
			"HANDLER" => array("CFormCustomValidatorRuEnEx", "DoValidate")
			// валидатор
		);
	}

	function GetSettings()
	{
		return array();
	}

	function ToDB($arParams)
	{
	}

	function FromDB($strParams)
	{
	}

	function DoValidate($arParams, $arQuestion, $arAnswers, $arValues)
	{
		global $APPLICATION;

		foreach ($arValues as $value) {
			if (strlen($value) <= 0) {
				continue;
			}
			if (!preg_match('/[а-яА-Я]+/iu', $value)) {
				$APPLICATION->ThrowException("Не разрешенные символы в поле #FIELD_NAME#");
				return false;
			}
			if (preg_match('/(http|www|<a|href)/i', $value)) {
				$err_mess[] = "Не разрешенные ссылки в сообщении\n";
				$APPLICATION->ThrowException("Не разрешенные ссылки в поле #FIELD_NAME#");
				return false;
			}
			$doman_pattern = "/[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,5}/i";
			if (preg_match($doman_pattern, $value)) {
				$err_mess[] .= "Не разрешенные ссылки в сообщении\n";
				$APPLICATION->ThrowException("ННе разрешенные ссылки в поле #FIELD_NAME#");
				return false;
			}
		}

		// все значения прошли валидацию, вернем true
		return true;
	}
}

// установим метод CFormCustomValidatorNumberEx в качестве обработчика события
AddEventHandler("form", "onFormValidatorBuildList", array("CFormCustomValidatorRuEnEx", "GetDescription"));
