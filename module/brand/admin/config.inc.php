<?php
defined('IN_DESTOON') or exit('Access Denied');
$MCFG['module'] = 'brand';
$MCFG['name'] = 'Ʒ��';
$MCFG['author'] = 'Destoon.COM';
$MCFG['homepage'] = 'www.destoon.com';
$MCFG['copy'] = false;
$MCFG['uninstall'] = true;
$MCFG['moduleid'] = 13;

$RT = array();
$RT['file']['index'] = 'Ʒ�ƹ���';
$RT['file']['html'] = '������ҳ';

$RT['action']['index']['add'] = '����Ʒ��';
$RT['action']['index']['edit'] = '�޸�Ʒ��';
$RT['action']['index']['delete'] = 'ɾ��Ʒ��';
$RT['action']['index']['check'] = '���Ʒ��';
$RT['action']['index']['expire'] = '����Ʒ��';
$RT['action']['index']['reject'] = 'δͨ��Ʒ��';
$RT['action']['index']['recycle'] = '����վ';
$RT['action']['index']['move'] = '�ƶ�Ʒ��';
$RT['action']['index']['level'] = 'Ʒ�Ƽ���';

$CT = true;
?>