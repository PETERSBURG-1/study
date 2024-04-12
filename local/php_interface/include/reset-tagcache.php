<? 
$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler("", "RealtorsOnAfterAdd", Array("ResetTagByCacheHL", "clearTagCacheHL"));
$eventManager->addEventHandler("", "RealtorsOnAfterUpdate", Array("ResetTagByCacheHL", "clearTagCacheHL"));
$eventManager->addEventHandler("", "RealtorsOnAfterDelete", Array("ResetTagByCacheHL", "clearTagCacheHL"));

class ResetTagByCacheHL
{
    public static function clearTagCacheHL(\Bitrix\Main\Entity\Event $event) 
    {
        $entity = $event->getEntity();
        $tableName = $entity->getDBTableName();
        $taggedCache = \Bitrix\Main\Application::getInstance()->getTaggedCache();
        $taggedCache->clearByTag('hlblock_table_name_' . $tableName);
        
    }
}
    
?>

