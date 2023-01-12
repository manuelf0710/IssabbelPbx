<?php
/* Smarty version 3.1.33, created on 2023-01-07 19:28:45
  from '/var/www/html/modules/auditorias/themes/default/filter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63ba0e3d287195_71345841',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a584b5a3e7996df825dabe6b4b5041f77e8b37e1' => 
    array (
      0 => '/var/www/html/modules/auditorias/themes/default/filter.tpl',
      1 => 1673135215,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63ba0e3d287195_71345841 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr class="letra12">
        <td width="10%" align="left">&nbsp;&nbsp;</td>
        <td width="10%" align="right">
            <?php echo $_smarty_tpl->tpl_vars['filter_field']->value['LABEL'];?>
:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['filter_field']->value['INPUT'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['filter_value']->value['INPUT'];?>

            <input class="button" type="submit" name="show" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value;?>
" />
        </td>
    </tr>
</table><?php }
}
