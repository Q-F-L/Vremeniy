<?if (\Bitrix\Main\Loader::includeModule('sale')):?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:advertising.banner",
        "bitronic2",
        array(
            "TYPE" => "b2_catalog_section_in_goods",
            "NOINDEX" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "COMPONENT_TEMPLATE" => "bitronic2",
            "QUANTITY" => "1",
            "DIV_COMPOSITE_CLASS" => "banner-catalog"
        ),
        false
    );?>
<?endif?>