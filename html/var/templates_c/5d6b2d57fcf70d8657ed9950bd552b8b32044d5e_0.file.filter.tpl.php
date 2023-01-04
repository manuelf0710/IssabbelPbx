<?php
/* Smarty version 3.1.33, created on 2022-12-13 13:51:15
  from '/var/www/html/modules/voicemail/themes/default/filter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6398c9a3361861_80557224',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d6b2d57fcf70d8657ed9950bd552b8b32044d5e' => 
    array (
      0 => '/var/www/html/modules/voicemail/themes/default/filter.tpl',
      1 => 1575572864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6398c9a3361861_80557224 (Smarty_Internal_Template $_smarty_tpl) {
?>    <table width="99%" cellpadding="4" cellspacing="0" border="0" align="center">
      <tr class="letra12">
        <td width="7%" align="right"><?php echo $_smarty_tpl->tpl_vars['date_start']->value['LABEL'];?>
:</td>
        <td width="10%" align="left" nowrap><?php echo $_smarty_tpl->tpl_vars['date_start']->value['INPUT'];?>
</td>
        <td width="7%" align="right"><?php echo $_smarty_tpl->tpl_vars['date_end']->value['LABEL'];?>
:</td>
        <td width="10%" align="left" nowrap><?php echo $_smarty_tpl->tpl_vars['date_end']->value['INPUT'];?>
</td>
        <td align="left"><input class="button" type="submit" name="filter" value="<?php echo $_smarty_tpl->tpl_vars['Filter']->value;?>
" ></td>
      </tr>
   </table>
<a href="javascript:seleccionar_checkbox(1)">Marcar todos</a> | <a href="javascript:seleccionar_checkbox(0)">Desmarcar Todos</a>
<?php }
}
