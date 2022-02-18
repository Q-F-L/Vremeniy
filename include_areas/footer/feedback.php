<?if (CModule::IncludeModule("yenisite.feedback")):?>
	<?$APPLICATION->IncludeComponent(
		"yenisite:feedback.add",
		"modal_feedback",
		array(
			"IBLOCK_TYPE" => "bitronic2pro_feedback",
			"IBLOCK" => "22",
			"NAME_FIELD" => "EMAIL",
			"COLOR_SCHEME" => "green",
			"TITLE" => "Обратная связь",
			"SUCCESS_TEXT" => "Спасибо! Ваше обращение принято. После обработки наш специалист свяжется с Вами.",
			"USE_CAPTCHA" => "Y",
			"SHOW_SECTIONS" => "N",
			"PRINT_FIELDS" => array(
				0 => "TEXT",
				1 => "ORDER_NUMBER",
				2 => "NAME",
				3 => "EMAIL",
				4 => "PHONE",
			),
			"AJAX_MODE" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "300",
			"ACTIVE" => "Y",
			"EVENT_NAME" => "FEEDBACK",
			"TEXT_REQUIRED" => "N",
			"TEXT_SHOW" => "N",
			"NAME" => "NAME",
			"PHONE" => "PHONE",
			"EMAIL" => "EMAIL",
			"FORM" => "form_feedback",
			"EMPTY" => $arParams["EMPTY"],
			"COMPONENT_TEMPLATE" => "modal",
			"SECTION_CODE" => "",
			"ELEMENT_ID" => "",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N"
		),
		false,
		array(
			"HIDE_ICONS" => "N"
		)
	);
?>
<? endif ?>