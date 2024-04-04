<? 
   AddEventHandler("main", "OnAfterUserAdd",  Array("RegUserGroup", "OnAfterUserAddHandler")); 
   class RegUserGroup
  {
   public static function OnAfterUserAddHandler(&$arFields) 
   { 
     if($arFields["ID"] > 0) 
     { 
       if($arFields["UF_TYPE_USER"] == 1)  
       { 
         $arGroups = CUser::GetUserGroup($arFields["ID"]); 
         $arGroups[] = 7; //То добаляем пользователя в группу c ID7 
         CUser::SetUserGroup($arFields["ID"], $arGroups); 
       } 
       elseif($arFields["UF_TYPE_USER"] == 0)  
       { 
         $arGroups = CUser::GetUserGroup($arFields["ID"]); 
         $arGroups[] = 6; //Иначе в группу c ID6 
         CUser::SetUserGroup($arFields["ID"], $arGroups); 
       } 
     } 
   } 
  }
?>
