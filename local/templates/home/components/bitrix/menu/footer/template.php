<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)): ?>
    <div class="col-md-6 col-lg-6">
        <ul class="list-unstyled">
            <?php
            // Количество пунктов в блоке
            $itemsPerBlock = 4;
            // Индекс текущего пункта меню
            $currentIndex = 0;

            foreach ($arResult as $arItem):
                if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) {
                    continue;
                }
            ?>
                <?if ($currentIndex % $itemsPerBlock === 0): ?>
                    <?if ($currentIndex !== 0): ?>
                        </ul></div><div class="col-md-6 col-lg-6"><ul class="list-unstyled">
                    <?else: ?>
                        <ul class="list-unstyled">
                    <?endif; ?>
                <?endif; ?>

                <?if ($arItem["SELECTED"]): ?>
                    <li><a href="<?= $arItem["LINK"] ?>" class="selected"><?= $arItem["TEXT"] ?></a></li>
                <?else: ?>
                    <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                <?endif ?>
                
                <?$currentIndex++; ?>
            <?endforeach; ?>
        </ul>
    </div>
<?endif ?>
