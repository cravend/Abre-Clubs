<?php
  //Include required files
  require_once(dirname(__FILE__) . '/../../configuration.php');
  require_once(dirname(__FILE__) . '/../../core/abre_verification.php');

  //Editors function
  function checkEditors($id){
    if(admin()) return true;
  	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
    $email = strtolower($_SESSION['useremail']);
    $sql = "SELECT editors FROM club_info WHERE id = '$id'";
    $result = $db->query($sql);
		$row = $result->fetch_assoc();
    $editors = $row["editors"];
    $editors = strtolower($editors);
    return (strpos($editors, $email) !== false ? true : false);
  }


?>
