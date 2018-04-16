drop table if exists cfgSlates;
   CREATE TABLE cfgSlates (
      `ID` int AUTO_INCREMENT primary key,
      `date` bigint DEFAULT 0,
      `hostSiteShortName` char(128) not null,
      `descr` char(128) not null
   ) DEFAULT CHARSET=latin1;

drop table if exists cfgSlateGames;
   create table cfgSlateGames (
      `slateID` int not null,
      `gameID` int not null
   );

drop table if exists cfgSports;
   create table cfgSports (
      `ID` int AUTO_INCREMENT primary key,
      `name` char(128) not null,
      `abbr` char(16) not null
   );

   insert into cfgSports values
      (null, "Baseball", "MLB"),
      (null, "Basketball", "NBA"),
      (null, "Football", "NFL");
   SET @MLBID = (select ID from cfgSports where abbr = "MLB");
   SET @NBAID = (select ID from cfgSports where abbr = "NBA");
   SET @NFLID = (select ID from cfgSports where abbr = "NFL");


drop table if exists cfgGames;
   create table cfgGames (
      `ID` int AUTO_INCREMENT primary key,
      `sportID` int not null,
      `homeTeamID` int default null,
      `awayTeamID` int default null,
      `gameTime` bigint default '0'
   );


drop table if exists cfgTeams;
   create table cfgTeams (
      `ID` int AUTO_INCREMENT primary key,
      `name` char(128) not null,
      `shortName` char(128) not null,
      `abbr` char(16) not null,
      `sportID` int default 0
   );

   insert into cfgTeams values
      (null, "Baltimore Orioles", "Orioles", "BAL", @MLBID),
      (null, "Boston Red Sox", "Red Sox", "BOS", @MLBID),
      (null, "Chicago White Sox", "White Sox", "CWS", @MLBID),
      (null, "Cleveland Indians", "Indians", "CLE", @MLBID),
      (null, "Detroit Tigers", "Tigers", "DET", @MLBID),
      (null, "Houston Astros", "Astros", "HOU", @MLBID),
      (null, "Kansas City Royals", "Royals", "KC", @MLBID),
      (null, "Los Angeles Angels of Anaheim", "Angels", "LAA", @MLBID),
      (null, "Minnesota Twins", "Twins", "MIN", @MLBID),
      (null, "New York Yankees", "Yankees", "NYY", @MLBID),
      (null, "Oakland Athletics", "Athletics", "OAK", @MLBID),
      (null, "Seattle Mariners", "Mariners", "SEA", @MLBID),
      (null, "Tampa Bay Rays", "Rays", "TB", @MLBID),
      (null, "Texas Rangers", "Rangers", "TEX", @MLBID),
      (null, "Toronto Blue Jays", "Blue Jays", "TOR", @MLBID),
      (null, "Arizona Diamondbacks", "Diamondbacks", "ARI", @MLBID),
      (null, "Atlanta Braves", "Braves", "ATL", @MLBID),
      (null, "Chicago Cubs", "Cubs", "CHC", @MLBID),
      (null, "Cincinnati Reds", "Reds", "CIN", @MLBID),
      (null, "Colorado Rockies", "Rockies", "COL", @MLBID),
      (null, "Los Angeles Dodgers", "Dodgers", "LAD", @MLBID),
      (null, "Miami Marlins", "Marlins", "MIA", @MLBID),
      (null, "Milwaukee Brewers", "Brewers", "MIL", @MLBID),
      (null, "New York Mets", "Mets", "NYM", @MLBID),
      (null, "Philadelphia Phillies", "Phillies", "PHI", @MLBID),
      (null, "Pittsburgh Pirates", "Pirates", "PIT", @MLBID),
      (null, "San Diego Padres", "Padres", "SD", @MLBID),
      (null, "San Francisco Giants", "Giants", "SF", @MLBID),
      (null, "St. Louis Cardinals", "Cardinals", "STL", @MLBID),
      (null, "Washington Nationals", "Nationals", "WAS", @MLBID);




drop table if exists cfgSportsPositions;
   create table cfgSportsPositions (
      `ID` int AUTO_INCREMENT primary key,
      `sportID` int not null,
      `positionNumber` int not null,
      `name` char(128) not null,
      `abbr` char(128) not null
   );

   insert into cfgSportsPositions values
      (NULL, @MLBID, 1, "Pitcher", "P"),
      (NULL, @MLBID, 2, "Catcher", "C"),
      (NULL, @MLBID, 3, "First Base", "1B"),
      (NULL, @MLBID, 4, "Second Base", "2B"),
      (NULL, @MLBID, 5, "Third Base", "3B"),
      (NULL, @MLBID, 6, "Shortstop", "SS"),
      (NULL, @MLBID, 7, "Left Field", "LF"),
      (NULL, @MLBID, 8, "Center Field", "CF"),
      (NULL, @MLBID, 9, "Right Field", "RF"),
      (NULL, @MLBID, 10, "Designated Hitter", "DH");


drop table if exists cfgGameLineups;
   create table cfgGameLineups (
      `gameID` int not null,
      `teamID` int not null,
      `positionID` int not null,
      `name` char(128) not null
   );



