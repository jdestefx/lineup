
<?php

   require_once("./php/App.inc");

   class Writer {

      public static $constantsFile = "./js/constants.js";
      // public static $opCodesFile = "chromeapp/js/opcodes.js";
      // public static $verbsFile = "chromeapp/js/verbs.js";

      public static function write() {
         // self::$constantsFile = "webui/js/constants.js";
         // self::$opCodesFile = "webui/js/opcodes.js";

         file_put_contents(self::$constantsFile , "");
         foreach (ConstantsImporter::$allDefines as $def) file_put_contents(self::$constantsFile, "var ".$def["name"]." = ".$def["value"].";\n", FILE_APPEND);

         file_put_contents(self::$constantsFile, self::objectizeTable("allTeams", "cfgTeams", "ID", "abbr"), FILE_APPEND);
         file_put_contents(self::$constantsFile, self::objectizeTable("allSportsPositions", "cfgSportsPositions", "ID", "abbr"), FILE_APPEND);
         //file_put_contents(self::$constantsFile, self::objectizeTable("allClasses", "classes", "ID"), FILE_APPEND);
         // file_put_contents(self::$constantsFile, self::objectizeTable("allEquipSlots", "equipSlots", "ID", "name"), FILE_APPEND);
         // file_put_contents(self::$constantsFile, self::objectizeTable("allOpCodes", "opCodes", "ID", "descr"), FILE_APPEND);
         // file_put_contents(self::$constantsFile, self::objectizeTable("allAttributes", "attributes", "ID", "name"), FILE_APPEND);
         // file_put_contents(self::$constantsFile, self::objectizeTable("allSkills", "skills", "ID", "name"), FILE_APPEND);
         // file_put_contents(self::$constantsFile, self::objectizeTable("allZones", "zones", "ID", "name"), FILE_APPEND);



         // $data = "var allVerbs = ";
         // $ret = \DB::queryToObject("select * from emitterVerbsBySkillSlot");
         // file_put_contents(self::$verbsFile, $data.json_encode($ret, JSON_PRETTY_PRINT).";");

      }

      public static function objectizeTable($varName, $tableName, $keyColumn, $nameColumn = "") {
         $res = \DB::queryToObject("select * from $tableName");


         $resultStr = "";

         $ret = (object)Array();
         foreach ($res as $row) {
            $ret->{$row->{$keyColumn}} = $row;
            unset($row->{$keyColumn});
         }


         $resultStr .= "var ".$varName."ByID = ".json_encode($ret, JSON_PRETTY_PRINT).";\n";

         if ($nameColumn!="") {
            $res = \DB::queryToObject("select * from $tableName");
            $ret = (object)Array();
            foreach ($res as $row) {
               $ret->{$row->{$nameColumn}} = $row;
               unset($row->{$nameColumn});
            }

            $resultStr .= "var ".$varName."ByName = ".json_encode($ret, JSON_PRETTY_PRINT).";\n";

         }

         return $resultStr;

      }

   }


   Writer::write();

?>
