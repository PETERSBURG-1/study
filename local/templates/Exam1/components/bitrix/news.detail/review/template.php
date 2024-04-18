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
$noPhoto = SITE_TEMPLATE_PATH ."/img/rew/no_photo.jpg";
?>
<div class="review-block">
<div class="review-text">
	<div class="review-text-cont">
		<?echo $arResult["DETAIL_TEXT"];?>
	</div>
	<div class="review-autor">
		<?=$arResult['NAME']?>, <?=$arResult["DISPLAY_ACTIVE_FROM"]?>, <?=$arResult['DISPLAY_PROPERTIES']['POSITION']['VALUE']?>, <?=$arResult['DISPLAY_PROPERTIES']['COMPANY']['VALUE']?>.
	</div>
</div>
<div style="clear: both;" class="review-img-wrap"><img src="<?=$arResult["DETAIL_PICTURE"]["SRC"] ? : $noPhoto ?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"></div>
</div>
<?if($arResult['DISPLAY_PROPERTIES']['DOCS']):?>
	<div class="exam-review-doc">
		<p><?=$arResult['DISPLAY_PROPERTIES']['DOCS']['NAME']?>:</p>
		<?foreach($arResult['DISPLAY_PROPERTIES']['DOCS']['VALUE'] as $file):?>
			<?$doc = CFile::GetFileArray($file);?>
		<div  class="exam-review-item-doc"><img class="rew-doc-ico" src="<?=SITE_TEMPLATE_PATH;?>/img/icons/pdf_ico_40.png"><a href="<?=$doc["SRC"]?>" target="_blank"><?=$doc["ORIGINAL_NAME"]?></a></div>
		<?endforeach;?>
	</div>
<?endif;?>
<hr>