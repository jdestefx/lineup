<?php
   
   class Day {

      public $date;
      public $allSlates = [];
      public $allGames = [];


      public function __construct(DateTime $date = null) {
         if ($date == null) die("Day construct(): no Date supplied.");
         $this->date = $date;

         $this->readGamesFromDB();
         $this->readSlatesFromDB();
      }

      private function readGamesFromDB() {
         $res = \DB::queryToObject("select * from cfgGames where gameTime >= ".$this->date->getTimestamp()." and gameTime < ".($this->date->getTimestamp()+86400));
         foreach ($res as &$row) {
            $this->addGame($row->sportID, $row->homeTeamID, $row->awayTeamID, $row->gameTime, $row->ID);
         }
      }

      private function readSlatesFromDB() {
         $res = \DB::queryToObject("select * from cfgSlates where date = ".$this->date->getTimestamp());

         foreach ($res as &$row) {
            $this->addSlate($row->descr, $row->hostSiteShortName, $row->ID);
         }
      }

      public function addGame($sportID, $homeTeamID, $awayTeamID, $gameTime, $gameID = NULL) {
         $game = new Game($sportID, $homeTeamID, $awayTeamID, $gameTime, $gameID);
         $this->allGames[] = $game;
         return $game;
      }

      public function addSlate($description, $hostSiteShortName = "", $slateID = NULL) {
         if ($this->getSlateByDescription($description)!==null) {
            $this->wipeSlateByDescription($description);
         }

         $slate = new Slate($slateID, $this, $hostSiteShortName, $description);
         $this->allSlates[] = $slate;
         return $slate;
      }

      // return array of games matching homeTeam and awayTeam this day -- array to support double-headers
      public function getGamesByTeams($homeTeamID, $awayTeamID) {
         $ret = [];

         foreach ($this->allGames as &$game) {
            if ($game->homeTeamID==$homeTeamID && $game->awayTeamID==$awayTeamID) $ret[] = $game;
         }

         return (sizeof($ret)==0?NULL:$ret);
      }

      public function getGameByID($gameID) {
         return arrayFindByObjKeyProp($this->allGames, "gameID", $gameID);
      }

      public function getSlateByDescription($slateDescription) {
         return arrayFindByObjKeyProp($this->allSlates, "description", $slateDescription);
      }

      public function getSlatesByHostSiteShortName($hostSiteShortName) {
         $ret = [];

         foreach ($this->allSlates as &$slate) {
            if ($slate->hostSiteShortName == $hostSiteShortName) $ret[] = $slate;
         }

         return $ret;
      }

      public function getAllGames() {
         return $this->allGames;
      }

      public function wipeGames() {
         foreach ($this->allGames as $game) {
            \DB::query("delete from cfgGames where ID = $game->gameID");
            \DB::query("delete from cfgGameLineups where gameID=$game->gameID");
            \DB::query("delete from cfgGameLineups where gameID not in (select ID from cfgGames)");
         }
         unset($this->allGames);
         $this->allGames = [];

         \DB::query("delete from cfgSlateGames where gameID not in (select ID from cfgGames)");
      }

      public function wipeSlateByDescription($description) {
         \DB::query("delete from cfgSlates where date = ".$this->date->getTimestamp()." and descr = \"$description\"");
         \DB::query("delete from cfgSlateGames where slateID not in (select ID from cfgSlates)");
      }

      public function wipe() {
         $this->wipeGames();

         foreach ($this->allSlates as &$slate) {
            $slate->wipe();
         }
         unset($this->allSlates);
         $this->allSlates = [];
      }

      private function getSlateJSON() {
         $ret = [];

         foreach ($this->allSlates as $slate) {
            $ret[] = [
               "slateID"=>$slate->slateID,
               "hostSiteShortName"=>$slate->hostSiteShortName,
               "description"=>$slate->description,
               "games"=>array_map(function($g){return $g->gameID;}, $slate->allGames)
            ];
         }

         return $ret;
      }

      public function getJSON() {
         return json_encode([
            "allGames" => $this->allGames,
            "allSlates" => $this->getSlateJSON(),
         ]);
      }

   }


?>