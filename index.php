<html>
  <body>
    <?php
      // get subjectId from url
      $subjectId = $subjectIdErr = "";
      if (isset($_GET['sbid'])) {
        $subjectId = $_GET['sbid'];
      }
      // if not posted, language is dutch.
      $language = "dutch";
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // get subjectId from post
        if (empty($_POST["subjectId"])) {
          $subjectIdErr = "Vul het dossieritemid in";
        } else {
          $subjectId = test_input($_POST["subjectId"]);
        }
        if (empty($_POST["language"])) {} else {
          $language = test_input($_POST["language"]);
        }
      }
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    ?>

    <h2>Koppel een rapport aan dit verslag</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      SubjectId:
      <input type="text" name="subjectId" value="<?php echo $subjectId;?>"><span class="error">* <?php echo $subjectIdErr;?></span>
      <br><br>
      Taal:
      <input type="radio" name="language" <?php if (isset($language) && $language=="dutch") echo "checked";?> value="dutch">Nederlands
      <input type="radio" name="language" <?php if (isset($language) && $language=="english") echo "checked";?> value="english">Engels
      <span class="error">

      <br><br>
      <input type="submit" name="button1" value="Koppel het rapport">  
    </form>
    <?php
      if (isset($_POST[button1])) {
        // Hier gaat het gebeuren!
        $token = $encodedToken = $url = $result = $filedata = "";
        // Voor reportconnector:
        $token = '<token><version>1</version><data>17F8567825A440EEA6B1FDB9F6F6A12E5BA226C040DF93AE1B9D018F89282AB3</data></token>';
        $encodedToken = base64_encode($token);
        $url = 'https://50762.afasonlineconnector.nl/ProfitRestServices/reportconnector/FB9AFB3C47411E357DE1108586DBD271?filterfieldids=KnSbjSbId&operatortypes=1&filtervalues=' . $subjectId;
        $curl = curl_init($url);
        // Returns the data/output as a string instead of raw data
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //Set your auth headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Authorization: AfasToken ' . $encodedToken
          ));
        
        // get stringified data/output. See CURLOPT_RETURNTRANSFER
        $result = curl_exec($curl);
  echo $result;
//        $result = json_decode($result, true));
//        $filedata = $result[filedata];
//  echo $filedata;

        // close curl resource to free up system resources 
//        curl_close($curl)

      /*
        $url = 'https://50762.afasonlineconnector.nl/ProfitRestServices/connectors/KnSubject/KnSubjectAttachment'
        $file = '{
          "KnSubject": {
            "Element": {
              "@SbId": ' . $subjectId . ',
              "Objects": [
                {
                  "KnSubjectAttachment": {
                    "Element": {
                      "Fields": {
                        "FileName": "Report.pdf",
                        "FileStream": "' . $filedata . '"
                      }
                    }
                  }
                }
              ]
            }
          }
        }'

        $curl = curl_init($url);
        // Returns the data/output as a string instead of raw data
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Method
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");   
        // Set the auth headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'ContentType: application/json;charset=utf-8',
          'Authorization: AfasToken ' . $encodedToken
          ));
        // Set the body
        curl_setopt($curl, CURLOPT_POSTFIELDS, $file); 
        // Make response be put in variable instead of being echoed
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        
        // get stringified data/output. See CURLOPT_RETURNTRANSFER
        $result = curl_exec($curl);
        echo $result
        
        // close curl resource to free up system resources 
        curl_close($curl)
      */
      }
    ?>
  </body>
</html>
