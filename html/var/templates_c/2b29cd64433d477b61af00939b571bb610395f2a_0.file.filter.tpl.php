<?php
/* Smarty version 3.1.33, created on 2022-12-22 18:47:12
  from '/var/www/html/modules/sec_ports/themes/default/filter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4ec80dcf6b9_54427134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b29cd64433d477b61af00939b571bb610395f2a' => 
    array (
      0 => '/var/www/html/modules/sec_ports/themes/default/filter.tpl',
      1 => 1576169518,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4ec80dcf6b9_54427134 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr class="letra12">
        <td align="left">
            <?php echo $_smarty_tpl->tpl_vars['filter_type']->value['LABEL'];?>
:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['filter_type']->value['INPUT'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['filter_txt']->value['INPUT'];?>

            <input class="button" type="submit" name="show" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value;?>
" />
        </td>
    </tr>
</table>
<?php }
}
