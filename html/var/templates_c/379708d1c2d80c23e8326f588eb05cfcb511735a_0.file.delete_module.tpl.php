<?php
/* Smarty version 3.1.33, created on 2022-12-12 12:40:15
  from '/var/www/html/modules/delete_module/themes/default/delete_module.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6397677f6d3f47_91362533',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '379708d1c2d80c23e8326f588eb05cfcb511735a' => 
    array (
      0 => '/var/www/html/modules/delete_module/themes/default/delete_module.tpl',
      1 => 1577815322,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6397677f6d3f47_91362533 (Smarty_Internal_Template $_smarty_tpl) {
?><div id='error' name='error'></div>
<div>
<table width="99%" border="0" cellspacing="0" cellpadding="4" align="center">
    <tr>
        <td align="left">
            <input class="button" type="submit" name="delete" value="<?php echo $_smarty_tpl->tpl_vars['DELETE']->value;?>
" onclick="return confirmSubmit('<?php echo $_smarty_tpl->tpl_vars['CONFIRM_CONTINUE']->value;?>
')">
        </td>
        <td align="right" nowrap><span class="letra12"><span  class="required">*</span> <?php echo $_smarty_tpl->tpl_vars['REQUIRED_FIELD']->value;?>
</span></td>
    </tr>
</table>
<table class="tabForm" style="font-size: 16px;" width="100%" >
    <tr class="letra12">
        <td align="left" width="12%"><b><?php echo $_smarty_tpl->tpl_vars['Delete_Menu']->value;?>
:</b></td>
        <td width="30%"><input type="checkbox" name="delete_menu" id="delete_menu" checked='checked' /></td>
        <td></td>
    </tr>
    <tr class="letra12">
        <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['Delete_Files']->value;?>
:</b></td>
        <td width="30%"><input type="checkbox" name="delete_files" id="delete_files" /></td>
    </tr>
    <tr class="letra12" id="level_1">
        <?php echo $_smarty_tpl->tpl_vars['level_1']->value;?>

    </tr>
    <tr class="letra12" id="level_2">
    </tr>
    <tr class="letra12" id="level_3">
    </tr>
</table>
</div>
<?php }
}
