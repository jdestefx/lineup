<?php


   function arrayFindByObjKeyProp(&$arr, $key, $prop) {
      for ($i=0;$i<sizeof($arr);$i++) if ($arr[$i]->{$key}==$prop) return $arr[$i];
      return null;
   }

   function getTodayDateObj() {
      $d = date_create(null, new DateTimeZone("America/New_York"));
      $d->setTime(0,0,0);
      return $d;
   }


?>