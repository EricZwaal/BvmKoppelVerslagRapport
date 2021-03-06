<html>
  <body>
    <?php
      // Hier gaat het gebeuren!
      $subjectId = $taal = $repGuid = $token = $fileName = $message = $encodedToken = $url = $result = $filedata = "";

      session_start();
      $subjectId=$_SESSION['subjectId'];

      if($_SERVER['REQUEST_METHOD']=="POST"){
        switch($_POST["button"]) {
          case "Koppel Nederlands rapport":
            $taal="NL";
            $repGuid = 'F8623E3146B76227A47E1191151D2E5F';
            $fileName="Verslag.pdf";
            $message="Het Nederlandse rapport is nu gekoppeld aan het dossieritem. Ververs de pagina (F5) om het zichtbaar te maken.";
            break;
          case "Koppel Engels rapport":
            $taal="EN";
            $repGuid = 'FB9AFB3C47411E357DE1108586DBD271';
            $fileName="Report.pdf";
            $message="Het Engelse rapport is nu gekoppeld aan het dossieritem. Ververs de pagina (F5) om het zichtbaar te maken.";
            break;
        }
      }
      else
      {
        echo "Er is iets fout gegaan! Er is geen POST gevonden";
      }

      // token voor reportconnector:
      $token = '<token><version>1</version><data>17F8567825A44...</data></token>';
      $encodedToken = base64_encode($token);
      $url = 'https://50762.rest.afas.online/profitrestservices/reportconnector/' . $repGuid . '?filterfieldids=KnSbjSbId&operatortypes=1&filtervalues=' . $subjectId;
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
      $url = 'https://50762.rest.afas.online/profitrestservices/connectors/KnSubject/KnSubjectAttachment';
      $file = '{"KnSubject": {
          "Element": {
            "@SbId": ' . $subjectId . ',
            "Objects": [{
                "KnSubjectAttachment": {
                  "Element": {"Fields": {
                      "FileName": "' . $fileName . '",
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

      echo $message;
    ?>
  </body>
</html>
