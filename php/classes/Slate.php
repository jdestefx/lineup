<?php


   class Slate {

      private $day;
      public $description = "";
      public $allGames = [];
      public $slateID;
      public $hostSiteShortName;

      public function __construct($slateID = NULL, Day $day, $hostSiteShortName = NULL, $description = "") {
         if ($hostSiteShortName===NULL) die("slate->construct(): hostSiteShortName cannot be null.");

         $this->day = $day;
         $this->description = $description;
         $this->hostSiteShortName = $hostSiteShortName;

         // if a null ID was passed, then we need to write this to the DB to get one.
         $this->slateID = $slateID;
         if ($slateID==NULL) {
            $this->save();
         } else {
            $this->readSlateGamesFromDB();
         }
      }

      private function readSlateGamesFromDB() {
         $res = \DB::queryToObject("select * from cfgSlateGames left join cfgGames on cfgSlateGames.gameID = cfgGames.ID where slateID = $this->slateID");

         foreach ($res as $row) {
            //$games = $this->day->getGames($row->homeTeamID, $row->awayTeamID);
            $game = $this->day->getGameByID($row->gameID);
            if ($game===NULL) die("slate->readSlateGamesFromDB(): read gameID $row->gameID from DB, but didn't find that game in Day->getGameByID()");
            $this->allGames[] = $game;
         }
      }

      private function save() {
         \DB::query("insert into cfgSlates values (null, ".$this->day->date->getTimestamp().", \"".$this->hostSiteShortName."\", \"$this->description\")");
         $this->slateID = \DB::getInsertID();
         return $this;
      }

      public function addGame(Game $game = null) {
         if ($game==null) {
            die("slate->addGame(): null game provided.");
         }

         if ($this->hasGameID($game->gameID)==true) die("slate->addGame(): tried to add a game that was already in allGames()");
         $this->saveGame($game);
         $this->allGames[] = $game;
         return $game;
      }

      private function saveGame(Game $game) {
         \DB::query("insert into cfgSlateGames values ($this->slateID, $game->gameID)");
      }

      private function hasGameID($gameID) {
         if (arrayFindByObjKeyProp($this->allGames, "gameID", $gameID)===NULL) return false;
         return true;
      }

      public function addGames($games) {
         foreach ($games as &$game) {
            $this->addGame($game);
         }

         return $games;
      }

      public function wipe() {
         \DB::query("delete from cfgSlateGames where slateID = $this->slateID");
         \DB::query("delete from cfgSlates where ID = $this->slateID");
      }


   }
 


?>