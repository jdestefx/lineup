var system = new _system();
var now = new Date();
var today = `${now.getYear()+1900}${(now.getMonth()+1).toString().zeroPad(2)}${(now.getDate()).toString().zeroPad(2)}`;

var _main = function() {
   var m = this;

   m.todayData = null;
   m.allRosters = [];
   m.php = new system.base.phpCaller({url: "./php/site-actions.php"});

   m.construct = function() {
      $.when(system.systemWorking()).done(m.onSystemReady);      
   }

   m.onSystemReady = function() {
      m.sitePickerBar = new _sitePickerBar();
      m.slatePickerBar = new _slatePickerBar();
      m.gamePickerBar = new _gamePickerBar();

      m.fetchDataForToday();
   }


   m.fetchDataForToday = function() {
      m.php.go({data: {m: "getRosterForDate", date: today}, success: m.onFetchReturn});
   }

   m.onFetchReturn = function(data) {
      m.todayData = data;
   }

   m.construct();
   return this;

}

