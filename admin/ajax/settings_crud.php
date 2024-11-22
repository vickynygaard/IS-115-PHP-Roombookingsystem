<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_general'])) {
    $q = "SELECT * FROM `settings` WHERE `sr_no`=?";
    $values = [1];
    $res = select($q, $values, "i"); 
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
}

if(isset($_POST['upd_general']))
{
    $frm_data= filteration($_POST);

    $q= "UPDATE `settings` SET `site_title`=?, `site_about`=? WHERE `sr_no`=?";
    $values = [$frm_data['site_title'],$frm_data['site_about'],1];
    $res = update($q,$values,'ssi');
    echo $res;

}

if (isset($_POST['upd_shutdown'])) {
    $new_value = ($_POST['upd_shutdown'] == 1) ? 1 : 0; // Ensure proper toggle

    $q = "UPDATE `settings` SET `shutdown`=? WHERE `sr_no`=?";
    $values = [$new_value, 1];
    $res = update($q, $values, 'ii');

    echo $res; // Return the result of the update
}


?>
