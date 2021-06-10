<style>
body {
    margin: 0;
}
.searchbox {
    font-family: Helvetica,Arial,sans-serif; 
    font-size: 14px; 
    line-height: 1.42857143; 
    color:#333;
    background-color: #f9f9f9;
    padding: 15px;
    margin-top: 15px;
    border-radius: 4px;

}
.searchbox span {
    width: 40px; 
    display: inline-block; 
    text-align: center; 
    margin-bottom: 2px;
}
.searchbox a {
    text-decoration: none; 
    color: #636363;
}
.searchbox a:hover {
    text-decoration: underline; 
    color: #C00;
}
</style>

<?php

$url = 'https://USERNAME:PASSWORD@ALFRESCO_DOMAIN:COM/alfresco/api/-default-/public/search/versions/1/search';

$selectedYear = '';
if ($_POST['selectYear']) {
    $selectedYear = ' AND name:"'.$_POST['selectYear'].'"';
}

$data = array(
    'query' => array(
        'query' => 'ANCESTOR:"workspace://SpacesStore/00000000-0000-0000-0000-000000000000" AND ("'.$_POST['searchText'].'" OR name:"'.$_POST['searchText'].'")'.$selectedYear.' AND not name:"toc" AND not name:"cover"'
    ),
    'paging' => array(
        'maxItems' => '10000'
    )
);

$postdata = json_encode($data);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$response = curl_exec($ch);
curl_close($ch);
$decoded = json_decode($response);

$yearForText = '';
if ($_POST['selectYear']) {
    $yearForText = '</strong>, Godina: <strong>'.$_POST['selectYear'];
}

if ($_POST['searchText']) {
    echo '<div class="searchbox">';
        echo "Prikaz rezultata za pojam: <strong>".$_POST['searchText'].$yearForText."</strong><br><br>";
        $counter = 1;
        if (!$decoded->list->entries) {
            echo '<strong>Nema rezultata!</strong>';
        }
        else {
            foreach ($decoded->list->entries as $singleResult) {
                echo '<span>'.$counter.'.</span> <a href="https://SITEDOMAIN.HR/wp-content/plugins/alfrescowp/alfrescowp-dl.php?id='.$singleResult->entry->id.'&filename='.$singleResult->entry->name.'">'.$singleResult->entry->name.'</a><br>';
                $counter++;
            }
        }
    echo '</div>';
}

?>
