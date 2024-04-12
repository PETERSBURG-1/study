<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/*
 *  Задать имя компонента и Описание
 *  Разместить его в своем разделе в Визуальном редакторе
 */

$arComponentDescription = array(
    "NAME" => GetMessage("HLBLOCK_LIST"),
	"DESCRIPTION" => GetMessage("HLBLOCK_LIST_DESC"),
    "CACHE_PATH" => 'Y',
    "PATH" => array(
        "ID" => "custom",
        "NAME" => GetMessage("MY_COMPONENTS"),
    ),
);

?>