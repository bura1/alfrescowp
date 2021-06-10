<?php

// Download file
$curl = curl_init();

$api_url = "https://USERNAME:PASSWORD@ALFRESCO_DOMAIN:COM/alfresco/api/-default-/public/alfresco/versions/1/nodes/".$_GET['id']."/content";

curl_setopt_array($curl, array(
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    header('Content-type: application/pdf');
    header('Content-Disposition: attachment; filename="'.$_GET["filename"].'"');
    echo $response;
}

?>
