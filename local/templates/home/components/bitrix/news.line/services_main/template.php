<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
?>
<?foreach($arResult['ITEMS'] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<?endforeach;?>
	<?
$IBLOCK_ID = $arParams['IBLOCKS'];

$rsElements = CIBlockElement::GetList(
    array(),
    array('IBLOCK_ID' => $IBLOCK_ID),
    false,
    false,
    array('ID', 'NAME', 'PROPERTY_ICON_NAME', 'PROPERTY_LINK')
);

while ($arElement = $rsElements->GetNext()) {
    $elements[] = $arElement;
}
?>
<div class="row">
	<?foreach($elements as $arElement):?>
        <div class="col-md-6 col-lg-4 mb-4" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
          <a href="<?=$arElement['PROPERTY_LINK_VALUE']?>" target="_blank" class="service text-center border rounded">
            <span class="icon <?=$arElement['PROPERTY_ICON_NAME_VALUE']?>"></span>
            <h2 class="service-heading"><?=$arElement['NAME']?></h2>
            <p><span class="read-more"><?=GetMessage('MORE_DETAILS')?></span></p>
          </a>
        </div>
	<?endforeach;?>
	</div>


