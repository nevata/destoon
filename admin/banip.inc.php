<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('IP��ֹ', '?file='.$file),
    array('��չ���', '?file='.$file.'&action=clear'),
    array('��¼����', '?file='.$file.'&action=ban'),
);
switch($action) {
	case 'add':
		if(!$ip) msg('����дIP��ַ��IP��');
		$ip = trim($ip);
		if(!preg_match("/^[0-9]{1,3}\.[0-9\*]{1,3}\.[0-9\*]{1,3}\.[0-9\*]{1,3}$/", $ip)) msg('IP��ַ��IP�θ�ʽ����');
		$totime = $todate ? strtotime($todate.' 00:00:00') : 0;
		$db->query("INSERT INTO {$DT_PRE}banip (ip,editor,addtime,totime) VALUES ('$ip','$_username','$DT_TIME','$totime')");
		dmsg('���ӳɹ�', '?file='.$file);
	break;
	case 'delete':
		$itemid or msg();
		$db->query("DELETE FROM {$DT_PRE}banip WHERE itemid='$itemid'");
		dmsg('ɾ���ɹ�', '?file='.$file);
	break;
	case 'clear':
		$db->query("DELETE FROM {$DT_PRE}banip WHERE totime>0 and totime<$DT_TIME");
		dmsg('��ճɹ�', '?file='.$file);
	break;
	case 'unban':
		$ip or msg('IP����Ϊ��');
		if(is_array($ip)) {
			foreach($ip as $v) {
				file_del(DT_CACHE.'/ban/'.$v.'.php');
			}
		} else {
			file_del(DT_CACHE.'/ban/'.$ip.'.php');
		}
		dmsg('ɾ���ɹ�', '?file='.$file.'&action=ban');
	break;
	case 'ban':
		$ips = glob(DT_CACHE.'/ban/*.php');
		$lists = array();
		if($ips) {
			foreach($ips as $k=>$v) {
				$lists[$k]['ip'] = basename($v, '.php');
				$lists[$k]['addtime'] = timetodate(filemtime($v), 5);
			}
		}
		include tpl('banip_ban');
	break;
	default:	
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}banip");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}banip ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['status'] = ($r['totime'] && $DT_TIME >  $r['totime']) ? '<span style="color:red;">����</span>' : '<span style="color:blue;">��Ч</span>';
			$r['totime'] = $r['totime'] ? timetodate($r['totime'], 3) : '����';
			$lists[] = $r;
		}
		cache_banip();
		include tpl('banip');
	break;
}
?>