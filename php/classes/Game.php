<?php

   // TODO: change references of "away" to "visitor"
   // TODO: Convert this to "MLBGame"?
   class Game {
      public $homeTeamID;
      public $homeLineup;

      public $awayTeamID;
      public $awayLineup;

      public $gameTime;
      public $gameID;
      public $sportID;

      public function __construct($sportID, $homeTeamID, $awayTeamID, $gameTime, $gameID = NULL) {
         if ($gameTime == null) die("addGame(): no gameDate supplied");

         $this->sportID = $sportID;
         $this->homeTeamID = $homeTeamID;
         $this->awayTeamID = $awayTeamID;
         $this->gameTime = $gameTime;
       
         // if a null ID was passed, then we need to write this to the DB to get one.
         $this->gameID = $gameID;
         if ($gameID==NULL) {
            $this->save();
         } 

         // create lineups, which will attempt to read any existing lineups from the DB
         $this->homeLineup = new Lineup($this->homeTeamID, $this->gameID);
         $this->awayLineup = new Lineup($this->awayTeamID, $this->gameID);
      }

      // private function readLineupsFromDB() {
      //    $this->homeLineup = $this->readLineupsFromDBForTeamID($this->homeTeamID);
      //    $this->readLineupsFromDBForTeamID($this->awayTeamID);
      // }

      // private function readLineupsFromDBForTeamID($teamID) {
      //    $lineupRows = \DB::queryToObject("select * from cfgGameLineups where gameID = $this->gameID and teamID = $teamID");
      //    if (sizeof($lineupRows)==0) return null;

      //    $lineup = new Lineup($teamID, $this->gameID);
      //    $lineup->setLineupByPositionID($lineupRows);

      //    return $lineup;

      // }

      public function save() {
         \DB::query("insert into cfgGames values (null, $this->sportID, $this->homeTeamID, $this->awayTeamID, ".$this->gameTime->getTimestamp().")");
         $this->gameID = \DB::getInsertID();

         return $this;
      }

      // accepts loosely structured lineup json and creates a Lineup class from it.
      public function addLineupByPositionAbbr($forTeamID, $lineup) {
         $newLineup = new Lineup($forTeamID, $this->gameID);
         $newLineup->setLineupByPositionAbbr($lineup);
         $newLineup->save();
         return $lineup;
      }


   }

   // TODO: Convert this to "MLBLineup"?
   class Lineup {

      // [{positionID: 1, name: "Some Pitcher"}, {}, {}];
      public $data = [];
      public $teamID;
      public $gameID;

      public function __construct($teamID, $gameID) {
         $this->teamID = $teamID;
         $this->gameID = $gameID;

         $this->readLineupFromDB();
      }

      private function readLineupFromDB() {
         $rows = \DB::queryToObject("select * from cfgGameLineups where gameID = $this->gameID and teamID = $this->teamID");
         if (sizeof($rows)==0) return null;
         $this->setLineupByPositionID($rows);
      }

      public function setLineupByPositionAbbr($lineup) {
         //print_r($lineup);
         foreach ($lineup as $entry) {
            $positionAbbr = array_keys($entry)[0];
            $name = array_values($entry)[0];
            $this->addEntry(MLBPositionLookup::getByAbbreviation($positionAbbr)->ID, $name);
         }
      }

      public function setLineupByPositionID($lineup) {
         foreach ($lineup as $entry) {
            // $positionID = array_keys($entry)[0];
            // $name = array_values($entry)[0];
            $this->addEntry($entry->positionID, $entry->name);
         }
      }

      public function addEntry($positionID, $playerName) {
         $this->data[] = [$positionID=>$playerName];
      }

      public function getEntryForPositionID($positionID) {
         return arrayFindByObjKeyProp($this->data, "positionID", $positionID);
      }

      public function getEntryForPlayerName($playerName) {
         return arrayFindByObjKeyProp($this->data, "name", $playerName);
      }

      public function save() {
         \DB::query("delete from cfgGameLineups where gameID=$this->gameID and teamID=$this->teamID");

         //print_r($this->data);

         foreach ($this->data as $entry) {
            $positionID = array_keys($entry)[0];
            $name = array_values($entry)[0];

            \DB::query("insert into cfgGameLineups values ($this->gameID, $this->teamID, $positionID, \"$name\")");
         }

      }

   }


?>