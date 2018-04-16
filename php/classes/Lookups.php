<?php

   class TeamLookup {

      private static $teamsByAbbreviation = [];
      private static $teamsByID = [];
      private static $teamsByLongName = [];

      public static function init() {
         $res = \DB::queryToObject("select * from cfgTeams");

         foreach ($res as $row) {
            self::$teamsByAbbreviation[$row->abbr] = $row;
            self::$teamsByID[$row->ID] = $row;
            self::$teamsByLongName[$row->name] = $row;
         }

      }

      public static function getByAbbreviation($abbr) {
         return (self::$teamsByAbbreviation[$abbr]!==null?self::$teamsByAbbreviation[$abbr]:null);
      }

   }

   TeamLookup::init();

   class MLBPositionLookup {

      private static $positionsByID = [];
      private static $positionsByName = [];
      private static $positionsByAbbreviation = [];

      // TODO: un-hardcode sportID?
      public static function init() {
         $res = \DB::queryToObject("select * from cfgSportsPositions where sportID=1");

         foreach ($res as $row) {
            self::$positionsByID[$row->ID] = $row;
            self::$positionsByName[$row->name] = $row;
            self::$positionsByAbbreviation[$row->abbr] = $row;
         }
      }

      public static function getByAbbreviation($abbr) {
         return (self::$positionsByAbbreviation[$abbr]!==null?self::$positionsByAbbreviation[$abbr]:null);

      }

   }

   MLBPositionLookup::init();
   
?>