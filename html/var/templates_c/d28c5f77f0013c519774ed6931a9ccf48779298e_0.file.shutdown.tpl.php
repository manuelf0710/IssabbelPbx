<?php
/* Smarty version 3.1.33, created on 2022-12-22 13:24:40
  from '/var/www/html/modules/shutdown/themes/default/shutdown.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4a0e874b791_43983952',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd28c5f77f0013c519774ed6931a9ccf48779298e' => 
    array (
      0 => '/var/www/html/modules/shutdown/themes/default/shutdown.tpl',
      1 => 1575122672,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4a0e874b791_43983952 (Smarty_Internal_Template $_smarty_tpl) {
?><form method="POST">
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
  <td>
    <table width="100%" cellpadding="4" cellspacing="0" border="0">
      <tr>
        <td align="left">
          <input class="button" type="submit" name="submit_accept" value="<?php echo $_smarty_tpl->tpl_vars['ACCEPT']->value;?>
" onClick="return confirmSubmit('<?php echo $_smarty_tpl->tpl_vars['CONFIRM_CONTINUE']->value;?>
')">
     </tr>
   </table>
  </td>
</tr>
<tr>
  <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabForm">
      <tr>
	<td width="15%"><input type="radio" name="shutdown_mode" value="1">&nbsp;<?php echo $_smarty_tpl->tpl_vars['HALT']->value;?>
 </td>
	<td width="35%">&nbsp;</td>
	<td width="20%">&nbsp;</td>
	<td width="30%">&nbsp;</td>
      </tr>
      <tr>
	<td width="15%"><input type="radio" name="shutdown_mode" value="2" checked>&nbsp;<?php echo $_smarty_tpl->tpl_vars['REBOOT']->value;?>
</td>
	<td width="35%">&nbsp;</td>
	<td width="20%">&nbsp;</td>
	<td width="30%">&nbsp;</td>
      </tr>
    </table>
  </td>
</tr>
</table>
</form>
<?php }
}
