<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/*
 * Нужно создать пареметры, можно посмотреть как это сделано в компоненте news.list
 * 1. Строка для Название таблицы (TABLE_NAME) Highload-блока. Ниже приведино в качестве примера
 * 2. Количество элементов для постраничной пагинации
 * 3. Кеширования(CACHE_TIME)
 */

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        // пример параметр Название таблицы
        "HLBLOCK_TNAME"  =>  Array( // Код поля
            "PARENT" => "BASE", //
            "NAME" => GetMessage("MCART_AGENTS_LIST_HLBLOCK_TNAME"), // Название параметра, берется из языкового файла
            "TYPE" => "STRING", // Тип поля
            "DEFAULT" => "", // Значение по дефолту
        ),
        "AGENTS_COUNT" => Array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("MCART_AGENTS_LIST_HLBLOCK_COUNT"),
            "TYPE" => "STRING",
            "DEFAULT" => "5",
        ),
        "CACHE_TIME" => Array("DEFAULT"=>36000000),
    ),
);


