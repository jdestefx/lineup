var _gamePickerBar = function() {
   var gp = this;

   gp.php = new system.base.phpCaller({url: "./php/game-picker-actions.php"});
   // gp.gameData = null;
   gp.allGames = [];
   gp.selectedGame = null;

   gp.construct = function() {
      gp.body = $(document.body).find(".game-picker-content");
   }

   gp.presentGamesForSlateID = function(slateID) {
      main.todayData.allSlates.forEach(function(s) {
         if (s.slateID!=slateID) return;
         if (s.games.length==0) return;

         var keepGames = main.todayData.allGames.filter((g)=>{
            return (s.games.indexOf(g.gameID)!=-1);
         });

         gp.presentGames(keepGames);
      });
   }

   // gp.loadGamesBySlateID = function(slateID) {
   //    gp.php.go({
   //       data: {m: "loadGamesBySlateID", slateID: slateID},
   //       success: function(data) {
   //          gp.gameData = data;
   //          gp.presentGameEntries();
   //       }
   //    });
   // }

   gp.presentGames = function(games) {
      gp.wipe();
      games.forEach((g)=>{
         var newGameGame = new gp._game(g);
         gp.allGames.push(newGameGame);
      });
   }

   gp.wipe = function() {
      gp.allGames.length = 0;
      gp.body.empty();
   }

   gp.selectGame = function(game) {
      if (gp.selectedGame===game) return;

      gp.selectedGame = game;
      gp.selectedGame.setActive(true);

      gp.allGames.forEach((g)=>{
         if (g!==game) g.setActive(false);
      });

   }

   this._game = function(opts) {
      var g = this;

      if (opts.gameID == undefined) return console.error("ID (gameID) required for creation of game.");

      $.extend(this, {
         homeLineup: null,
         awayLineup: null,
         gameID: null,
         homeTeamID: null,
         awayTeamID: null,
         gameTime: null
      }, opts);

      g.lineupEntryTemplate = system.parts.get("[for=lineup-entry]");

      g.construct = function() {
         system.parts.integrate.apply(this, ["[for=game-picker] [for=game-entry]"]);
         g.body.appendTo(gp.body);

         g.divMatchup.text(`${allTeamsByID[g.homeTeamID].abbr} @ ${allTeamsByID[g.awayTeamID].abbr}`);
         g.determineStatusLabel();
         g.renderLineup();
      }

      g.onBodyClicked = function(event) {
         gp.selectGame(g);
      }

      g.determineStatusLabel = function() {
         if (g.gameTime != 0) {

            var d = new Date(g.gameTime*1000);

            g.divStatus.text(`${d.getHours()}:${d.getMinutes()} EST`);
         }
      }

      g.setActive = function(active) {
         g.body.toggleClass("selected", active);
      }

      g.renderLineup = function() {
         g.divHomeLineup.empty();
         g.homeLineup.data.forEach((lineupEntry)=>{
            var e = {};
            system.parts.integrate.apply(e, ["[for=lineup-entry]"]);

            e.divPosition.text(allSportsPositionsByID[Object.keys(lineupEntry)[0]].abbr);
            e.divPlayer.text(utils.abbreviateFullName(Object.values(lineupEntry)[0]));

            e.divBody.appendTo(g.divHomeLineup);
         });

         g.divAwayLineup.empty();
         g.awayLineup.data.forEach((lineupEntry)=>{
            var e = {};
            system.parts.integrate.apply(e, ["[for=lineup-entry]"]);

            e.divPosition.text(allSportsPositionsByID[Object.keys(lineupEntry)[0]].abbr);
            e.divPlayer.text(utils.abbreviateFullName(Object.values(lineupEntry)[0]));

            e.divBody.appendTo(g.divAwayLineup);
         });

      }

      g.construct();
      return this;
   }


   gp.construct();
   return this;
}
