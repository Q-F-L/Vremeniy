<?if (!empty($arAction['IMG'])):?>
    <div class="banners-place">
        <div class="banner-1">
            <a href="<?=$arAction['SRC']?>">
                <img class="lazy" src="<?=ConsVar::showLoaderWithTemplatePath()?>" data-original="<?=$arAction['IMG']?>" alt="">
            </a>
        </div>
    </div>
<?endif?>