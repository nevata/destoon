<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
define('DT_NONUSER', true);
require '../common.inc.php';
check_referer() or exit;
$session = new dsession();
require DT_ROOT.'/include/captcha.class.php';
$do = new captcha;
$do->font = DT_ROOT.'/file/font/'.$DT['water_font'];
if($DT['captcha_cn']) $do->cn = is_file($do->font);
$do->charset = strtolower(DT_CHARSET);
$do->ip = $DT_IP;
if($action == 'question') {
	$id = isset($id) ? trim($id) : 'questionstr';
	$do->question($id);
} else {
	if($DT['captcha_chars']) $do->chars = trim($DT['captcha_chars']);
	$do->image();
}
?>