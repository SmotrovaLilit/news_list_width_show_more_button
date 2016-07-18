<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
$ajax = false;
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $ajax = true;
}
global $APPLICATION;
?>
<?php if ($ajax) {
    $APPLICATION->RestartBuffer();
}
?>
<div class="news-list" >
<?php foreach ($arResult['ITEMS'] as $cnt => $arItem): ?>
        <div class="item">
            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
        </div>
<?php endforeach; ?>
</div>

<div style="clear:both;">
    <?=$arResult["NAV_STRING"];?>
</div>
<?php if ($ajax) {
    exit;
}
?>