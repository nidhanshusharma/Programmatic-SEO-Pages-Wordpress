<?php /*Template Name: template-name */
get_header();
    $district_name = ucfirst(strtolower(get_query_var("varname")));

    $ch = curl_init('api-link-which-will-fetch-data-from-database.php?district'.$district_name);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $data = json_decode($data,true);
    if(array_key_exists("error",$data)){
        header('HTTP/1.1 404 Not Found'); //This may be put inside err.php instead
        $_GET['e'] = 404; //Set the variable for the error code (you cannot have a
                        // querystring in an include directive).
        include '404.php';
        exit; //Do not do any more work in this script.
    }
    $petrol_price = $data["petrol"];

    echo "<p></p><h1>Petrol Price in ".$district_name." is ".$petrol_price." per Litre</h1>";
    $description = "Petrol Price in ".$district_name." today [".date("d/m/Y")."] is ".$petrol_price." per litre. Checkout Historical rates in ".$district_name." and much more";
    $title = "Check Petrol Price in ".$district_name." | Updated Today [".date("d/m/Y")."]";
    echo "
    <script>
        document.querySelector('meta[name=\"description\"]').setAttribute('content', '".$description."');
        document.title = '".$title."';
    </script>
    ";
    get_footer();
?>
