<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\ModuleManager;
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

//no whitespace in this file!!!!!!
$this->setFrameMode(true);

// @var $moduleId
// @var $moduleCode
include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . '/include/debug_info_dynamic.php';

$this->SetViewTarget('catalog_paginator');
	echo $arResult["NAV_STRING"];
$this->EndViewTarget();

if(empty($arResult['ITEMS']))
	return;

$arJsCache = CRZBitronic2CatalogUtils::getJSCache($component);

$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$bStores = $arParams["USE_STORE"] == "Y" && Bitrix\Main\ModuleManager::isModuleInstalled("catalog");
$bHoverMode = $arParams['HOVER-MODE'] == 'detailed-expand';
$showBannerOn = ceil(count($arResult['ITEMS']) / 2) ;
$count = 0;

foreach($arResult['ITEMS'] as $arItem):
	$this->AddEditAction($templateName.'-'.$arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($templateName.'-'.$arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($templateName.'-'.$arItem['ID']);
	$arItemIDs = array(
		'ID' => $strMainID,
		'PICT' => $strMainID.'_pict',
		'SECOND_PICT' => $strMainID.'_secondpict',
		'STICKER_ID' => $strMainID.'_sticker',
		'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
		'QUANTITY_CONTAINER' => $strMainID.'_quantity_container',
		'QUANTITY' => $strMainID.'_quantity',
		'QUANTITY_DOWN' => $strMainID.'_quant_down',
		'QUANTITY_UP' => $strMainID.'_quant_up',
		'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
		'BUY_LINK' => $strMainID.'_buy_link',
		'BUY_ONECLICK' => $strMainID.'_buy_oneclick',
		'BASKET_ACTIONS' => $strMainID.'_basket_actions',
		'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
		'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
		'COMPARE_LINK' => $strMainID.'_compare_link',
		'FAVORITE_LINK' => $strMainID.'_favorite_link',

		'PRICE_CONTAINER' => $strMainID.'_price_container',
		'OLD_PRICE' => $strMainID.'_old_price',
		'PRICE' => $strMainID.'_price',
		'PRICE_ADDITIONAL' => $strMainID.'_price_additional',
		'DSC_PERC' => $strMainID.'_dsc_perc',
		'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
		'PROP_DIV' => $strMainID.'_sku_tree',
		'PROP' => $strMainID.'_prop_',
		'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
		'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
		'AVAILABILITY' => $strMainID . '_availability',
		'AVAILABILITY_MOBILE' => $strMainID . '_availability_mobile',
	);
	$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

	$productTitle = (
		!empty($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $arItem['NAME']
	);
	$imgTitle = (
		!empty($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'])
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $arItem['NAME']
	);
	$bShowStore = $bStores && !$arItem['bOffers'];
    $bExpandedStore = $arParams['PRODUCT_AVAILABILITY_VIEW'];
	$bShowOneClick = $arParams['DISPLAY_ONECLICK'] && !$arItem['bOffers'];
	
	$availableOnRequest = $arItem['ON_REQUEST'];
	$availableClass = (
		!$arItem['CAN_BUY'] && !$availableOnRequest
		? 'out-of-stock'
		: (
			$arItem['FOR_ORDER'] || $availableOnRequest
			? 'available-for-order'
			: 'in-stock'
		)
	);
	if ($availableOnRequest) $arItem['CAN_BUY'] = false;

	$bEmptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
	$bBuyProps = ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$bEmptyProductProperties);

	$bCatchbuy = ($arParams['SHOW_CATCHBUY'] && $arItem['CATCHBUY']);
	if ($arItem['SHOW_SLIDER']) {
		$arItem['SHOW_SLIDER'] = $arParams['SHOW_GALLERY_THUMB'] == 'Y';
	}
	?>
    <?if ($count >= $showBannerOn && $arParams['BANNER_PLACE']):?>
        <?$showBannerOn = 99999999999999;?>
        #BANNER_PLACE#
    <?endif?>
    <div class="catalog-item-wrap active<?= ($arItem['VIP'] ? ' big-item' : '') ?>" id="<?=$arItemIDs['ID']?>">
        <div class="catalog-item blocks-item wow fadeIn">
			<div class="photo-wrap <?=!$arItem['SHOW_SLIDER'] ? ' no-thumbs' : ''?>">
				<div class="photo">
					<a title="<?= $imgTitle ?>" href="<?=$arItem['DETAIL_PAGE_URL']?>">
						<img class="lazy" data-original="<?=$arItem['PICTURE_PRINT']['SRC']?>" src="<?=ConsVar::showLoaderWithTemplatePath()?>" alt="<?=$arItem['PICTURE_PRINT']['ALT']?>" title="<?= $imgTitle ?>">
					</a><?
					if($bCatchbuy):?>

					<div class="countdown">
						<div class="timer-wrap"><?

						if (!empty($arItem['CATCHBUY']['ACTIVE_TO'])): ?>

							<div class="timer" data-until="<?=str_replace('XXX', 'T', ConvertDateTime($arItem['CATCHBUY']['ACTIVE_TO'], 'YYYY-MM-DDXXXhh:mm:ss'))?>"></div><?

						endif ?>

							<div class="already-sold">
								<div class="value countdown-amount"><?=(int)$arItem['CATCHBUY']['PERCENT']?>%</div>
								<div class="countdown-period"><?=GetMessage('BITRONIC2_SOLD')?></div>
							</div>
							<div class="already-sold__track">
								<div class="bar" style="width: <?=floatval($arItem['CATCHBUY']['PERCENT'])?>%"></div>
							</div>
						</div>
					</div><?

					endif?>

					<?=$arItem['yenisite:stickers']?>
					<div class="quick-view-switch" data-toggle="modal" data-target="#modal_quick-view">
						<span class="quick-view-fake-btn">
							<span class="text"><?=GetMessage('BITRONIC2_BLOCKS_QUICK_VIEW')?></span>
						</span>
						<i class="flaticon-zoom62"></i>
					</div>
				</div><!-- .photo -->
				<?if($arItem['SHOW_SLIDER']):?>
					<div class="photo-thumbs">
						<div class="slidee">
							<?foreach($arItem['MORE_PHOTO'] as $arPhoto):
								?><div class="photo-thumb">
									<img class="lazy"
                                         data-original="<?=CResizer2Resize::ResizeGD2($arPhoto['SRC'], $arParams['RESIZER_SECTION_ICON'])?>"
                                         src="<?=ConsVar::showLoaderWithTemplatePath()?>"
										alt="<?=strlen($arPhoto['DESCRIPTION']) > 0 ? $arPhoto['DESCRIPTION'] : $arItem['PICTURE_PRINT']['ALT']?>"
                                         title="<?=strlen($arPhoto['DESCRIPTION']) > 0 ? $arPhoto['DESCRIPTION'] : $arItem['PICTURE_PRINT']['ALT']?>"
										data-medium-image="<?=CResizer2Resize::ResizeGD2($arPhoto['SRC'], $arParams['RESIZER_SECTION'])?>"
									>
								</div><?
							endforeach;?>
						</div>
						<?if($arItem['MORE_PHOTO_COUNT'] > 4):?>
							<div class="carousel-dots"></div>
						<?endif?>
					</div>
				<?endif?>
			</div><!-- /.photo-wrap -->
			<div class="main-data">
				<div class="name">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="link"><span class="text"><?=$productTitle?></span></a>
				</div>
				<div class="art-rate clearfix">
					<? if ($arParams['SHOW_ARTICLE'] == 'Y'): ?>
						<?if(!empty($arItem['PROPERTIES'][$arParams['ARTICUL_PROP']]['VALUE'])):?>
							<span class="art"><?=$arItem['PROPERTIES'][$arParams['ARTICUL_PROP']]['NAME']?>: <strong><?=is_array($arItem['PROPERTIES'][$arParams['ARTICUL_PROP']]['VALUE']) ? implode(' / ', $arItem['PROPERTIES'][$arParams['ARTICUL_PROP']]['VALUE']) : $arItem['PROPERTIES'][$arParams['ARTICUL_PROP']]['VALUE']?></strong></span>
						<?endif?>
					<? endif ?>
					<? if ($arParams['SHOW_STARS'] == 'Y'): ?>
						<?$APPLICATION->IncludeComponent("bitrix:iblock.vote", "stars", array(
							"IBLOCK_TYPE" => $arItem['IBLOCK_TYPE_ID'],
							"IBLOCK_ID" => $arItem['IBLOCK_ID'],
							"ELEMENT_ID" => $arItem['ID'],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"MAX_VOTE" => "5",
							"VOTE_NAMES" => array("1", "2", "3", "4", "5"),
							"SET_STATUS_404" => "N",
							),
							$component, array("HIDE_ICONS"=>"Y")
						);
						?><?
					endif
					?><?
						$availableID = &$arItemIDs['AVAILABILITY'];
						$availableFrame = true;
						$availableForOrderText = &$arItem['PROPERTIES']['RZ_FOR_ORDER_TEXT']['VALUE'];
						$availableItemID = &$arItem['ID'];
						$availableMeasure = &$arItem['CATALOG_MEASURE_NAME'];
						$availableQuantity = &$arItem['CATALOG_QUANTITY'];
						$availableStoresPostfix = 'blocks';
						$availableSubscribe = $arItem['bOffers'] ? 'N' : $arItem['CATALOG_SUBSCRIBE'];
						include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/include/availability_info.php';
					?>
				</div>
				<div class="prices" id="<?=$arItemIDs['PRICE_CONTAINER']?>">
					<? $frame = $this->createFrame($arItemIDs['PRICE_CONTAINER'], false)->begin(CRZBitronic2Composite::insertCompositLoader()) ?>
					<div class="<?=(empty($availableOnRequest)?'':' invisible')?>">
						<span class="price-old" id="<?=$arItemIDs['OLD_PRICE']?>">
							<? if($arItem['MIN_PRICE']['DISCOUNT_DIFF'] > 0 && $arParams['SHOW_OLD_PRICE'] == 'Y'): ?>
								<?=CRZBitronic2CatalogUtils::getElementPriceFormat($arItem['MIN_PRICE']['CURRENCY'], $arItem['MIN_PRICE']['VALUE'], $arItem['MIN_PRICE']['PRINT_VALUE']);?>
							<? endif ?>
						</span>
						<span class="price" id="<?=$arItemIDs['PRICE']?>">
								<?=($arItem['bOffers'] && $arItem['bOffersNotEqual']) ? GetMessage('BITRONIC2_BLOCKS_FROM') : ''?>
								<?=CRZBitronic2CatalogUtils::getElementPriceFormat($arItem['MIN_PRICE']['CURRENCY'], $arItem['MIN_PRICE']['DISCOUNT_VALUE'], $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']);?>
						</span>
					</div>
					<div id="<?= $arItemIDs['PRICE_ADDITIONAL'] ?>" class="additional-price-container <?=(empty($availableOnRequest)&&CRZBitronic2Settings::isPro()?'':' invisible')?>"><?
						if (count($arItem['PRICES']) > 1 && CRZBitronic2Settings::isPro()):?>

						<div class="wrapper baron-wrapper additional-prices-wrap">
							<div class="scroller scroller_v">
                                <? foreach ($arItem['PRICES'] as $priceCode => $arPrice):?>
                                    <? if ($arResult['PRICES'][$priceCode]['CAN_VIEW'] == false) continue; ?>
                                    <? if ($arPrice['DISCOUNT_VALUE'] <= 0) continue; ?>

                                    <div class="additional-price-type <?=$arPrice['PRICE_ID'] == $arItem['MIN_PRICE']['PRICE_ID'] ? 'current' : ''?>">
                                        <span class="price-desc"><?=$arResult['PRICES'][$priceCode]['TITLE']?>:</span>
                                        <span class="price"><?if(!empty($arItem['OFFERS'])) echo GetMessage('RZ_OT')?><?
                                            echo CRZBitronic2CatalogUtils::getElementPriceFormat(
                                                $arPrice['CURRENCY'],
                                                $arPrice['DISCOUNT_VALUE'],
                                                $arPrice['PRINT_DISCOUNT_VALUE']
                                            );
                                            ?></span>
                                    </div>
                                <? endforeach ?>

								<div class="scroller__track scroller__track_v">
									<div class="scroller__bar scroller__bar_v"></div>
								</div>
							</div>
						</div><?

						endif?>

					</div>
					<? $frame->end() ?>
				</div>
				<?
				$availableID = &$arItemIDs['AVAILABILITY_MOBILE'];
				$availableFrame = true;
				$availableForOrderText = &$arItem['PROPERTIES']['RZ_FOR_ORDER_TEXT']['VALUE'];
				$availableItemID = &$arItem['ID'];
				$availableMeasure = &$arItem['CATALOG_MEASURE_NAME'];
				$availableQuantity = &$arItem['CATALOG_QUANTITY'];
				$availableStoresPostfix = 'blocks_mobile';
				$availableSubscribe = $arItem['bOffers'] ? 'N' : $arItem['CATALOG_SUBSCRIBE'];
				include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/include/availability_info.php';
				?>
<?
// ***************************************
// *********** BUY WITH PROPS ************
// ***************************************
if ($bBuyProps):
?>
				<div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>">
<?
		if (!empty($arItem['PRODUCT_PROPERTIES_FILL']))
		{
			foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
			{
?>
					<input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
<?
				if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
					unset($arItem['PRODUCT_PROPERTIES'][$propID]);
			}
		}
		$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
?>
				</div>
<? endif ?>
				<?
				$bBuyButton      = false;
				$bCompareButton  = false;
				$bFavoriteButton = false;
				$bQuantityInput  = false;

				if ($bHoverMode) {
					ob_start();
				}
				?>
				<?if ('Y' == $arParams['USE_PRODUCT_QUANTITY'] && !$arItem['bOffers'] && $arItem['CAN_BUY'] && (!$bBuyProps || $emptyProductProperties) && $arParams['SHOW_BUY_BTN']):?>
					<form action="#" method="post" class="quantity-counter"
						data-tooltip
						data-placement="bottom"
						title="<?=$arItem['CATALOG_MEASURE_NAME']?>">
						<!-- parent must have class .quantity-counter! -->
						<button type="button" class="btn-silver quantity-change decrease" id="<?=$arItemIDs['QUANTITY_DOWN']?>"><span class="minus"></span></button>
						<input type="text" class="quantity-input textinput" value="<?=$arItem['CATALOG_MEASURE_RATIO']?>" id="<?=$arItemIDs['QUANTITY']?>">
						<button type="button" class="btn-silver quantity-change increase" id="<?=$arItemIDs['QUANTITY_UP']?>"><span class="plus"></span></button>
					</form>
					<? $bQuantityInput = true ?>
				<?endif?>
				<div class="action-buttons" id="<?=$arItemIDs['BASKET_ACTIONS']?>">
					<? $frame = $this->createFrame($arItemIDs['BASKET_ACTIONS'], false)->begin(CRZBitronic2Composite::insertCompositLoader()) ?>
					<div class="xs-switch">
						<i class="flaticon-arrow128 when-closed"></i>
						<i class="flaticon-key22 when-opened"></i>
					</div>
					<?if ($arParams['DISPLAY_FAVORITE'] && !$arItem['bOffers']):?>
						<button 
							type="button" 
							class="btn-action favorite" 
							data-favorite-id="<?=$arItem['ID']?>" 
							data-tooltip title="<?=GetMessage('BITRONIC2_BLOCKS_ADD_TO_FAVORITE')?>"
							id="<?=$arItemIDs['FAVORITE_LINK']?>">
							<i class="flaticon-heart3"></i>
						</button>
						<? $bFavoriteButton = true ?>
					<?endif?>
					<?if ($arParams['DISPLAY_COMPARE_SOLUTION'] && $arItem['CATALOG_TYPE'] != 4):?>
						<button 
							type="button" 
							class="btn-action compare" 
							data-compare-id="<?=$arItem['ID']?>" 
							data-tooltip title="<?=GetMessage('BITRONIC2_BLOCKS_ADD_TO_COMPARE')?>" 
							id="<?=$arItemIDs['COMPARE_LINK']?>">
							<i class="flaticon-balance3"></i>
						</button>
						<? $bCompareButton = true ?>
					<?endif?>
					<?if ($arParams['SHOW_BUY_BTN']):?>
					<? $bBuyButton = true ?>
					<div class="btn-buy-wrap text-only">
						<?if($arItem['bOffers'] || ($bBuyProps && !$emptyProductProperties && $arItem['CAN_BUY'])):?>
							<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="btn-action buy when-in-stock">
								<i class="flaticon-shopping109"></i>
								<span class="text"><?=COption::GetOptionString($moduleId, 'button_text_offers')?></span>
							</a>
						<?else:?>
							<?if($arItem['CAN_BUY']):?>
								<button type="button" class="btn-action buy when-in-stock" id="<?=$arItemIDs['BUY_LINK']?>" data-product-id="<?=$arItem['ID']?>">
									<i class="flaticon-shopping109"></i>
									<span class="text"><?=COption::GetOptionString($moduleId, 'button_text_buy')?></span>
									<span class="text in-cart"><?=COption::GetOptionString($moduleId, 'button_text_incart')?></span>
								</button>
							<?elseif($availableOnRequest):?>
								<button type="button" class="btn-action buy when-in-stock" data-measure-name="<?=$arItem['CATALOG_MEASURE_NAME']?>"
								        data-product-id="<?=$arItem['ID']?>" data-toggle="modal" data-target="#modal_contact_product">
									<i class="flaticon-speech90"></i>
									<span class="text"><?=COption::GetOptionString($moduleId, 'button_text_request')?></span>
								</button>
							<?else:?>
								<span class="when-out-of-stock"><?= COption::GetOptionString($moduleId, 'button_text_na') ?></span>
								<? $bBuyButton = false ?>
							<?endif?>
						<?endif?>
					</div>
					<?endif?>
					<? $frame->end() ?>
				</div>
				<? $frame = $this->createFrame()->begin(CRZBitronic2Composite::insertCompositLoader()) ?>
					<?if($arItem['CAN_BUY'] && $bShowOneClick && !$arItem['bOffers'] && (!$bBuyProps || $emptyProductProperties)):?>
						<button id="<?= $arItemIDs['BUY_ONECLICK'] ?>" type="button" class="action one-click-buy"
								data-toggle="modal" data-target="#modal_quick-buy" data-id="<?= $arItem['ID'] ?>"
								data-props="<?= \Yenisite\Core\Tools::GetEncodedArParams($arParams['OFFER_TREE_PROPS']) ?>">
							<i class="flaticon-shopping220"></i>
							<span class="text"><?=GetMessage('BITRONIC2_BLOCKS_ONECLICK')?></span>
						</button>
					<?endif?>
				<? $frame->end() ?>
				<?
				if ($bHoverMode) {
					$htmlButtons = ob_get_clean();
				}
				?>
			</div>
			<?
			if (
				$bHoverMode &&
				(
					$bBuyButton || $bCompareButton ||
					$bFavoriteButton || $bQuantityInput ||
					!empty($arItem['DISPLAY_PROPERTIES']) ||
					!empty($arItem['PREVIEW_TEXT'])
				)
			):
			?>

			<div class="description full-view">
				<?= $htmlButtons ?>
				<? if (!empty($arItem['DISPLAY_PROPERTIES'])) : ?>
				<dl class="techdata">
					<?foreach($arItem['DISPLAY_PROPERTIES'] as $arProp):?>
						<dt><?=$arProp['NAME']?></dt>
						<dd><?=strip_tags(is_array($arProp['DISPLAY_VALUE']) ? implode(' / ',$arProp['DISPLAY_VALUE']) : $arProp['DISPLAY_VALUE'])?></dd>
					<?endforeach?>
				</dl>
				<? endif ?>
				<div class='desc_text_wp'><?=$arItem['PREVIEW_TEXT']?></div>
			</div>
			<? endif ?>
				
			<?php // ADMIN INFO
			include 'admin_info.php'; 
			?>
		</div><!-- /.catalog-item.blocks-item -->
		<?
		$arJSParams = array(
			'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
			'SHOW_QUANTITY' => ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'),
			'SHOW_ADD_BASKET_BTN' => false,
			'SHOW_BUY_BTN' => false,
			'SHOW_ABSENT' => false,
			'SHOW_SKU_PROPS' => false,
			'SECOND_PICT' => $arItem['SECOND_PICT'],
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE_SOLUTION'],
			'DISPLAY_FAVORITE' => $arParams['DISPLAY_FAVORITE'],
			'REQUEST_URI' => $arItem['DETAIL_PAGE_URL'],//$_SERVER["REQUEST_URI"], need for AJAX to work on search page
			'SCRIPT_NAME' => $_SERVER["SCRIPT_NAME"],
			'DEFAULT_PICTURE' => array(
				'PICTURE' => $arItem['PRODUCT_PREVIEW'],
				'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
			),
			'VISUAL' => array(
				'ID' => $arItemIDs['ID'],
				'PICT_ID' => $arItemIDs['PICT'],
				'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
				'QUANTITY_ID' => $arItemIDs['QUANTITY'],
				'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
				'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
				'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
				'PRICE_ID' => $arItemIDs['PRICE'],
				'TREE_ID' => $arItemIDs['PROP_DIV'],
				'TREE_ITEM_ID' => $arItemIDs['PROP'],
				'BUY_ID' => $arItemIDs['BUY_LINK'],
				'BUY_ONECLICK' => $arItemIDs['BUY_ONECLICK'],
				'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
				'DSC_PERC' => $arItemIDs['DSC_PERC'],
				'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
				'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
				'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
				'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV'],
				'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
				'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK'],
				'FAVORITE_ID' => $arItemIDs['FAVORITE_LINK']
			),
			'BASKET' => array(
				'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
				'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
				'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
				'EMPTY_PROPS' => $bEmptyProductProperties,
				'SKU_PROPS' => $arItem['OFFERS_PROP_CODES'],
				'BASKET_URL' => $arParams['BASKET_URL'],
				'ADD_URL_TEMPLATE' => $arResult['ADD_URL_TEMPLATE'],
				'BUY_URL_TEMPLATE' => $arResult['BUY_URL_TEMPLATE']
			),
			'PRODUCT' => array(
				'ID' => $arItem['ID'],
				'IBLOCK_ID' => $arItem['IBLOCK_ID'],
				'NAME' => $productTitle,
				'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
				'CAN_BUY' => $arItem["CAN_BUY"],
				'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
				'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
				'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
				'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
				'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
				'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL'],
				'BASIS_PRICE' => $arItem['MIN_BASIS_PRICE'],
				'PRICE_MATRIX' => $arItem['PRICE_MATRIX']
			),
			'OFFERS' => array(),
			'OFFER_SELECTED' => 0,
			'TREE_PROPS' => array(),
			'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
		);
		if ($arParams['DISPLAY_COMPARE_SOLUTION'])
		{
			$arJSParams['COMPARE'] = array(
				'COMPARE_URL_TEMPLATE' => $arResult['COMPARE_URL_TEMPLATE'],
				'COMPARE_URL_TEMPLATE_DEL' => $arResult['COMPARE_URL_TEMPLATE_DEL'],
				'COMPARE_PATH' => $arParams['COMPARE_PATH']
			);
		}
		if ($arParams['DISPLAY_FAVORITE'])
		{
			$arJSParams['FAVORITE'] = array(
				'FAVORITE_URL_TEMPLATE' => $arResult['FAVORITE_URL_TEMPLATE'],
				'FAVORITE_URL_TEMPLATE_DEL' => $arResult['FAVORITE_URL_TEMPLATE_DEL'],
				'FAVORITE_PATH' => $arParams['FAVORITE_PATH']
			);
		}
		$jsString = ($jsString ?: '') . 'var ' . $strObName . ' = new JCCatalogItem('. CUtil::PhpToJSObject($arJSParams, false, true) .');';
		?>

	</div><!-- /.catalog-item-wrap --><?
$count++;
endforeach;
// echo "<pre style='text-align:left;'>";print_r($arResult);echo "</pre>";

?><script type="application/javascript">
	$("#catalog_section").toggleClass("availability-comments-enabled", <?=($arResult['AVAILABILITY_COMMENTS_ENABLED']?'true':'false')?>);
</script><?

$frame = $this->createFrame()->begin('');
if ($arJsCache['file']):
	$bytes = fwrite($arJsCache['file'], $jsString);
	if ($bytes === false || $bytes != mb_strlen($jsString, 'windows-1251')) {
		fclose($arJsCache['file']);
		$arJsCache['file'] = false;
	}
endif;
if(!$arJsCache['file']):

?><script type="text/javascript">
	<?=$jsString?>
</script><?

endif;
$frame->end();

if ($arJsCache['file']) {
	$templateData['jsFile'] = $arJsCache['path'].'/'.$arJsCache['idJS'];
	fclose($arJsCache['file']);
}
