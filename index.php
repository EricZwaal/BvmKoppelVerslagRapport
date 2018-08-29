<html>
  <body>
    <?php
      // get subjectId from url; soms in kleine letters, soms met hoofdletters.
      $subjectId = $subjectIdErr = "";
      if (isset($_GET['sbid'])) {
        $subjectId = $_GET['sbid'];
      } else if (isset($_GET['SbId'])) {
        $subjectId = $_GET['SbId'];
      }
      $x = 'koppel_verslag.php&SbId=' & $subjectId;
      echo $x;
      echo $subjectId;
    ?>

    <form action="koppel_verslag.php" method="post">
      <br>
      <?php echo $subjectId,$x ?>
      <br><br>
      <input type="submit" name="button" value="Koppel Nederlands rapport" > <br />  <br>
      <input type="submit" name="button" value="Koppel Engels rapport"     > <br />  
    </form>
  </body>
</html>
