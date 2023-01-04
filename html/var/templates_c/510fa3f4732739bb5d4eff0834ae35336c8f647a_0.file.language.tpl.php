<?php
/* Smarty version 3.1.33, created on 2022-12-14 14:13:48
  from '/var/www/html/modules/language/themes/default/language.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_639a206c177a20_85844518',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '510fa3f4732739bb5d4eff0834ae35336c8f647a' => 
    array (
      0 => '/var/www/html/modules/language/themes/default/language.tpl',
      1 => 1578493345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639a206c177a20_85844518 (Smarty_Internal_Template $_smarty_tpl) {
?><form method="POST">
<table width="99%" border="0" cellspacing="0" cellpadding="4" align="center">
    <tr class="letra12">
    <td>
        <input class="button" type="submit" name="save_language" value="<?php echo $_smarty_tpl->tpl_vars['CAMBIAR']->value;?>
" >
	</td>
    </tr>
</table>
<table class="tabForm" width="100%" >
    <tr class="letra12">
        <td width="9%"><b><?php echo $_smarty_tpl->tpl_vars['language']->value['LABEL'];?>
:</b></td>
        <td width="35%"><?php echo $_smarty_tpl->tpl_vars['language']->value['INPUT'];?>
</td>
    </tr>
</table>
</form><?php }
}
