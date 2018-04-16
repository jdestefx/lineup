<?php

   require_once("App.inc");

   $p = file_get_contents('php://input');
   $po = json_decode($p);


   if ($po->m == "loadGamesBySlateID") {
      $res = \DB::queryToObject("select gameID, sportID, homeTeamID, awayTeamID, gameTime from cfgSlateGames left join cfgGames on cfgSlateGames.gameID = cfgGames.ID where slateID=$po->slateID");
      echo json_encode($res);
   }

?>