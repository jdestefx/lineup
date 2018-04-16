var _sitePickerBar = function() {
   var bar = this;

   bar.allSiteButtons = [];
   bar.selectedButton = null;

   bar.construct = function() {
      bar.body = $(document.body).find(".site-picker-content");
      bar.addSiteButton("fanDuel", "fanduel.png");
      bar.addSiteButton("draftKings", "draftkings.png");
   }


   bar.addSiteButton = function(siteName, imageFile) {
      var newButton = new bar._siteButton({
         siteName: siteName, imageFile: imageFile
      });

      bar.allSiteButtons.push(newButton);
   }

   bar.selectButton = function(button) {
      if (bar.selectedButton==button) return;

      bar.selectedButton = button;
      bar.selectedButton.setActive(true);

      bar.allSiteButtons.forEach((b)=>{
         if (b!==button) b.setActive(false);
      });

      main.slatePickerBar.showSlatesForSiteShortName(button.siteName);
   }


   // children
   this._siteButton = function(opts) {
      var sb = this;


      $.extend(this, {
         siteName: "noNameProvided",
         imageFile: "blank.png",
      }, opts);

      sb.construct = function() {
         sb.body = system.parts.integrate.apply(this, ["[for=site-picker] [for=site-button]"]);
         sb.body.appendTo(bar.body);
         sb.imageHolder.attr("src", "./media/"+sb.imageFile);
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
