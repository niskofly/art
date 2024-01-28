<?php

class CFormCustomValidatorRuEx
{
	function GetDescription()
	{
		return array(
			"NAME" => "custom_ru_ex",
			// идентификатор
			"DESCRIPTION" => "Разрешены только русские буквы",
			// наименование
			"TYPES" => array("text", "textarea"),
			// типы полей
			"SETTINGS" => array("CFormCustomValidatorRuEx", "GetSettings"),
			// метод, возвращающий массив настроек
			"CONVERT_TO_DB" => array("CFormCustomValidatorRuEx", "ToDB"),
			// метод, конвертирующий массив настроек в строку
			"CONVERT_FROM_DB" => array("CFormCustomValidatorRuEx", "FromDB"),
			// метод, конвертирующий строку настроек в массив
			"HANDLER" => array("CFormCustomValidatorRuEx", "DoValidate")
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
			if (!preg_match('/^[а-яА-Я ]+$/iu', $value)) {
				$APPLICATION->ThrowException("Не разрешенные символы в поле #FIELD_NAME# " . $value);
				return false;
			}
		}

		// все значения прошли валидацию, вернем true
		return true;
	}
}

// установим метод CFormCustomValidatorNumberEx в качестве обработчика события
AddEventHandler("form", "onFormValidatorBuildList", array("CFormCustomValidatorRuEx", "GetDescription"));
