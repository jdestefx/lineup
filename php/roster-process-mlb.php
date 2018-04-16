#!/usr/bin/php
<?php
   
   require_once("./php/App.inc");
   require_once("./php/simple_html_dom.php");

   class scraper {
      private static $rotoWireURL = "https://www.rotowire.com/baseball/daily_lineups.htm";

      private static $document;


      public static function init() {
         self::fetchHTML(self::$rotoWireURL);
         self::processHTML();
      }

      private static function fetchHTML($sourceURL) {
         self::$document = file_get_html($sourceURL);
      }

      private static function scrub($str) {
         $ret = trim(str_replace("&nbsp;", "", $str));
         $ret = preg_replace("/\s+/", " ", $ret);
         return $ret;
      }

      private static function getNowEpoch() {
         return date_create(null, new DateTimeZone("America/New_York"))->getTimestamp();
      }

      private static function processHTML() {
         $bars = self::$document->find(".dlineups-mainbar");

         $ret = [];

         foreach ($bars as $bar) {
            $game = new stdclass();

            // extract home, gametime, and away names
            $topBox = $bar->parent()->parent()->find(".dlineups-topbox", 0);
            $awayBox = self::scrub($topBox->find(".dlineups-topboxleft",0)->plaintext);
            $timeBox = self::scrub($topBox->find(".dlineups-topboxcenter",0)->plaintext);
            $timeBox = substr($timeBox, 0, strpos($timeBox, " ET"));
            $homeBox = self::scrub($topBox->find(".dlineups-topboxright",0)->plaintext);

            // read middle box and look for postponed status
            $game->ppd = FALSE;
            $matchSummary = self::scrub($bar->parent()->parent()->find(".dlineups-mainbar",0)->plaintext);
            if (preg_match("/Postponed/", $matchSummary)===1) $game->ppd = TRUE;

            // read the teams and gametime
            $game->homeTeamAbbr = $homeBox;
            $game->awayTeamAbbr = $awayBox;
            $game->gameTime = date_create($timeBox, new DateTimeZone("America/New_York"));
            $game->unixTime = $game->gameTime->getTimestamp();


            // init the lineups
            $lineups = $bar->parent()->parent()->find(".dlineups-half");
            if (sizeof($lineups)==0) {
               $ret[] = $game;
               continue;
            }


            $game->awayTeamLineup = [];
            //$awayTeamPlayerEntries = $lineups[0];
            $awayTeamPlayerEntries = $bar->parent()->parent()->find(".dlineups-half .dlineups-vplayer");
            foreach ($awayTeamPlayerEntries as $entry) {
               $scrubbedEntry = self::scrub($entry->plaintext);
               preg_match_all("/([\d\w]+)\s+([\-\d\w\s\.]+)\((\w)\)/", $scrubbedEntry, $matches);

               // skip pitcher, handled later
               if ($matches[1][0]=="P") continue;

               $game->awayTeamLineup[] = array($matches[1][0] => $matches[2][0]);
            }


            $game->homeTeamLineup = [];
            //$homeTeamPlayerEntries = $lineups[1];
            $homeTeamPlayerEntries = $bar->parent()->parent()->find(".dlineups-half .dlineups-hplayer");
            foreach ($homeTeamPlayerEntries as $entry) {
               $scrubbedEntry = self::scrub($entry->plaintext);
               preg_match_all("/([\d\w]+)\s+([\-\d\w\s\.]+)\((\w)\)/", $scrubbedEntry, $matches);
               // skip pitcher, handled later
               if ($matches[1][0]=="P") continue;
               $game->homeTeamLineup[] = array($matches[1][0] => $matches[2][0]);
            }


            // special attention required for the pitching divs
            $pitcherDivs = $bar->parent()->parent()->find(".dlineups-pitchers div");

            foreach ($pitcherDivs as $div) {
               preg_match_all("/([\w]+)\:\s+([^\(]+)/", self::scrub($div->plaintext), $matches);
               if ($matches[1][0] == $game->homeTeamAbbr) $game->homeTeamLineup[] = array("P"=>$matches[2][0]);
               if ($matches[1][0] == $game->awayTeamAbbr) $game->awayTeamLineup[] = array("P"=>$matches[2][0]);
            }



            $ret[] = $game;
         }

         $game->scrapeTime = self::getNowEpoch();

         file_put_contents("./scrapes/mlb-lineups-".date_create()->format("Ymd").".json", json_encode($ret, JSON_PRETTY_PRINT));


         $day = new Day(getTodayDateObj());

         $day->wipeGames();

         foreach ($ret as $gameData) {
            $game = $day->addGame(SPORT_MLB, TeamLookup::getByAbbreviation($gameData->homeTeamAbbr)->ID, TeamLookup::getByAbbreviation($gameData->awayTeamAbbr)->ID, $gameData->gameTime, null);

            if (isset($gameData->homeTeamLineup)===TRUE) $game->addLineupByPositionAbbr(TeamLookup::getByAbbreviation($gameData->homeTeamAbbr)->ID, $gameData->homeTeamLineup);
            if (isset($gameData->awayTeamLineup)===TRUE) $game->addLineupByPositionAbbr(TeamLookup::getByAbbreviation($gameData->awayTeamAbbr)->ID, $gameData->awayTeamLineup);

         }

         $slate = $day->addSlate("(all games)", "fanDuel");
         $slate->addGames($day->getAllGames());


      }




   }


  scraper::init();


?>