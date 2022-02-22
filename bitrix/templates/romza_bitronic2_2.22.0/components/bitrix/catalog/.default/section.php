<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Page\AssetLocation;
use Yenisite\Core\Tools;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
define("IS_CATALOG_LIST",true);

$this->setFrameMode(true);
if(defined("ERROR_404")) return;
global $rz_b2_options, $rz_current_sectionID;
// $view, $sort, $by, $pagen, $pagen_key, $page_count
include 'include/service_var.php';

global $rz_b2_options, $rz_current_sectionID;
include 'include/get_cur_section.php'; // @var $arCurSection
$rz_current_sectionID = $arCurSection['ID'];

// THIS EXPRESSION NEEDS TO BE CHANGED IF REVIEWS OR RELATED-CATEGORIES SHOULD BE ADDED
$noAside = ($arResult['MENU_CATALOG'] !== 'side' && ($arParams['USE_FILTER'] !== 'Y' || $arResult['FILTER_PLACE'] !== 'side'))
         ? ' no-aside'
         : '';

// advertising
$arBannerAreas = array('section_banner_single', 'section_banner_double', '');

if (!in_array($arParams['SECTION_BANNER_AREA_1'], $arBannerAreas)) $arParams['SECTION_BANNER_AREA_1'] = $arBannerAreas[0];
if (!in_array($arParams['SECTION_BANNER_AREA_2'], $arBannerAreas)) $arParams['SECTION_BANNER_AREA_2'] = $arBannerAreas[1];

$asset = Asset::getInstance();
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/libs/flexGreedBannerSort.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/libs/flexGreedSort.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/3rd-party-libs/jquery.countdown.2.0.2/jquery.plugin.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/3rd-party-libs/jquery.countdown.2.0.2/jquery.countdown.min.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/initTimers.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/libs/UmTabs.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/sliders/initPhotoThumbs.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/toggles/initGenInfoToggle.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/initCatalogHover.js");
$asset->addJs(SITE_TEMPLATE_PATH."/js/3rd-party-libs/nouislider.min.js");
CJSCore::Init(array('rz_b2_um_countdown', 'rz_b2_bx_catalog_item'));
if ('Y' === $rz_b2_options['quick-view']) {
	$asset->addJs(SITE_TEMPLATE_PATH."/js/3rd-party-libs/jquery.mobile.just-touch.min.js");
	$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/initMainGallery.js");
}
if ('Y' === $rz_b2_options['wow-effect']) {
	$asset->addJs(SITE_TEMPLATE_PATH."/js/3rd-party-libs/wow.min.js");
}
$asset->addJs(SITE_TEMPLATE_PATH."/js/custom-scripts/inits/pages/initCatalogPage.js");
$asset->addString('<script>RZB2.ajax.CatalogSection.ID = '. (int)$rz_current_sectionID .';</script>', false, AssetLocation::AFTER_JS);
?>
<main data-catalog-banner-pos="middle-to-top" class="container catalog-page<?=$noAside?>" id="catalog-page" data-page="catalog-page">
	<div class="row">
		<aside class="catalog-aside col-sm-12 col-md-3 col-xxl-2" id="catalog-aside">
			<div id="catalog-at-side" class="catalog-at-side minified">
				<?if($arResult['MENU_CATALOG'] == 'side' && $_REQUEST['rz_ajax'] !== 'y'):?>
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "EDIT_TEMPLATE" => "include_areas_template.php", "PATH" => SITE_DIR."include_areas/header/menu_catalog.php"), false, array("HIDE_ICONS"=>"Y"));?>
				<?endif?>
			</div>
			<div id="filter-at-side">
				<?
				if ('Y' == $arParams['USE_FILTER']) {
					if ($_GET['ajax'] == 'y' && isset($_SERVER['HTTP_BX_AJAX'])) {
						// for ajax filter
						include 'include/filter.php';
					}
					elseif ($arResult['FILTER_PLACE'] == 'side') {
						if ('Y' == $rz_b2_options['block_show_ad_banners']) {
                            if (\Bitrix\Main\Loader::includeModule('advertising')):
                                $APPLICATION->IncludeComponent(
                                    "bitrix:advertising.banner",
                                    "bitronic2",
                                    Array(
                                        "FILTER" => "Y",
                                        "TYPE" => $arParams['ADV_BANNER_FILTER_TYPE'] ?: 'b2_catalog_filter',
                                        "NOINDEX" => "Y",
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => "1000"
                                    ),
                                    $component,
                                    array("HIDE_ICONS" => "Y")
                                );
                            else:
                                $APPLICATION->IncludeComponent(
                                    "yenisite:proxy",
                                    "bitronic2",
                                    array(
                                        "NOINDEX" => "Y",
                                        "FILTER" => "Y",
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => "3600",
                                        "COMPONENT_TEMPLATE" => "bitronic2",
                                        "REMOVE_POSTFIX_IN_NAMES" => "N",
                                        "QUANTITY" => "1",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                                        'FILE' => $arParams['FILE_AD_BANNER_TOP'],
                                        'URL_BANNER' => $arParams['URL_BANNER_AD_BANNER_TOP'],
                                        'IMG_ALT' => $arParams['IMG_ALT_AD_BANNER_TOP'],
                                    ),
                                    $component,
                                    array("HIDE_ICONS" => "Y")
                                );
                            endif;
						}
						include 'include/filter.php';
					}
				}
				?>
			</div>
			<?
			/* TODO
			<div class="reviews hidden-xs hidden-sm">
				..............................
			</div><!-- /.reviews -->
			*/?>
			<?
			/* TODO
			<div class="related-categories hidden-xs hidden-sm">
				..............................
			</div>
			*/?>
		</aside>
		<div class="catalog-main-content col-sm-12 col-md-9 col-xxl-10">
			<?
			/* TODO
			<nav class="breadcrumbs">
			<!-- same breadcrumbs as always, but without dummy for
			#catalog-at-side -->
				..............................
			</nav>
			*/?>
            <?php
                $filter = ['IBLOCK_ID' => $arParams["IBLOCK_ID"]];
                if ($arResult["VARIABLES"]["SECTION_ID"] != null)
                    $filter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
                else
                    $filter["CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

                $rsSect = \CIBlockSection::GetList(array('left_margin' => 'asc'), $filter);
                $result = $rsSect->GetNext();
            ?>

            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "PATH" => SITE_DIR."include_areas/catalog/section_seo.php",
                    "COMPONENT_TEMPLATE" => ".default",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "AREA_FILE_SHOW" => "file",
                    "EDIT_TEMPLATE" => "",
                    // "ID" => $result["ID"],
                    "ID" => $result["ID"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"]
                ),
                false,
                array(
                    "HIDE_ICONS" => "N"
                )
            );?>

			<?
			$showDescription = $rz_b2_options['block_list-section-desc'];
			if ($arParams['SHOW_DESCRIPTION_TOP'] == 'N') {
				$showDescription = 'N';
			}
			if ($rz_b2_options['block_list-sub-sections'] == "Y"
				|| ($rz_b2_options['block_list-section-desc'] == "Y" && $arParams['SHOW_DESCRIPTION_TOP'] != 'N')
			) {
				include 'include/section_list.php';
			}

			?><?
			Tools::IncludeArea('catalog', $arParams['SECTION_BANNER_AREA_1'], false, true, $rz_b2_options['block_show_ad_banners']);
			?><?

			$dynamicArea = new \Bitrix\Main\Page\FrameStatic("catalog_hits_dynamic");
			$dynamicArea->setAnimation(true);
			$dynamicArea->startDynamicArea();
			if ($rz_b2_options['block_list-hits'] == 'Y' && $_REQUEST['rz_ajax'] !== 'y' && Bitrix\Main\Loader::includeModule('catalog')) {
				$arResult['IBLOCK_SECTION_ID'] = $arResult['IBLOCK_SECTION_ID'] ? : $rz_current_sectionID;
			    include 'include/catalog_hits.php';
				Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/back-end/visual/hits.js");
			}
			$dynamicArea->finishDynamicArea();

			?><?
			Tools::IncludeArea('catalog', $arParams['SECTION_BANNER_AREA_2'], false, true, $rz_b2_options['block_show_ad_banners']);
			?><?

			if ($arParams['LIST_BRAND_USE'] != 'N'):
				$brandsId = 'bx_dynamic_'.$this->randString(20);
				?>

			<div class="brands-catalog hidden-xs wow fadeIn" id="<?=$brandsId?>"><?

				$dynamicArea = new \Bitrix\Main\Page\FrameStatic("catalog_brands_dynamic");
				$dynamicArea->setAnimation(true);
				$dynamicArea->setContainerID($brandsId);
				$dynamicArea->startDynamicArea();
				$APPLICATION->ShowViewContent('catalog_brands');
				$dynamicArea->finishDynamicArea();
				?>

			</div><!-- /.brands-catalog -->
			<div class="brands-catalog-toggle-wrap">
				<a href="#<?=$brandsId?>"
				   class="pseudolink-bd link-std collapsed hide" data-toggle="height-collapse"
				   data-when-expanded="<?=GetMessage('RZ_COLLAPSE_CATALOG_BRANDS')?>"
				   data-when-collapsed="<?=GetMessage('RZ_EXPAND_CATALOG_BRANDS')?>"></a>
			</div>
			<? endif ?>

			<div id="filter-at-top">
				<?
				if ('Y' == $arParams['USE_FILTER'] && $arResult['FILTER_PLACE'] == 'top') {
					if ('Y' == $rz_b2_options['block_show_ad_banners']) {
                        if (\Bitrix\Main\Loader::includeModule('advertising')):
                            $APPLICATION->IncludeComponent(
                                "bitrix:advertising.banner",
                                "bitronic2",
                                Array(
                                    "FILTER" => "Y",
                                    "TYPE" => $arParams['ADV_BANNER_FILTER_TYPE'] ?: 'b2_catalog_filter',
                                    "NOINDEX" => "Y",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "1000"
                                ),
                                $component,
                                array("HIDE_ICONS" => "Y")
                            );
                        else:
                            $APPLICATION->IncludeComponent(
                                "yenisite:proxy",
                                "bitronic2",
                                array(
                                    "FILTER" => "Y",
                                    "NOINDEX" => "Y",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "3600",
                                    "COMPONENT_TEMPLATE" => "bitronic2",
                                    "REMOVE_POSTFIX_IN_NAMES" => "N",
                                    "QUANTITY" => "1",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    'FILE' => $arParams['FILE_AD_BANNER_MIDDLE'],
                                    'URL_BANNER' => $arParams['URL_BANNER_AD_BANNER_MIDDLE'],
                                    'IMG_ALT' => $arParams['IMG_ALT_AD_BANNER_MIDDLE'],
                                ),
                                $component,
                                array("HIDE_ICONS" => "Y")
                            );
                        endif;
					}
					include 'include/filter.php';
				}
				?>
			</div>


			<div class="sort-n-view for-catalog">
                <?if ($rz_b2_options['block_show_sort_block'] != 'N'):?>
				    <? include 'include/sort.php' ?>
                <?endif?>
				<? include 'include/view.php' ?>
			</div>

<?
include 'include/pagination.php';
?>
<?
$catalogClass  = 'catalog ';
$catalogClass .= ($view == 'table' ? 'catalog-table' : $view);
$catalogClass .= ' active';
$catalogClass .= ($arParams['HIDE_ICON_SLIDER'] === 'Y' ? ' thumbs-disabled' : '');

global ${$arParams["FILTER_NAME"]};
if(!empty(${$arParams["FILTER_NAME"]}))
{
	$arSkipFilters = array('FACET_OPTIONS');

	$arDiff = array_diff(array_keys(${$arParams["FILTER_NAME"]}) , $arSkipFilters);
	$bFilterSet = 0 < count($arDiff);

	$arParams["CACHE_FILTER"] = $bFilterSet ? $arParams['CACHE_FILTER'] : 'Y';

	unset($arSkipFilters, $arDiff);
    if (array_key_exists('rz_all_elements', $_REQUEST) && $_REQUEST['rz_all_elements'] === 'y') {
        unset(${$arParams["FILTER_NAME"]}['FACET_OPTIONS']);
    }
}


/**
 * @var array $arSectionParams
 */
include 'include/prepare_params_section.php';

$arSectionParams['FILTER_SET'] = $bFilterSet;
$arSectionParams['BANNER_PLACE'] = true;

?>
        <?ob_start()?>
            <?\Yenisite\Core\Tools::IncludeArea('catalog','banner_in_items')?>
        <?$banner = ob_get_clean();?>
<?if (strpos($banner,'banners-place') === false){
    $arSectionParams['BANNER_PLACE'] = false;
}?>
        <?ob_start()?>
			<div class="<?=$catalogClass?>" id="catalog_section" data-hover-effect="<?= $arResult['HOVER-MODE'] ?>"  data-quick-view-enabled="false"><!--
				--><?$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						$view,
						$arSectionParams, //prepare_params_section.php
						$component
				);?><!--
			--></div>
        <?$content = ob_get_clean();?>

        <?$content = str_replace('#BANNER_PLACE#',$banner,$content)?>
        <?=$content?>
            <?
			include 'include/pagination.php';
			?>

			<?
			/* TODO
			<div class="show-not-in-stock-wrap">
				..............................
			</div>
			*/
			$showDescription = $rz_b2_options['block_list-section-desc'];
			if ($arParams['SHOW_DESCRIPTION_BOTTOM'] == 'N') {
				$showDescription = 'N';
			}
			if ($rz_b2_options['block_list-section-desc'] == "Y" && $arParams['SHOW_DESCRIPTION_BOTTOM'] == 'Y')
			{
				$bDescBottom = true;
				include 'include/section_list.php';
			}
			?>
			<? if ($rz_b2_options['block_show_ad_banners'] == 'Y'): ?>
				<div class="banners">
					<?
					$arParams['ADV_BANNER_TYPE'] = $arParams['ADV_BANNER_TYPE'] ?: 'b2_catalog_bottom';
					?>
					<?
                    if (\Bitrix\Main\Loader::includeModule('advertising')) {
                        $APPLICATION->IncludeComponent(
                            "bitrix:advertising.banner",
                            "catalog_bottom",
                            Array(
                                "TYPE" => $arParams['ADV_BANNER_TYPE'],
                                "NOINDEX" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "1000"
                            ),
                            $component,
                            array("HIDE_ICONS" => "Y")
                        );
                    }else {
                        $APPLICATION->IncludeComponent(
                            "yenisite:proxy",
                            "catalog_bottom",
                            array(
                                "NOINDEX" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "COMPONENT_TEMPLATE" => "bitronic2",
                                "REMOVE_POSTFIX_IN_NAMES" => "N",
                                "QUANTITY" => "1",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO",
                                'FILE' => $arParams['FILE_AD_BANNER_BOTTOM'],
                                'URL_BANNER' => $arParams['URL_BANNER_AD_BANNER_BOTTOM'],
                                'IMG_ALT' => $arParams['IMG_ALT_AD_BANNER_BOTTOM'],
                            ),
                            $component,
                            array("HIDE_ICONS" => "Y")
                        );
                    }
                    ?>
				</div>
			<? endif ?>
        <!--10 07 17
        <div class="spec_chars_block">
            <p class="title-h4">Технические характеристики Стеклоподъемник</p>

            <div class="line_wrap">
                <p class="line_ttl"><span>Модель</span></p>
                <p class="value">Mitsubishi Pajero 4</p>
            </div>

        </div>
        <!---->
            <?php
            if($GLOBALS['metaSection']['BOTTOM_TEXT'])
            {
                ?>
                <div class="spec_chars_block">
                    <?=$GLOBALS['metaSection']['BOTTOM_TEXT']?>
                </div>
                <?
            }
            ?>
        </div><!-- /.catalog-main-content.col-sm-12.col-md-9 -->
	</div><!-- /.row -->

</main>

<?
if($GLOBALS['metaSection']['META_DESCRIPTION'])
{
    $APPLICATION->SetPageProperty("description", $GLOBALS['metaSection']['META_DESCRIPTION']);
}
if($GLOBALS['metaSection']['META_KEYWORDS'])
{
    $APPLICATION->SetPageProperty("keywords", $GLOBALS['metaSection']['META_KEYWORDS']);
}
if($GLOBALS['metaSection']['META_TITLE'])
{
    $APPLICATION->SetPageProperty("title", $GLOBALS['metaSection']['META_TITLE']);
}

if($GLOBALS['metaSection']['META_NOITEMS_DESCRIPTION'])
{
    $APPLICATION->SetPageProperty("description", $GLOBALS['metaSection']['META_NOITEMS_DESCRIPTION']);
}

if($GLOBALS['metaSection']['META_NOITEMS_KEYWORDS'])
{
    $APPLICATION->SetPageProperty("keywords", $GLOBALS['metaSection']['META_NOITEMS_KEYWORDS']);
}

if($GLOBALS['metaSection']['META_NOITEMS_TITLE'])
{
    $APPLICATION->SetPageProperty("title", $GLOBALS['metaSection']['META_NOITEMS_TITLE']);
}

if($GLOBALS['metaSection']['META_NOITEMS_H1'])
{
    $APPLICATION->SetTitle($GLOBALS['metaSection']['META_NOITEMS_H1']);
}

if($GLOBALS['metaSection']['META_PARENT_DESCRIPTION'])
{
    $APPLICATION->SetPageProperty("description", $GLOBALS['metaSection']['META_PARENT_DESCRIPTION']);
}
if($GLOBALS['metaSection']['META_PARENT_KEYWORDS'])
{
    $APPLICATION->SetPageProperty("keywords", $GLOBALS['metaSection']['META_PARENT_KEYWORDS']);
}
if($GLOBALS['metaSection']['META_PARENT_TITLE'])
{
    $APPLICATION->SetPageProperty("title", $GLOBALS['metaSection']['META_PARENT_KEYWORDS']);
}
if($GLOBALS['metaSection']['META_PARENT_H1'])
{
    $APPLICATION->SetTitle($GLOBALS['metaSection']['META_PARENT_H1']);
}
?>