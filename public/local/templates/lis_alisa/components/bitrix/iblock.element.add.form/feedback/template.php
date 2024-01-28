<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
?>
<?
//echo "<pre>Template arParams: "; print_r($arParams); echo "</pre>";
//echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
//exit();
?>


<h2>Связаться с нами</h2>
<div class="form">
	<?
	if (count($arResult["ERRORS"])): ?>
		<div class="alert alert-danger">
			<?= ShowError(implode("<br />", $arResult["ERRORS"])) ?>
		</div>
	<?
	endif ?>
	<?
	if (strlen($arResult["MESSAGE"]) > 0): ?>
		<div class="alert alert-success">
			Сообщение отправлено!
			<?
			//=ShowNote($arResult["MESSAGE"])?>
		</div>
	<?
	endif ?>


	<form name="iblock_add" action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
		<?= bitrix_sessid_post() ?>

		<input type="hidden" class="form-control-a" name="PROPERTY[NAME][0]" value='<?= time() ?>'/>
		<input type="hidden" class="form-control-a" name="PROPERTY[38][0]" value='<?= $APPLICATION->GetCurPage(); ?>'/>


		<label for="name">Контактное лицо: </label>
		<input type="text" class="form-control-a" value='<?= $arResult["ELEMENT_PROPERTIES"][35][0]["~VALUE"] ?>'
			   name="PROPERTY[35][0]" placeholder="">
		<label for="mail">E-Mail: </label>
		<input type="text" class="form-control-a" value='<?= $arResult["ELEMENT_PROPERTIES"][36][0]["~VALUE"] ?>'
			   name="PROPERTY[36][0]" id="mail" placeholder="">

		<label for="789">Сообщение: </label>
		<textarea class="form-control-a" rows="4" id="789"
				  name="PROPERTY[37][0]"><?= $arResult["ELEMENT_PROPERTIES"][37][0]["~VALUE"] ?></textarea>
		<div class="buttons-container">
			<input name='iblock_submit' type="submit" class="button" value='Отправить сообщение'/>
		</div>

	</form>

</div>
