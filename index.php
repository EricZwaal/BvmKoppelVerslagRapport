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
      session_start();
      $_SESSION['subjectId'] = $subjectId;
    ?>

    <form action="koppel_verslag.php" method="post">
      <br>
      <input type="submit" name="button" value="Koppel Nederlands rapport" > <br />  <br>
      <input type="submit" name="button" value="Koppel Engels rapport"     > <br />  
    </form>
  </body>
</html>
