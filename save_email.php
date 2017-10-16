<?php
global $wpdb;
$table_name = $wpdb->prefix. 'form_invitation';
$charset_collate = $wpdb->get_charset_collate();
error_log("plop");
if (!empty($_POST)) {

    $data = array(
        'email' => $_REQUEST['email']
    );
    $success=$wpdb->insert( $table_name, $data);
    if($success){
        echo 'data has been save' ;
    }
    else {
        return "failed!";
    };
};

?>
