<html>
  <head>
    <script language="VBScript">
      sub Verzend(actie)
        fMijnFormulier.action="koppel_verslag.php?actie=" & actie
        fMijnFormulier.submit
      end sub
    </script>
  </head>
  <body>
    <?php
      // get subjectId from url; soms in kleine letters, soms met hoofdletters.
      $subjectId = $subjectIdErr = "";
      if (isset($_GET['sbid'])) {
        $subjectId = $_GET['sbid'];
      } else if (isset($_GET['SbId'])) {
        $subjectId = $_GET['SbId'];
      }
    ?>

    <form name="fMijnFormulier" method="post">
      SubjectId: <?php echo "$subjectId"; ?><br>

      <br><br>
      <input type="button" name="button1" value="Koppel Nederlands rapport" onclick="Verzend NL" /> <br />  <br>
      <input type="button" name="button2" value="Koppel Engels rapport"     onclick="Verzend EN" /> <br />  
    </form>
  </body>
</html>
