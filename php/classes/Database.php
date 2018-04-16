<?php

   class MySQLDB {
      var $DB_SERVER = "127.0.0.1";
      var $DB_USER = "root";
      var $DB_PASS = "";
      var $DB_NAME = "optimizer";
      var $DB_PORT = 3306;

      var $connection;
      var $syslogOutput;

      var $lastGivenID;

      function __construct(){
         $this->connect();
      }

      function close() {
         mysqli_close($this->connection);
      }

      function ping() {
         mysqli_ping($this->connection);
      }

      function connect() {
         $this->connection = mysqli_connect($this->DB_SERVER, $this->DB_USER, $this->DB_PASS, "", $this->DB_PORT);
         if ($this->connection===false) die("connection to $this->DB_SERVER on $this->DB_PORT failed.\n");

         $res = mysqli_select_db($this->connection, $this->DB_NAME);
         if ($res===false) die("select db failed");
      }

      function getNewID() {
         $newID = intval(microtime(true) * 1000);;
         if ($newID == $lastGivenID) $newID++;
         return $newID;
      }

      function queryToObject($query) {
         $res = $this->query($query);

         $rows = array();
         while($r = mysqli_fetch_object($res)) {
            $rows[] = $r;
         }

         return $rows;
      }

      function queryToAssoc($query) {
         $res = $this->query($query);

         $rows = array();
         while($r = mysqli_fetch_assoc($res)) {
            $rows[] = $r;
         }

         return $rows;
      }

      function query($query){
         if (mysqli_ping($this->connection)==false) {
            echo "detected stale connection. attempting reconnect...\n";
            $this->close();
            $this->connect();
         }

         //echo "DB:$query\n";
         $query = str_replace(array("\r\n", "\n", "\r"), "", $query);
         // syslog(LOG_INFO, "%TESTGAME-9-999999: ".$query);
         // echo $query."\n";
         return mysqli_query($this->connection, $query);
      }

   };

   class DB {
      static private $db;
      static private $enabled = true;

      public static function init() {
         self::$db = new MySQLDB();
      }

      public static function getInsertID() {
         return mysqli_insert_id(self::$db->connection);
      }

      public static function queryToObject($query) {
         return self::$db->queryToObject($query);
      }

      public static function ping() {
         return self::$db->ping();
      }

      public static function queryToAssoc($query) {
         return self::$db->queryToAssoc($query);
      }

      public static function query($query) {
         if (self::$enabled==false) return;

         return self::$db->query($query);
      }

      public static function disable() {
         self::$enabled = false;
      }

      public static function enable() {
         self::$enabled = true;
      }

      public static function getError() {
         return mysqli_error(self::$db->connection);
      }
   }

   \DB::init();

?>
