<?php
/* Smarty version 3.1.33, created on 2022-12-22 13:59:58
  from '/var/www/html/modules/conference/themes/default/conference.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4a92eee0a27_81054745',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d79e1ca6be712f2bd4e8ba4e9b8ffae3d5283aa' => 
    array (
      0 => '/var/www/html/modules/conference/themes/default/conference.tpl',
      1 => 1575572864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4a92eee0a27_81054745 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['accion']->value == "show_callers") {?>
<table width="99%" border="0" cellspacing="0" cellpadding="4" align="center">
    <tr class="letra12">
        <td width="5%" align="right"><input class="button" type="submit" name="update_show_callers" value="<?php echo $_smarty_tpl->tpl_vars['UPDATE']->value;?>
"></td>
        <td width="5%" align="right"><input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
"></td>
        <td width="10%" align="right"><input class="button" type="submit" name="caller_invite" value="<?php echo $_smarty_tpl->tpl_vars['INVITE_CALLER']->value;?>
"></td>
        <td width="10%" align="left" nowrap><?php echo $_smarty_tpl->tpl_vars['device']->value['INPUT'];?>
</td>
        <td align="left"><input class="button" type="submit" name="callers_kick_all" value="<?php echo $_smarty_tpl->tpl_vars['KICK_ALL']->value;?>
"></td>
    </tr>
</table>
<?php } else { ?>
<table width="99%" border="0" cellspacing="0" cellpadding="4" align="center">
    <tr class="letra12">
        <td width="3%" align="right"><?php echo $_smarty_tpl->tpl_vars['conference']->value['LABEL'];?>
: </td>
        <td width="10%" align="left" nowrap><?php echo $_smarty_tpl->tpl_vars['conference']->value['INPUT'];?>
</td>
        <td width="5%" align="right"><?php echo $_smarty_tpl->tpl_vars['filter']->value['LABEL'];?>
: </td>
        <td width="10%" align="left" nowrap><?php echo $_smarty_tpl->tpl_vars['filter']->value['INPUT'];?>
</td>
        <td align="left"><input class="button" type="submit" name="show" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value;?>
"></td>
    </tr>
</table>
<?php }
}
}
