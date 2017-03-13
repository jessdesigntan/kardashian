<?php
  include("controllers/template.php");
  head("test");
?>
<html>
  <body>
    &#x1f64c;
  </body>
  <script>
    function emoji() {
      var emoji = twemoji.convert.toCodePoint('\ud83d\ude4c');
      return emoji;  
    }

  </script>
</html>
