<html>
  <body>
    <?php
      session_start();
      $subjectId=$_SESSION['subjectId'];

      if($_SERVER['REQUEST_METHOD']=="POST"){
        $subjectId=$_POST["lngSbId"];
        switch($_POST["button"]) {
          case "Koppel Nederlands rapport":
            $taal="NL";
            break;
          case "Koppel Engels rapport":
            $taal="EN";
            break;
        }

        echo "Hello world!";
        echo "$taal";
        echo "$subjectId";
      }
      else
      {
        echo "geen POST gevonden";
      }
    ?>
/*    
        // Hier gaat het gebeuren!
        $token = $encodedToken = $repGuid = $url = $result = $filedata = "";
        // token voor reportconnector:
        $token = '<token><version>1</version><data>17F8567825A440EEA6B1FDB9F6F6A12E5BA226C040DF93AE1B9D018F89282AB3</data></token>';
        $encodedToken = base64_encode($token);
        // Engels verslag
        if ($taal=="dutch") {
          $repGuid = 'F8623E3146B76227A47E1191151D2E5F';
        } else {
          $repGuid = 'FB9AFB3C47411E357DE1108586DBD271';
        }
        $url = 'https://50762.afasonlineconnector.nl/ProfitRestServices/reportconnector/' . $repGuid . '?filterfieldids=KnSbjSbId&operatortypes=1&filtervalues=' . $subjectId;
        $curl = curl_init($url);
        // Returns the data/output as a string instead of raw data
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //Set your auth headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Authorization: AfasToken ' . $encodedToken
          ));
        
        // get stringified data/output. See CURLOPT_RETURNTRANSFER
        $result = curl_exec($curl);
        $result = json_decode($result, true);
        $filedata = $result[filedata];
        // close curl resource to free up system resources 
        curl_close($curl);
  
        // send report back to subjectitem
        $url = 'https://50762.afasonlineconnector.nl/ProfitRestServices/connectors/KnSubject/KnSubjectAttachment';
        $file = '{"KnSubject": {
            "Element": {
              "@SbId": ' . $subjectId . ',
              "Objects": [{
                  "KnSubjectAttachment": {
                    "Element": {"Fields": {
                        "FileName": "Verslag.pdf",
                        "FileStream": "' . $filedata . '"
                      }}}}]}}}';
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
        
        // close curl resource to free up system resources 
        curl_close($curl);
        // show the report in the browser
        $decoded = base64_decode($filedata);
        $file = 'Verslag.pdf';
        file_put_contents($file, $decoded);
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pfd');
            header('Content-Disposition: inline; filename="'.basename($file).'"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($file));
            header('Accept-Ranges: bytes');
            @readfile($file);
            unlink($file);
        }        
      }
    ?>
    */
  </body>
</html>
