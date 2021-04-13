<?php
$shopify = $_GET;

//echo "<pre>";
//print_r($shopify);
//echo $shopify['shop'];
//echo "</pre>";

$shop = 'itzapptst';
$token =  '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';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Topbar Management</title>
        <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
        <!-- bootstrap iN core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Add custom CSS here -->
        <link href="css/dashboard.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/dashboard.js" ></script>

    </head>
    <body class="welcometo">
        <div class="coming-soon">Coming Soon
        <br>
            <a href="dashboard.php">Click Here To Login</a>
        </div>

    </body>
</html>

<?php

$array_del = array(
    'script_tag' => array(
        'event' => 'onload',
        'cache' => false,
        'src' => 'https://shopinav.infotechsolz.com/js/shopify.js'
    )
);
$scriptTag_del = shopify_call($token, $shop, "/admin/api/2019-07/script_tags.json", $array, 'DELETE');
$scriptTag_del = json_decode($scriptTag_del['response'], JSON_PRETTY_PRINT);

$array = array(
    'script_tag' => array(
        'event' => 'onload',
        'cache' => false,
        'src' => 'https://shopinav.infotechsolz.com/js/shopify.js'
    )
);
$scriptTag = shopify_call($token, $shop, "/admin/api/2019-07/script_tags.json", $array, 'POST');
$scriptTag = json_decode($scriptTag['response'], JSON_PRETTY_PRINT);

?>

<?php
function shopify_call($token, $shop, $api_endpoint, $query = array(), $method = 'GET', $request_headers = array()) {

    // Build URL
    $url = "https://" . $shop . ".myshopify.com" . $api_endpoint;
    if (!is_null($query) && in_array($method, array('GET', 	'DELETE'))) $url = $url . "?" . http_build_query($query);

    // Configure cURL
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, TRUE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 3);
    // curl_setopt($curl, CURLOPT_SSLVERSION, 3);
    curl_setopt($curl, CURLOPT_USERAGENT, 'My New Shopify App v.1');
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

    // Setup headers
    $request_headers[] = "";
    if (!is_null($token)) $request_headers[] = "X-Shopify-Access-Token: " . $token;
    curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);

    if ($method != 'GET' && in_array($method, array('POST', 'PUT'))) {
        if (is_array($query)) $query = http_build_query($query);
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $query);
    }

    // Send request to Shopify and capture any errors
    $response = curl_exec($curl);
    $error_number = curl_errno($curl);
    $error_message = curl_error($curl);

    // Close cURL to be nice
    curl_close($curl);

    // Return an error is cURL has a problem
    if ($error_number) {
        return $error_message;
    } else {

        // No error, return Shopify's response by parsing out the body and the headers
        $response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);

        // Convert headers into an array
        $headers = array();
        $header_data = explode("\n",$response[0]);
        $headers['status'] = $header_data[0]; // Does not contain a key, have to explicitly set
        array_shift($header_data); // Remove status, we've already set it above
        foreach($header_data as $part) {
            $h = explode(":", $part);
            $headers[trim($h[0])] = trim($h[1]);
        }

        // Return headers and Shopify's response
        return array('headers' => $headers, 'response' => $response[1]);

    }

}
?>
