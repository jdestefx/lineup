var _slatePickerBar = function() {
   var bar = this;

   bar.allSlateButtons = [];
   bar.selectedButton = null;
   //bar.php = system.base.phpCaller({url: "./php/slate-picker-actions.php"});

   bar.construct = function() {
      bar.body = $(document.body).find(".slate-picker-content");
   }


   bar.addSlateButton = function(name, title, ID) {
      var newButton = new bar._slateButton({
         name: name, title: title, ID: ID
      });

      bar.allSlateButtons.push(newButton);
   }

   bar.selectButton = function(button) {
      if (bar.selectedButton==button) return;

      bar.selectedButton = button;
      bar.selectedButton.setActive(true);

      bar.allSlateButtons.forEach((b)=>{
         if (b!==button) b.setActive(false);
      });

      main.gamePickerBar.presentGamesForSlateID(button.ID);
   }

   bar.showSlatesForSiteShortName = function(hostSiteShortName) {
      var newSlates = [];

      main.todayData.allSlates.forEach(function(s) {
         if (s.hostSiteShortName!=hostSiteShortName) return;
         newSlates.push(s);
      });

      bar.presentSlates(newSlates);
   }

   bar.presentSlates = function(slates) {
      bar.wipe();
      slates.forEach((s)=>{
         bar.addSlateButton(s.description, s.description, s.slateID);
      });
   }

   bar.wipe = function() {
      bar.selectedButton = null;
      bar.body.empty();
   }

   // children
   this._slateButton = function(opts) {
      var sb = this;

      if (opts.ID === undefined) return console.error("ID required to create _slateButton");

      $.extend(this, {
         name: "noNameProvided",
         title: "no-title-provided",
      }, opts);

      sb.construct = function() {
         sb.body = system.parts.integrate.apply(this, ["[for=slate-picker] [for=slate-button]"]);
         sb.body.appendTo(bar.body);
         sb.divTitle.text(sb.title);
      }

      sb.setActive = function(newMode) {
         sb.body.toggleClass("selected", newMode);
         sb.body.toggleClass("deselected", !newMode);
      }

      sb.onClicked = function(event) {
         bar.selectButton(sb);
      }

      sb.construct();
      return this;
   }

   bar.construct();
   return this;

}
