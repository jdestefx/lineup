<?php

   class ConstantsImporter {
      public static $allDefines = [];

      public static function init() {
         self::importDefines("cfgTeams", "abbr", "TEAM", "ID");
         self::importDefines("cfgSports", "abbr", "SPORT", "ID");
      }

      public static function importDefines($tableName, $tableColumn, $defineClass, $defineValueColumn) {
         $entries = \DB::queryToAssoc("select * from $tableName");

         for ($i=0;$i<sizeof($entries);$i++) {
            $defineClassName = strtoupper($entries[$i]{$tableColumn});
            $defineClassName = preg_replace("/\s/", "_", $defineClassName);

            if (is_numeric($entries[$i]{$defineValueColumn})==true) $entries[$i]{$defineValueColumn} = floatval($entries[$i]{$defineValueColumn});

            $defineName = $defineClass.(strlen($defineClass)>0?"_":"").$defineClassName;
            $defineValue = $entries[$i]{$defineValueColumn};

            self::$allDefines[] = ["name"=>$defineName, "value"=>$defineValue];
            define($defineName, $defineValue);
         }
      }
   }

   ConstantsImporter::init();

?>