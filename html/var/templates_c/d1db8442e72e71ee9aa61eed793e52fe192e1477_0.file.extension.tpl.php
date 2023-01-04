<?php
/* Smarty version 3.1.33, created on 2022-12-12 11:31:44
  from '/var/www/html/modules/extensions_batch/themes/default/extension.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6397577030eef5_61826969',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd1db8442e72e71ee9aa61eed793e52fe192e1477' => 
    array (
      0 => '/var/www/html/modules/extensions_batch/themes/default/extension.tpl',
      1 => 1575572864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6397577030eef5_61826969 (Smarty_Internal_Template $_smarty_tpl) {
?><form  method='POST' enctype='multipart/form-data' style='margin-bottom:0;' action='?menu=<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
'>

<!--  align="center" width="99%" -->
<table border="0" cellspacing="0" cellpadding="4" >
    <tr class="letra12">
    <td><input class="button" type="submit" name="csvupload" value="<?php echo $_smarty_tpl->tpl_vars['LABEL_UPLOAD']->value;?>
" /></td>
    <td><input class='button' type='submit' name='delete_all' value='<?php echo $_smarty_tpl->tpl_vars['LABEL_DELETE']->value;?>
' onClick="return confirmSubmit('<?php echo $_smarty_tpl->tpl_vars['CONFIRM_DELETE']->value;?>
');" /></td>
    </tr>
</table>
<table class="tabForm" width="100%">
<tbody>
<tr>
    <td align="right" width="15%"><b><?php echo $_smarty_tpl->tpl_vars['LABEL_FILE']->value;?>
:</b></td>
    <td><input type='file' id='csvfile' name='csvfile' /></td>
</tr>
<tr>
    <td colspan="2"><a class="link1" href="?menu=<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
&amp;action=csvdownload&amp;rawmode=yes"><?php echo $_smarty_tpl->tpl_vars['LABEL_DOWNLOAD']->value;?>
</a></td>
</tr>
<tr><td colspan="3"><?php echo $_smarty_tpl->tpl_vars['HeaderFile']->value;?>
</td></tr>
<tr><td colspan="3"><?php echo $_smarty_tpl->tpl_vars['AboutUpdate']->value;?>
</td></tr>
</tbody>
</table>
</form><?php }
}
