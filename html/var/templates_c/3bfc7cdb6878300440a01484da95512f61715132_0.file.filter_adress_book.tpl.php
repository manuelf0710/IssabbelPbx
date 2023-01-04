<?php
/* Smarty version 3.1.33, created on 2022-12-22 13:58:09
  from '/var/www/html/modules/address_book/themes/default/filter_adress_book.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4a8c1701422_38740514',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3bfc7cdb6878300440a01484da95512f61715132' => 
    array (
      0 => '/var/www/html/modules/address_book/themes/default/filter_adress_book.tpl',
      1 => 1576847322,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4a8c1701422_38740514 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="99%" border="0" cellspacing="0" cellpadding="4" align="center">
    <tr class="letra12">
            <td width="13%" align="right"><?php echo $_smarty_tpl->tpl_vars['Phone_Directory']->value;?>
:</td>
            <td width="15%" align="left">
                <select name="select_directory_type" onchange='submit();'>
                    <option value="internal" <?php echo $_smarty_tpl->tpl_vars['internal_sel']->value;?>
><?php echo $_smarty_tpl->tpl_vars['Internal']->value;?>
</option>
                    <option value="external" <?php echo $_smarty_tpl->tpl_vars['external_sel']->value;?>
><?php echo $_smarty_tpl->tpl_vars['External']->value;?>
</option>
                </select>
            </td>
            <td width="43%" align="right"><?php echo $_smarty_tpl->tpl_vars['field']->value['LABEL'];?>
: </td>
            <td width="32%" align="left" nowrap>
                <?php echo $_smarty_tpl->tpl_vars['field']->value['INPUT'];?>
 &nbsp;<?php echo $_smarty_tpl->tpl_vars['pattern']->value['INPUT'];?>
&nbsp;&nbsp;
                <input class="button" type="submit" name="report" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value;?>
">
            </td>
    </tr>
</table>


<?php }
}
