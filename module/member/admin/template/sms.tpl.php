<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">���Ͷ���</div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="send" value="1"/>
<input type="hidden" name="preview" id="preview" value="0"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">������ <span class="f_red">*</span></td>
<td>
	<input type="radio" name="sendtype" value="1" id="s1" onclick="ck(1);" checked/> <label for="s1">��������</label>
	<input type="radio" name="sendtype" value="2" id="s2" onclick="ck(2);"/> <label for="s2">��������</label>
	<input type="radio" name="sendtype" value="3" id="s3" onclick="ck(3);"/> <label for="s3">�б�Ⱥ��</label>
</td>
</tr>
<tbody id="t1" style="display:;">
<tr>
<td class="tl">���պ��� <span class="f_red">*</span></td>
<td><input type="text" size="35" name="mobile" value="<?php echo $mobile;?>"/></td>
</tr>
</tbody>
<tbody id="t2" style="display:none;">
<tr>
<td class="tl">���պ��� <span class="f_red">*</span></td>
<td class="f_gray"><textarea name="mobiles" rows="4" cols="35"></textarea><br/>[һ��һ�����պ���]</td>
</tr>
</tbody>
<tbody id="t3" style="display:none;">
<tr>
<td class="tl">�����б� <span class="f_red">*</span></td>
<td class="f_red">
<?php
	echo '<select name="mobilelist" id="mobilelist"><option value="0">��ѡ������б�</option>';
	$mails = glob(DT_ROOT.'/file/mobile/*.txt');
	if($mails) {
		foreach($mails as $m) {
			$tmp = basename($m);
			echo '<option value="'.$tmp.'">'.$tmp.'</option>';
		}
	} else {
		echo '<option value="">�޺����б�</option>';
	}
	echo '</select>';
?>
&nbsp;&nbsp;<a href="javascript:" onclick="if($('mobilelist').value != 0){window.open('file/mobile/'+$('mobilelist').value);}else{alert('����ѡ������б�');$('mobilelist').focus();}" class="t">[�鿴ѡ��]</a>&nbsp;&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=make" class="t">[��ȡ�б�]</a>
</td>
</tr>
<tr>
<td class="tl">ÿ�ַ��Ͷ����� <span class="f_red">*</span></td>
<td><input type="text" size="5" name="pernum" id="pernum" value="5"/></td>
</tr>
</tbody>
<tr>
<td class="tl">�������� <span class="f_red">*</span></td>
<td>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td valign="top" width="250"><textarea name="content" id="content" rows="15" cols="35" onkeyup="S();" onblur="S();"></textarea></td>
<td valign="top" class="f_gray"><br/>
- ��ǰ������ <strong id="chars" class="f_red">0</strong> ��(<?php echo $DT['sms_len'];?>��/��)<br/>
- ����֧�ֱ�������Ա���ϱ�����$user����<br/>
- �� {$user[username]} ��ʾ��Ա��<br/>
- �� {$user[company]} ��ʾ��˾��<br/>
- ����Ǹ��ǻ�Ա���Ͷ��ţ��벻Ҫʹ�ñ���<br/>
<?php if(!$DT['sms'] || !$DT['sms_uid'] || !$DT['sms_key']) { ?>
<span class="f_red">- ע�⣺�޷����ͣ�δ���÷��Ͳ���</span> <a href="?file=setting" class="t">�������</a><br/>
<?php } ?>
<span id="dcontent" class="f_red"></span>
</td>
</tr>
</table>
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn" onclick="$('preview').value=0;this.form.target='';"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value=" Ԥ �� " class="btn" onclick="$('preview').value=1;this.form.target='_blank';"/></div>
</form>
<script type="text/javascript">
function S() {
	$('chars').innerHTML = $('content').value.length;
}
var i = 1;
function ck(id) {
	$('t'+i).style.display='none';
	$('t'+id).style.display='';
	i = id;
}
function check() {
	var l;
	var f;
	f = 'content';
	l = $(f).value.length;
	if(l < 2) {
		Dmsg('���ݲ���Ϊ��', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>