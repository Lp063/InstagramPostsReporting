<?php


function readCsvFile($filename){
    $array=[];
    
    $file = fopen($filename, 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
    //$line is an array of the csv elements
    $array[]=$line;
    }
    fclose($file);
    return $array;
}

function getDataFromInstagram($url){
    $data = file_get_contents($url."?__a=1", 0, stream_context_create(["http"=>["timeout"=>1]]));
    $arrayFormat=json_decode($data,true);
    if ($arrayFormat["graphql"]["user"]["id"] && $arrayFormat["graphql"]["user"]["username"]) {
        $return=[
            "id"=>$arrayFormat["graphql"]["user"]["id"],
            "username"=>$arrayFormat["graphql"]["user"]["username"]
        ];
    } else {
        $return=[
            "id"=>"",
            "username"=>""
        ];
    }
    
    return $return;
}

$temp_handles = array(
    'theorangeepistles'	=>	247198066,
    'bhaiyajiismile' => 261820212,
    'varunsood12' => 1681669779,
    'alya_manasa' => 2931333813,
    'shrutisinhahaha' => 1330847904,
    'jananiiyer' => 282887137,
    'monami_ghosh' => 1602592758,
    'vaishnavi_rao5' => 993895699,
    'mahathalli' => 1681498583,
    'richi.shah' => 1582620947,
    'saloniseh' => 1045148641,
    'nicoleconcessao' => 547985430,
    'shaniceshrestha' => 535918398,
    'mohit_hiranandani93' => 631864286,
    'asmitarora' => 1095442453, 
    'pradainisurva' => 1470848254,
    'arushi.handa.official' => 4357958366,
    'dapperlytamed' => 208500450,
    'meki_amgo_' => 8265984833,
    'pehenawah' => 534844879
);

$xyz=[
    "karishmasamat"=>259023091,
    "suchetapal"=>842492589,
    "kimparadise7"=>1486088930,
    "thestyletune"=>1793751438,
    "saraarfeenkhan"=>1187726023,
    "sneha_261013"=>631267724,
    "avantii2"=>351110399,
    "ritcha"=>10613106,
    "shivangigoel__"=>268396639,
    "heenadhedhi"=>1269644031,
    "biologicalmom"=>9876008222,
    "mammaslifestyle"=>315979496,
    "myteenytot"=>3473087158,
    "mommyvoyage"=>1537629647,
    "mumfiesta"=>7508511334,
    "cradle.full.of.joy"=>1588439946,
    "highstreetmommy"=>1432472532,
    "beingmomtastic"=>462271533,
    "yuvi.says"=>358925557,
    "amominlove"=>1237192815,
    "surbhi.dhall"=>1806038368,
    "momandtoddlers"=>5477398667,
    "mummasauruss"=>1585560583,
    "docdivatraveller"=>1297097346,
    "riturathee"=>1599998413,
];

$dataFromCsv = readCsvFile('siddimport1.csv');

$finalArray = [];
foreach ($dataFromCsv as $key => $value) {
    if ($key >= 1) {
        $requiredData = getDataFromInstagram($value[2]);
        //echo"<pre>";print_r($requiredData);
        $finalArray[][$requiredData["id"]]=$requiredData["username"];
    }
    /* $handle = trim(explode("https://www.instagram.com/",$value[2])[1],"/");
    if ($handle) {
        $requiredData[] = getDataFromInstagram($value[2]);
    } */
}
echo"<pre>";print_r($finalArray);
exit();

?>