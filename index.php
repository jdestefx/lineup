<?php
   require_once("php/ConstantsWriter.php");
   require_once("php/HeadWriter.php");
?>

<!DOCTYPE html>

<html>

   <head>
      <title>Bootstrap</title>
      <?php Head::write(); ?>
   </head>


   <body>
      <div class="title-holder">
         <div class="date-holder"><div class="date-display">Testing Test 21th</div></div>
         <img src="./media/title-smaller.png">
      </div>
      <div class="site-picker-content"></div>
      <div class="slate-picker-content"></div>
      <div class="game-picker-content"></div>
   </body>

   <script language="javascript">
      var main = new _main();
   </script>


</html>
