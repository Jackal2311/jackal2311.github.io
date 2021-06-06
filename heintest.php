<?php



$stocks = array("07000-02020", "14x-30-13164", "06040-06315");

$a = array();

$st = array();

foreach ($stocks as $stock) {


    $url = "https://en.av-gk.ru/spare/komatsu/{$stock}/";
    $ua = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.14 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13';


    $curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, $url);
    curl_setopt($curlSession, CURLOPT_USERAGENT, $ua);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_ENCODING, '');


    $response = curl_exec($curlSession);
    curl_close($curlSession);


    die($response);


    $outputarr = explode("Compatible equipment models", $response);

    $output = $outputarr[1];

    $outputarr = explode("</div>" . PHP_EOL . "</div>" . PHP_EOL . "</div>", $output);

    $output = $outputarr[0];

    $output = $output;

    $output = strip_tags($output, "<b>");
    $output = str_replace("</b>", "</b>#", $output);
    $output = preg_replace("/\r|\n/", "", $output);
    $output = str_replace(" ", ",", $output);
    $output = str_replace(",,", ",", $output);
    $output = str_replace(",,", ",", $output);
    $output = str_replace(",,", ",", $output);
    $output = str_replace(",,", ",", $output);
    $output = str_replace(",,", ",", $output);
    $output = str_replace(",,", ",", $output);
    $output = str_replace(",,", ",", $output);
    $output = str_replace(",,", ",", $output);
    $output = str_replace("&nbsp;", "", $output);
    $output = str_replace("<b>", "@@@", $output);
    $output = str_replace("</b>", "!!!", $output);

    $output = substr($output,"2",strlen($output)-18);
    $output = str_replace(":,", "***", $output);

    $output .= "^^^";

    $a[] = explode("^^^", $output);

}

$counter = 0;
foreach($a as $b) {

    $part1 = explode("***",$b[0]);

    var_dump($part1);
    die();


    $tmp1 = str_replace(":,","",$part1[0]);

    die($tmp1);


    $st[$counter]['stockname'] = $tmp1;

    $part2 = str_replace("#,","#",$part1[1]);
    $part2 = explode("@@@",$part2);

    foreach($part2 as $apart2) {
        $tmppart = explode("!!!#",$apart2);
        $st[$counter]["sub"]["{$part1[0]}"] = $tmppart[0];
        $listAlts = explode(",",$tmppart[1]);
        $acounter = 0;
        foreach($listAlts as $listAlt) {
//            $st[$counter]["sub"]["{$part1[0]}"]["{$tmppart[0]}"][$acounter] = $listAlt;
            $acounter++;
        }
    }

    $counter++;

}

echo "<pre>";
var_dump($st);



