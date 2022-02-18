<?
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main", array(
	"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "4",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "2",
		"SECTION_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "604800",
		"CACHE_GROUPS" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"VIEW_MODE" => "TEXT",
		"SHOW_PARENT_NAME" => "N",
		"COMPONENT_TEMPLATE" => "main",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "UF_IMG_BLOCK_FOTO",
			2 => "",
		),
		"RESIZER_SECTION_ICON" => "10",
		"RESIZER_SECTION_LARGE" => "27",
		"RESIZER_SECTION_BIG" => "28",
		"PROP_OF_BIG_IMG" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);
