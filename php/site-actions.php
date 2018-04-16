<?php
   require_once("App.inc");

   $p = file_get_contents('php://input');
   $po = json_decode($p);

   class siteActions {
      private static $po;

      public static function process($po) {
         self::$po = $po;

         // TODO: SECURITY FIX - DYNAMIC CALLING COULD CALL OTHER SUBS
         self::{$po->m}($po);
      }

      public static function getRosterForDate($po) {
         // TODO: SECURITY FIX

         $day = new Day(date_create("$po->date", new DateTimeZone("America/New_York")));
         echo $day->getJSON();

         //echo file_get_contents("../scrapes/mlb-lineups-$po->date.json");
      }
   }

   siteActions::process($po);

?>