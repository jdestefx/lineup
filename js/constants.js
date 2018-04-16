var TEAM_BAL = 1;
var TEAM_BOS = 2;
var TEAM_CWS = 3;
var TEAM_CLE = 4;
var TEAM_DET = 5;
var TEAM_HOU = 6;
var TEAM_KC = 7;
var TEAM_LAA = 8;
var TEAM_MIN = 9;
var TEAM_NYY = 10;
var TEAM_OAK = 11;
var TEAM_SEA = 12;
var TEAM_TB = 13;
var TEAM_TEX = 14;
var TEAM_TOR = 15;
var TEAM_ARI = 16;
var TEAM_ATL = 17;
var TEAM_CHC = 18;
var TEAM_CIN = 19;
var TEAM_COL = 20;
var TEAM_LAD = 21;
var TEAM_MIA = 22;
var TEAM_MIL = 23;
var TEAM_NYM = 24;
var TEAM_PHI = 25;
var TEAM_PIT = 26;
var TEAM_SD = 27;
var TEAM_SF = 28;
var TEAM_STL = 29;
var TEAM_WAS = 30;
var SPORT_MLB = 1;
var SPORT_NBA = 2;
var SPORT_NFL = 3;
var allTeamsByID = {
    "1": {
        "name": "Baltimore Orioles",
        "shortName": "Orioles",
        "abbr": "BAL",
        "sportID": "1"
    },
    "2": {
        "name": "Boston Red Sox",
        "shortName": "Red Sox",
        "abbr": "BOS",
        "sportID": "1"
    },
    "3": {
        "name": "Chicago White Sox",
        "shortName": "White Sox",
        "abbr": "CWS",
        "sportID": "1"
    },
    "4": {
        "name": "Cleveland Indians",
        "shortName": "Indians",
        "abbr": "CLE",
        "sportID": "1"
    },
    "5": {
        "name": "Detroit Tigers",
        "shortName": "Tigers",
        "abbr": "DET",
        "sportID": "1"
    },
    "6": {
        "name": "Houston Astros",
        "shortName": "Astros",
        "abbr": "HOU",
        "sportID": "1"
    },
    "7": {
        "name": "Kansas City Royals",
        "shortName": "Royals",
        "abbr": "KC",
        "sportID": "1"
    },
    "8": {
        "name": "Los Angeles Angels of Anaheim",
        "shortName": "Angels",
        "abbr": "LAA",
        "sportID": "1"
    },
    "9": {
        "name": "Minnesota Twins",
        "shortName": "Twins",
        "abbr": "MIN",
        "sportID": "1"
    },
    "10": {
        "name": "New York Yankees",
        "shortName": "Yankees",
        "abbr": "NYY",
        "sportID": "1"
    },
    "11": {
        "name": "Oakland Athletics",
        "shortName": "Athletics",
        "abbr": "OAK",
        "sportID": "1"
    },
    "12": {
        "name": "Seattle Mariners",
        "shortName": "Mariners",
        "abbr": "SEA",
        "sportID": "1"
    },
    "13": {
        "name": "Tampa Bay Rays",
        "shortName": "Rays",
        "abbr": "TB",
        "sportID": "1"
    },
    "14": {
        "name": "Texas Rangers",
        "shortName": "Rangers",
        "abbr": "TEX",
        "sportID": "1"
    },
    "15": {
        "name": "Toronto Blue Jays",
        "shortName": "Blue Jays",
        "abbr": "TOR",
        "sportID": "1"
    },
    "16": {
        "name": "Arizona Diamondbacks",
        "shortName": "Diamondbacks",
        "abbr": "ARI",
        "sportID": "1"
    },
    "17": {
        "name": "Atlanta Braves",
        "shortName": "Braves",
        "abbr": "ATL",
        "sportID": "1"
    },
    "18": {
        "name": "Chicago Cubs",
        "shortName": "Cubs",
        "abbr": "CHC",
        "sportID": "1"
    },
    "19": {
        "name": "Cincinnati Reds",
        "shortName": "Reds",
        "abbr": "CIN",
        "sportID": "1"
    },
    "20": {
        "name": "Colorado Rockies",
        "shortName": "Rockies",
        "abbr": "COL",
        "sportID": "1"
    },
    "21": {
        "name": "Los Angeles Dodgers",
        "shortName": "Dodgers",
        "abbr": "LAD",
        "sportID": "1"
    },
    "22": {
        "name": "Miami Marlins",
        "shortName": "Marlins",
        "abbr": "MIA",
        "sportID": "1"
    },
    "23": {
        "name": "Milwaukee Brewers",
        "shortName": "Brewers",
        "abbr": "MIL",
        "sportID": "1"
    },
    "24": {
        "name": "New York Mets",
        "shortName": "Mets",
        "abbr": "NYM",
        "sportID": "1"
    },
    "25": {
        "name": "Philadelphia Phillies",
        "shortName": "Phillies",
        "abbr": "PHI",
        "sportID": "1"
    },
    "26": {
        "name": "Pittsburgh Pirates",
        "shortName": "Pirates",
        "abbr": "PIT",
        "sportID": "1"
    },
    "27": {
        "name": "San Diego Padres",
        "shortName": "Padres",
        "abbr": "SD",
        "sportID": "1"
    },
    "28": {
        "name": "San Francisco Giants",
        "shortName": "Giants",
        "abbr": "SF",
        "sportID": "1"
    },
    "29": {
        "name": "St. Louis Cardinals",
        "shortName": "Cardinals",
        "abbr": "STL",
        "sportID": "1"
    },
    "30": {
        "name": "Washington Nationals",
        "shortName": "Nationals",
        "abbr": "WAS",
        "sportID": "1"
    }
};
var allTeamsByName = {
    "BAL": {
        "ID": "1",
        "name": "Baltimore Orioles",
        "shortName": "Orioles",
        "sportID": "1"
    },
    "BOS": {
        "ID": "2",
        "name": "Boston Red Sox",
        "shortName": "Red Sox",
        "sportID": "1"
    },
    "CWS": {
        "ID": "3",
        "name": "Chicago White Sox",
        "shortName": "White Sox",
        "sportID": "1"
    },
    "CLE": {
        "ID": "4",
        "name": "Cleveland Indians",
        "shortName": "Indians",
        "sportID": "1"
    },
    "DET": {
        "ID": "5",
        "name": "Detroit Tigers",
        "shortName": "Tigers",
        "sportID": "1"
    },
    "HOU": {
        "ID": "6",
        "name": "Houston Astros",
        "shortName": "Astros",
        "sportID": "1"
    },
    "KC": {
        "ID": "7",
        "name": "Kansas City Royals",
        "shortName": "Royals",
        "sportID": "1"
    },
    "LAA": {
        "ID": "8",
        "name": "Los Angeles Angels of Anaheim",
        "shortName": "Angels",
        "sportID": "1"
    },
    "MIN": {
        "ID": "9",
        "name": "Minnesota Twins",
        "shortName": "Twins",
        "sportID": "1"
    },
    "NYY": {
        "ID": "10",
        "name": "New York Yankees",
        "shortName": "Yankees",
        "sportID": "1"
    },
    "OAK": {
        "ID": "11",
        "name": "Oakland Athletics",
        "shortName": "Athletics",
        "sportID": "1"
    },
    "SEA": {
        "ID": "12",
        "name": "Seattle Mariners",
        "shortName": "Mariners",
        "sportID": "1"
    },
    "TB": {
        "ID": "13",
        "name": "Tampa Bay Rays",
        "shortName": "Rays",
        "sportID": "1"
    },
    "TEX": {
        "ID": "14",
        "name": "Texas Rangers",
        "shortName": "Rangers",
        "sportID": "1"
    },
    "TOR": {
        "ID": "15",
        "name": "Toronto Blue Jays",
        "shortName": "Blue Jays",
        "sportID": "1"
    },
    "ARI": {
        "ID": "16",
        "name": "Arizona Diamondbacks",
        "shortName": "Diamondbacks",
        "sportID": "1"
    },
    "ATL": {
        "ID": "17",
        "name": "Atlanta Braves",
        "shortName": "Braves",
        "sportID": "1"
    },
    "CHC": {
        "ID": "18",
        "name": "Chicago Cubs",
        "shortName": "Cubs",
        "sportID": "1"
    },
    "CIN": {
        "ID": "19",
        "name": "Cincinnati Reds",
        "shortName": "Reds",
        "sportID": "1"
    },
    "COL": {
        "ID": "20",
        "name": "Colorado Rockies",
        "shortName": "Rockies",
        "sportID": "1"
    },
    "LAD": {
        "ID": "21",
        "name": "Los Angeles Dodgers",
        "shortName": "Dodgers",
        "sportID": "1"
    },
    "MIA": {
        "ID": "22",
        "name": "Miami Marlins",
        "shortName": "Marlins",
        "sportID": "1"
    },
    "MIL": {
        "ID": "23",
        "name": "Milwaukee Brewers",
        "shortName": "Brewers",
        "sportID": "1"
    },
    "NYM": {
        "ID": "24",
        "name": "New York Mets",
        "shortName": "Mets",
        "sportID": "1"
    },
    "PHI": {
        "ID": "25",
        "name": "Philadelphia Phillies",
        "shortName": "Phillies",
        "sportID": "1"
    },
    "PIT": {
        "ID": "26",
        "name": "Pittsburgh Pirates",
        "shortName": "Pirates",
        "sportID": "1"
    },
    "SD": {
        "ID": "27",
        "name": "San Diego Padres",
        "shortName": "Padres",
        "sportID": "1"
    },
    "SF": {
        "ID": "28",
        "name": "San Francisco Giants",
        "shortName": "Giants",
        "sportID": "1"
    },
    "STL": {
        "ID": "29",
        "name": "St. Louis Cardinals",
        "shortName": "Cardinals",
        "sportID": "1"
    },
    "WAS": {
        "ID": "30",
        "name": "Washington Nationals",
        "shortName": "Nationals",
        "sportID": "1"
    }
};
var allSportsPositionsByID = {
    "1": {
        "sportID": "1",
        "positionNumber": "1",
        "name": "Pitcher",
        "abbr": "P"
    },
    "2": {
        "sportID": "1",
        "positionNumber": "2",
        "name": "Catcher",
        "abbr": "C"
    },
    "3": {
        "sportID": "1",
        "positionNumber": "3",
        "name": "First Base",
        "abbr": "1B"
    },
    "4": {
        "sportID": "1",
        "positionNumber": "4",
        "name": "Second Base",
        "abbr": "2B"
    },
    "5": {
        "sportID": "1",
        "positionNumber": "5",
        "name": "Third Base",
        "abbr": "3B"
    },
    "6": {
        "sportID": "1",
        "positionNumber": "6",
        "name": "Shortstop",
        "abbr": "SS"
    },
    "7": {
        "sportID": "1",
        "positionNumber": "7",
        "name": "Left Field",
        "abbr": "LF"
    },
    "8": {
        "sportID": "1",
        "positionNumber": "8",
        "name": "Center Field",
        "abbr": "CF"
    },
    "9": {
        "sportID": "1",
        "positionNumber": "9",
        "name": "Right Field",
        "abbr": "RF"
    },
    "10": {
        "sportID": "1",
        "positionNumber": "10",
        "name": "Designated Hitter",
        "abbr": "DH"
    }
};
var allSportsPositionsByName = {
    "P": {
        "ID": "1",
        "sportID": "1",
        "positionNumber": "1",
        "name": "Pitcher"
    },
    "C": {
        "ID": "2",
        "sportID": "1",
        "positionNumber": "2",
        "name": "Catcher"
    },
    "1B": {
        "ID": "3",
        "sportID": "1",
        "positionNumber": "3",
        "name": "First Base"
    },
    "2B": {
        "ID": "4",
        "sportID": "1",
        "positionNumber": "4",
        "name": "Second Base"
    },
    "3B": {
        "ID": "5",
        "sportID": "1",
        "positionNumber": "5",
        "name": "Third Base"
    },
    "SS": {
        "ID": "6",
        "sportID": "1",
        "positionNumber": "6",
        "name": "Shortstop"
    },
    "LF": {
        "ID": "7",
        "sportID": "1",
        "positionNumber": "7",
        "name": "Left Field"
    },
    "CF": {
        "ID": "8",
        "sportID": "1",
        "positionNumber": "8",
        "name": "Center Field"
    },
    "RF": {
        "ID": "9",
        "sportID": "1",
        "positionNumber": "9",
        "name": "Right Field"
    },
    "DH": {
        "ID": "10",
        "sportID": "1",
        "positionNumber": "10",
        "name": "Designated Hitter"
    }
};
