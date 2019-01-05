<?php
session_start();
$_tmp = '';
$_tmp2 = '';
foreach($_POST['filters'] as $filter){
	$_tmp .= "'{$filter}'";
	$_tmp2 .= " -{$filter}";
}
$filter_txt = str_replace("''","','",$_tmp);
$_SESSION['search_filter'] = $filter_txt;
$_SESSION['search_filter2'] = $_tmp2;
