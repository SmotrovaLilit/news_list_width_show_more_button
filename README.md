# news_list_width_show_more_button
Cписок новостей с кнопкой показать еще

##Инструкция
### Подключение компонента
```
#!php
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $APPLICATION;
$APPLICATION->SetTitle("Новости");


$APPLICATION->IncludeComponent("bitrix:news.list", "news.list", array(
    "IBLOCK_TYPE" => "news",
    "IBLOCK_ID" => 1,
    "NEWS_COUNT" => 2,
    "SORT_BY1" => "ID",
    "SORT_ORDER1" => "DESC",
    "SORT_BY2" => "SORT",
    "SORT_ORDER2" => "ASC",
    "FIELD_CODE" => array(
        "NAME",
    ),
    "PROPERTY_CODE" => array(
    ),
    "CHECK_DATES" => "Y",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "N",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TYPE" => "Y",
    "CACHE_TIME" => "3600",
    "CACHE_FILTER" => "Y",
    "CACHE_GROUPS" => "Y",
    "PREVIEW_TRUNCATE_LEN" => "",
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "SET_TITLE" => "Y",
    "SET_STATUS_404" => "Y",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
    "ADD_SECTIONS_CHAIN" => "Y",
    "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
    "PARENT_SECTION" => "",
    "PARENT_SECTION_CODE" => "",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Новости",
    "PAGER_SHOW_ALWAYS" => "Y",
    "PAGER_TEMPLATE" => "show.more",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "AJAX_OPTION_ADDITIONAL" => ""
),
    false
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

```
Необходимо определить кастомный шаблон для пагинации
"PAGER_TEMPLATE" => "show.more",

### Шаблон компонента news.list
Необходимо проверить если аякс запрос, то стереть буфер
```
#!php
$ajax = false;
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $ajax = true;
}
global $APPLICATION;

if ($ajax) {
    $APPLICATION->RestartBuffer();
}
//сам код шаблона

if ($ajax) {
    exit;
}
```

###Подгрузка элементов на аяксе
```
#!javascript

    $(function() {
        var container_list_selector = '.news-list',
            show_more_selector = '.show-more';

        $('body').on ('click', show_more_selector, function (e) {
            var $container_list_selector = $(container_list_selector),
                $this = $(this),
                path = $this.attr('href');
            $.get(path, function (data) {
                var element = document.createElement('div'),
                    $domElement =  $(element);
                $domElement.html(data);
                $container_list_selector.append($domElement.find(container_list_selector).html());
                var $newShowMore = $domElement.find(show_more_selector);
                if ($domElement.find(show_more_selector).length) {
                    $this.attr('href', $newShowMore.attr('href'));
                } else {
                    $this.hide();
                }
            });

            e.preventDefault();
        });
    });
```

### Шаблон компонента постраничной навигации
У ссылки(кнопки показать еще) задать класс , который используется в ява-скрипте - "show-more"
