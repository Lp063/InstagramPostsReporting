<?php

require __DIR__ . '/vendor/autoload.php';

	/*{
	    "username": "samyuktha_hegde",
	    "account_label": "Samyuktha Hegde",
	    "user_image": "https:\/\/scontent-lga3-1.cdninstagram.com\/vp\/9bdcdc93159ac1c008402f472ab583ca\/5E2DB3B7\/t51.2885-19\/s320x320\/23668140_1290019301101966_194308185941606400_n.jpg?_nc_ht=scontent-lga3-1.cdninstagram.com",
	    "total_followers": "915,387",
	    "engagement_rate": "5.17",
	    "total_likes": "47,205",
	    "total_comments": "78",
	    "status": "success"
	}*/

function scrapeInstagram($handle){
	$jsonResponse = file_get_contents("https://www.instagram.com/".$handle."/?__a=1");
	$data = json_decode($jsonResponse,true);
	return $data;
}


function dataForHandle($data,$isjson2csv){
	$likes=0;
	$comments =0;
	$engagementRate=0;
	$consideredPosts = sizeof($data["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"]);
	foreach ($data["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"] as $key => $value) {
		$comments += $value["node"]["edge_media_to_comment"]["count"];
		$likes += $value["node"]["edge_liked_by"]["count"];
	}
	$engagementRate= round(($comments+$likes)/$data["graphql"]["user"]["edge_followed_by"]["count"],2);
	if($isjson2csv){
		$required=[
			"username"=> $data["graphql"]["user"]["username"],
		    "account_label"=> $data["graphql"]["user"]["full_name"],
		    "user_image"=> $data["graphql"]["user"]["profile_pic_url_hd"],
		    "total_followers"=> $data["graphql"]["user"]["edge_followed_by"]["count"],
		    "engagement_rate"=> $engagementRate,
		    "total_likes"=> $likes,
		    "total_comments"=> $comments,
		    "TotalPosts"=> $data["graphql"]["user"]["edge_owner_to_timeline_media"]["count"],
		    "ConsideredPosts"=> $consideredPosts
		];
	}else{
		$required=[
			$data["graphql"]["user"]["username"],
		    $data["graphql"]["user"]["full_name"],
		    $data["graphql"]["user"]["profile_pic_url_hd"],
		    $data["graphql"]["user"]["edge_followed_by"]["count"],
		    $engagementRate,
		    $likes,
		    $comments,
		    $data["graphql"]["user"]["edge_owner_to_timeline_media"]["count"],
		    $consideredPosts
		];
	}
	return $required;
}

function processInfluencerHandles($handles,$isjson2csv){
	if (!$isjson2csv) {
		$final[]=[
			"username",
		    "account_label",
		    "user_image",
		    "total_followers",
		    "engagement_rate",
		    "total_likes",
		    "total_comments",
		    "TotalPosts",
		    "ConsideredPosts"
		];
	}
	foreach ($handles as $key => $handle) {
		$influencerAccount = scrapeInstagram($handle);
		$final[] = dataForHandle($influencerAccount,$isjson2csv);
	}
	return $final;
}

function processInfluencers($urlArr,$isjson2csv){
	foreach ($urlArr as $key => $instaLink) {
		$split = explode('https://www.instagram.com/', trim($instaLink));
		$split2 = explode('/', $split[1]);
		$handles[]=$split2[0];
	}
	$processedHandles = processInfluencerHandles($handles,$isjson2csv);
	return $processedHandles;
}

function generateCsvFile($arrRows){
	$filePath="reports/".date('d F Y h_i_s A').".csv";
	$file = fopen($filePath,"w");

	foreach ($arrRows as $line) {
	  fputcsv($file, $line);
	}

	fclose($file);

	// $link = "://"; 
	$link = "192.168.2.116/project/scraping/";
	//$link .= $_SERVER['REQUEST_URI'];

	return $filePath;
}
$rawHandles=[
	"https://www.instagram.com/aashnahegde/",
	"https://www.instagram.com/anmolbhatia_/",
	"https://www.instagram.com/ashi_khanna/",
	"https://www.instagram.com/ahsaassy_/",
	"https://www.instagram.com/thechiquefactor/",
	"https://www.instagram.com/kushakapila/",
	"https://www.instagram.com/cherryjain21/?hl=en",
	"https://www.instagram.com/rits_badiani/",
	"https://www.instagram.com/vitastabhat/"
];

function getReport($isjson2csv){
	if(!$isjson2csv){
		$arrRows = processInfluencers($_POST['data'],FALSE);
		$response = [
			"success"=>1,
			"data"=>generateCsvFile($arrRows)
		];
	}else{
		$response = processInfluencers($_POST['data'],TRUE);exit();
	}
	return json_encode($response);
}
echo getReport(FALSE);exit();
//echo json_encode(processInfluencers($_POST['data']));exit();

/*****************************************************************************/
/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
// https://github.com/googleapis/google-api-php-client
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
    
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	$client->setRedirectUri($redirect_uri);
	if (isset($_GET['code'])) {
	    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	}
    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }
	echo"<pre>";print_r($client);exit();
    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets($client);

// Prints the names and majors of students in a sample spreadsheet:
// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
$spreadsheetId = '1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms';
$range = 'Class Data!A2:E';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if (empty($values)) {
    print "No data found.\n";
} else {
    print "Name, Major:\n";
    foreach ($values as $row) {
        // Print columns A and E, which correspond to indices 0 and 4.
        printf("%s, %s\n", $row[0], $row[4]);
    }
}

//echo json_encode(processInfluencers($_POST['data']));exit();
/*$response["success"] = (sizeof($data) > 1) ? 1 : 0;
$response["data"] = $data;
echo json_encode($response);exit();
*/
?>