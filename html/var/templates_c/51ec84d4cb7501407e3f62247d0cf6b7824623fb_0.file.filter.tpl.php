<?php
/* Smarty version 3.1.33, created on 2022-12-22 14:01:44
  from '/var/www/html/modules/missed_calls/themes/default/filter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4a9986aa018_84398235',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51ec84d4cb7501407e3f62247d0cf6b7824623fb' => 
    array (
      0 => '/var/www/html/modules/missed_calls/themes/default/filter.tpl',
      1 => 1575579176,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4a9986aa018_84398235 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="55%" border="0" cellspacing="0" cellpadding="0">
    <tr class="letra12">
        <td width="7%" align="right"><?php echo $_smarty_tpl->tpl_vars['date_start']->value['LABEL'];?>
: <span  class="required">*</span></td>
        <td width="10%" align="center" nowrap><?php echo $_smarty_tpl->tpl_vars['date_start']->value['INPUT'];?>
</td>
	<td width="30%" align="right">
            <?php echo $_smarty_tpl->tpl_vars['filter_field']->value['LABEL'];?>
:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['filter_field']->value['INPUT'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['filter_value']->value['INPUT'];?>

            <input class="button" type="submit" name="show" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value;?>
" />
        </td>
   </tr>
   <tr class="letra12">     
	<td width="7%" align="right"><?php echo $_smarty_tpl->tpl_vars['date_end']->value['LABEL'];?>
: <span  class="required">*</span></td>
        <td width="10%" align="center" nowrap><?php echo $_smarty_tpl->tpl_vars['date_end']->value['INPUT'];?>
</td>
        
    </tr>
</table>
<?php }
}
