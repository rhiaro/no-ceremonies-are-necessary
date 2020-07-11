<?
session_start();
require 'vendor/autoload.php';
$ns = rhiaro\EHR\ns();

$tz = rhiaro\EHR\get_timezone_from_rdf("https://rhiaro.co.uk/tz");
date_default_timezone_set($tz);

$tags = array(
    "travel" => "https://rhiaro.co.uk/tags/travel",
    "life" => "https://rhiaro.co.uk/tags/life",
    "hacking" => "https://rhiaro.co.uk/tags/hacking",
    "food" => "https://rhiaro.co.uk/tags/food",
    "vegan" => "https://rhiaro.co.uk/tags/vegan",
    "week in review" => "https://rhiaro.co.uk/tags/week+in+review",
    "cooplife" => "https://rhiaro.co.uk/tags/cooplife",
    "ods" => "https://rhiaro.co.uk/tags/ods",
    "crochet" => "https://rhiaro.co.uk/tags/",
);

if(isset($_POST['record'])){
    if(isset($_POST['endpoint_key'])){
        $_SESSION['key'] = $_POST['endpoint_key'];
    }
    $endpoint = $_POST['endpoint_uri'];
    $result = Rhiaro\form_to_endpoint($_POST);

    if(is_array($result)){
        $errors = $result;
        unset($result);
    }else{
        unset($_POST);
    }
}
include('templates/index.php');
?>