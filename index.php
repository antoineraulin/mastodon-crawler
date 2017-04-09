<?php
ini_set('max_execution_time', 600);
$dochtml = new DOMDocument();
$dochtml->loadHTMLFile("https://instances.mastodon.xyz/");
$time = true;
$time2 = 0;
$instancelist = [];
$countryslist = [];

while($time == true){
        
        try{
            $tr = $dochtml->getElementsByTagName('tr')[$time2]->nodeValue;
            if(strpos($tr, 'Uptime') != false){
                
            }else if($tr == null){
                break;
                $time = false;
            }else{
                $content = explode("\n", $tr);
                $content[1] = preg_replace('/\s/', '', $content[1]);
                if($content[0] == "UP"){
                    array_push($instancelist, $content[1]);
                }
            }
        }catch (Exception $e) {
            break;
            $time = false;
        }
        $time2++;
    }
echo $time2.'<br>';

$time3 = 0;
foreach ($instancelist as $link) {
    $time3++;
    $hostname = $link;
    $hostname = str_replace('https://', '', $hostname);
    $hostname = str_replace('http://', '', $hostname);
    $hostname = str_replace('/', '', $hostname);
    $ip = gethostbyname($hostname);
    $details = json_decode(file_get_contents("http://ipinfo.io/".$ip."/json"));
    $country = $details->country;
    echo '#'.$time3.' instance :"'.$hostname.'" & ip:"'.$ip.'" & country:"'.$country.'"<br>';
    array_push($countryslist, $country);}

$countryslist2 = [];

foreach ($countryslist as $item) {
        $int = (int) preg_replace('/\D/', '', $countryslist2[$item]);
        $countryslist2[$item] = $int + 1;
}    
print_r($countryslist2);

?>
