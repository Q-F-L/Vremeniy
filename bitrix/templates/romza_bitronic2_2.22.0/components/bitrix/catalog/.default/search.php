<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;

$APPLICATION->SetTitle(GetMessage("BITRONIC2_SEARCH_RESULTS"));
$this->setFrameMode(true);

global $rz_b2_options;

// include css and js
$asset = Asset::getInstance();
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/libs/flexGreedBannerSort.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/libs/flexGreedSort.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/3rd-party-libs/jquery.countdown.2.0.2/jquery.plugin.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/3rd-party-libs/jquery.countdown.2.0.2/jquery.countdown.min.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/initTimers.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/libs/UmTabs.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/pages/initSearchResultsPage.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/sliders/initPhotoThumbs.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/initCatalogHover.js");
CJSCore::Init(array('rz_b2_um_countdown', 'rz_b2_bx_catalog_item'));
if ('Y' == $rz_b2_options['wow-effect']) {
	$asset->addJs(SITE_TEMPLATE_PATH."/js/3rd-party-libs/wow.min.js");
}
if ($rz_b2_options['quick-view'] === 'Y') {
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/3rd-party-libs/jquery.mobile.just-touch.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/initMainGallery.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/toggles/initGenInfoToggle.js");
}
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/pages/initCatalogPage.js");

// Search category for catalog products
$catalogCategory = 'iblock_' . $arParams['IBLOCK_TYPE'];

// hack search request
if (empty($_GET['where']) || empty($_REQUEST['where'])) {
	$_GET['where'] = $_REQUEST['where'] = $catalogCategory;
}

if ($_GET['where'] === 'ALL' || $_REQUEST['where'] === 'ALL') {
	$_GET['where'] = $_REQUEST['where'] = '';
}

// fill params for bitrix:search.page
$arSearchPageParams = array(
	"RESTART" => "Y",
	"NO_WORD_LOGIC" => "Y",
	"USE_LANGUAGE_GUESS" => "N",
	"CHECK_DATES" => "Y",
	"USE_TITLE_RANK" => "N",
	"DEFAULT_SORT" => "rank",
	"FILTER_NAME" => "offerFilter",
	"arrFILTER" => array(
		0 => $catalogCategory,
		1 => "iblock_news"
	),
	"arrFILTER_".$catalogCategory => array($arParams["IBLOCK_ID"]),
	"arrFILTER_iblock_news" => array(
		0 => "all",
	),
	"SHOW_WHERE" => "Y",
	"arrWHERE" => array(
		0 => $catalogCategory,
		1 => "iblock_news",
	),
	"SHOW_WHEN" => "N",
	"PAGE_RESULT_COUNT" => 20,
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => GetMessage("BITRONIC2_SEARCH_RESULTS"),
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",

	"SEARCH_WITH_OFFERS" => false,
	"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE']
);

global $offerFilter;
$offerFilter = array();

$bOffers = false;
$whereBackup = $_REQUEST['where'];

// check catalog offers
do {
	if (!empty($_REQUEST['where']) && ($_REQUEST['where'] !== $catalogCategory)) break;
	if (!CModule::IncludeModule('catalog')) break;

	$arOfferIBlock = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
	if (!is_array($arOfferIBlock)) break;

	// fill params to search with offers
	$bOffers = true;
	$offerIBlockType = CIBlock::GetArrayByID($arOfferIBlock['IBLOCK_ID'], 'IBLOCK_TYPE_ID');
	$offerCategory = 'iblock_' . $offerIBlockType;

	if (in_array($offerCategory, $arSearchPageParams['arrFILTER'])) {
		$arSearchPageParams['arrFILTER_' . $offerCategory][] = $arOfferIBlock['IBLOCK_ID'];
	} else {
		$arSearchPageParams['arrFILTER_' . $offerCategory] = array(0 => $arOfferIBlock['IBLOCK_ID']);
		$arSearchPageParams['arrFILTER'][] = $offerCategory;
	}

	if (
		$catalogCategory === $_REQUEST['where'] &&
		$catalogCategory !== $offerCategory
	) {
		// make custom filter for search with offers
		// because catalog iblock and offer iblock has different types
		$arSearchPageParams['SEARCH_WITH_OFFERS'] = true;
		$offerFilter['MODULE_ID'] = 'iblock';
		$offerFilter['PARAM1'] = array($arParams['IBLOCK_TYPE'], $offerIBlockType);

		$_GET['where'] = $_REQUEST['where'] = '';
	}
} while (0);

// perform search, fill elements ID list

$arElements = $APPLICATION->IncludeComponent(
	"bitrix:search.page",
	"search",
	$arSearchPageParams,
	$component,
	array('HIDE_ICONS' => 'Y')
);

// return request param to original value
$_GET['where'] = $_REQUEST['where'] = $whereBackup;

if (empty($_GET['where'])) {
	$_GET['where'] = $_REQUEST['where'] = 'ALL';
}

if ($_REQUEST['where'] !== $catalogCategory) return;

// search made in catalog, output result through catalog.section
if (
	!empty($arElements) &&
	is_array($arElements)
) {
	if ($bOffers) {
		$arOffers = CCatalogSKU::getProductList($arElements, $arOfferIBlock['IBLOCK_ID']);

		if (is_array($arOffers)) {
			$arOffers = array_keys($arOffers);
			$arElements = array_diff($arElements, $arOffers);
		}
	}

	global $searchFilter;

	/**
	 * @var array $arSectionParams;
	 */
	include 'include/prepare_params_section.php';

	$arSearchParams = array(
		"FILTER_NAME" => "searchFilter",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(),
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"META_KEYWORDS" => "",
		"META_DESCRIPTION" => "",
		"BROWSER_TITLE" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",

		"ELEMENT_SORT_FIELD" => "",
		"ELEMENT_SORT_ORDER" => "",
		"ELEMENT_SORT_FIELD2" => "",
		"ELEMENT_SORT_ORDER2" => "",
		'SEARCH_PAGE' => 'Y'
	);
	$arSearchParams = array_merge($arSectionParams, $arSearchParams);


	$catalogClass  = 'catalog blocks active ';
	$catalogClass .= $arResult['HOVER-MODE'];

	$this->SetViewTarget('catalog_search');
	echo '<div class="'.$catalogClass.'" id="catalog_section" data-hover-effect="'.$arResult['HOVER-MODE'].'"  data-quick-view-enabled="false">';

	if (!empty($arElements)) {
		$searchFilter = array(
			"=ID" => $arElements,
		);

		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"blocks",
			$arSearchParams,
			$component,
			array('HIDE_ICONS' => 'Y')
		);
	}

	if ($bOffers && !empty($arOffers)) {
		$arSearchParams['IBLOCK_TYPE'] = $offerIBlockType;
		$arSearchParams['IBLOCK_ID'] = $arOfferIBlock['IBLOCK_ID'];
		unset($arSearchParams['DETAIL_URL']);

		$searchFilter = array('=ID' => $arOffers);

		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"blocks",
			$arSearchParams,
			$component,
			array('HIDE_ICONS' => 'Y')
		);
	}

	echo '</div>';
	$this->EndViewTarget('catalog_search');
} else {
	echo GetMessage("CT_BCSE_NOT_FOUND");
}

// additional sliders with products
$this->SetViewTarget('search_sliders');
if ('N' !== $rz_b2_options['block_search-viewed']
||  'N' !== $rz_b2_options['block_search-bestseller']
||  'N' !== $rz_b2_options['block_search-recommend']
) {
	$arPrepareParams = $arSectionParams;
	$arPrepareParams['RESIZER_SETS'] = array('RESIZER_SECTION' => $arSectionParams['RESIZER_SECTION']);
	$asset->addJs(SITE_TEMPLATE_PATH . '/js/custom-scripts/inits/sliders/initHorizontalCarousels.js');
}
if ('N' !== $rz_b2_options['block_search-viewed']) {
	include 'include/viewed_products.php';
}
if ('N' !== $rz_b2_options['block_search-bestseller']) {
	$arPrepareParams['HEADER_TEXT'] = $arParams['BIGDATA_BESTSELL_TITLE'] ?: GetMessage('BIGDATA_BESTSELL_TITLE_DEFAULT');
	$arPrepareParams['RCM_TYPE'] = 'bestsell';
	include 'include/bigdata.php';
}
if ('N' !== $rz_b2_options['block_search-recommend']) {
	$arPrepareParams['HEADER_TEXT'] = $arParams['BIGDATA_PERSONAL_TITLE'] ?: GetMessage('BIGDATA_PERSONAL_TITLE_DEFAULT');
	$arPrepareParams['RCM_TYPE'] = 'personal';
	include 'include/bigdata.php';
}
$this->EndViewTarget('search_sliders');
?>
