<?php

   require_once("App.inc");

   $day = new Day(date_create("2018-4-9 00:00:00", new DateTimeZone("America/New_York")));
   // $day->wipe();
   // return;

   // $day->getSlateByDescription("Early Games")->addGame($day->getGamesByTeams(TEAM_BAO, TEAM_BRS)[1]);
   echo $day->getJSON();
   return;

   $day->addGame(SPORT_MLB, TEAM_BAO, TEAM_BRS, date_create("2018-4-1 12:00:00-0400"));
   $day->addGame(SPORT_MLB, TEAM_BAO, TEAM_BRS, date_create("2018-4-1 17:00:00-0400"));
   $day->addGame(SPORT_MLB, TEAM_CWS, TEAM_CLI, date_create("2018-4-1 12:00:00-0400"));
   $day->addGame(SPORT_MLB, TEAM_DET, TEAM_HOA, date_create("2018-4-1 12:00:00-0400"));
   $day->addGame(SPORT_MLB, TEAM_KCR, TEAM_LAA, date_create("2018-4-1 13:00:00-0400"));
   $day->addGame(SPORT_MLB, TEAM_MIT, TEAM_NYY, date_create("2018-4-1 13:00:00-0400"));
   $day->addGame(SPORT_MLB, TEAM_OAA, TEAM_SEM, date_create("2018-4-1 13:00:00-0400"));
   $day->addGame(SPORT_MLB, TEAM_TBR, TEAM_TXR, date_create("2018-4-1 14:30:00-0400"));
   $day->addGame(SPORT_MLB, TEAM_TBJ, TEAM_ARD, date_create("2018-4-1 14:30:00-0400"));

   $slate = $day->addSlate("Early Games", "fanDuel");
   $slate->addGame($day->getGamesByTeams(TEAM_BAO, TEAM_BRS)[0]);
   $slate->addGame($day->getGamesByTeams(TEAM_CWS, TEAM_CLI)[0]);
   $slate->addGame($day->getGamesByTeams(TEAM_DET, TEAM_HOA)[0]);

   $slate = $day->addSlate("Afternoon", "fanDuel");
   $slate->addGame($day->getGamesByTeams(TEAM_KCR, TEAM_LAA)[0]);
   $slate->addGame($day->getGamesByTeams(TEAM_MIT, TEAM_NYY)[0]);
   $slate->addGame($day->getGamesByTeams(TEAM_OAA, TEAM_SEM)[0]);
   $slate->addGame($day->getGamesByTeams(TEAM_TBR, TEAM_TXR)[0]);
   $slate->addGame($day->getGamesByTeams(TEAM_TBJ, TEAM_ARD)[0]);

   $slate = $day->addSlate("Main", "fanDuel");
   $slate->addGames($day->getAllGames());
   //print_r($day);

   //$day->wipe();



?>