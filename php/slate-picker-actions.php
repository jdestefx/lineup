<?php

   require_once("App.inc");

   $p = file_get_contents('php://input');
   $po = json_decode($p);


   if ($po->m == "requestSlatesByHostSiteShortName") {
      $day = new Day(date_create($po->date." 00:00:00-0400"));

      //echo json_encode($day, JSON_PRETTY_PRINT);

      $slates = $day->getSlatesByHostSiteShortName($po->hostSiteShortName);

      echo json_encode($slates, JSON_PRETTY_PRINT);

      // if ($slates===null) {
      //    echo json_encode(["error"=>1, "message"=>"No slates found for the requested date."]);
      // }
   }




?>