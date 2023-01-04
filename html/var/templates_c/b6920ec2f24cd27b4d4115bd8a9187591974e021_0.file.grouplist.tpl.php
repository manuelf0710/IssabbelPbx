<?php
/* Smarty version 3.1.33, created on 2022-12-30 07:18:03
  from '/var/www/html/modules/grouplist/themes/default/grouplist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63aed6fbaf5f48_20769632',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6920ec2f24cd27b4d4115bd8a9187591974e021' => 
    array (
      0 => '/var/www/html/modules/grouplist/themes/default/grouplist.tpl',
      1 => 1578493345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63aed6fbaf5f48_20769632 (Smarty_Internal_Template $_smarty_tpl) {
?><form method="POST" action="?menu=grouplist">
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
  <td>
    <table width="100%" cellpadding="4" cellspacing="0" border="0">
      <tr>
        <td align="left">
          <?php if ($_smarty_tpl->tpl_vars['mode']->value == 'input') {?>
          <input class="button" type="submit" name="submit_save_group" value="<?php echo $_smarty_tpl->tpl_vars['SAVE']->value;?>
" >
          <input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
"></td>
          <?php } elseif ($_smarty_tpl->tpl_vars['mode']->value == 'edit') {?>
          <input class="button" type="submit" name="submit_apply_changes" value="<?php echo $_smarty_tpl->tpl_vars['APPLY_CHANGES']->value;?>
" >
          <input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
"></td>
          <?php } else { ?>
          <input class="button" type="submit" name="edit" value="<?php echo $_smarty_tpl->tpl_vars['EDIT']->value;?>
">
          <input class="button" type="submit" name="delete" value="<?php echo $_smarty_tpl->tpl_vars['DELETE']->value;?>
"  onClick="return confirmSubmit('<?php echo $_smarty_tpl->tpl_vars['CONFIRM_CONTINUE']->value;?>
')"></td>
          <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['mode']->value != 'view') {?><td align="right" nowrap><span class="letra12"><span  class="required">*</span> <?php echo $_smarty_tpl->tpl_vars['REQUIRED_FIELD']->value;?>
</span></td><?php }?>
     </tr>
   </table>
  </td>
</tr>
<tr>
  <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabForm">
      <tr>
	<td><?php echo $_smarty_tpl->tpl_vars['group']->value['LABEL'];?>
:<?php if ($_smarty_tpl->tpl_vars['mode']->value != 'view') {?> <span  class="required">*</span><?php }?></td>
	<td><?php echo $_smarty_tpl->tpl_vars['group']->value['INPUT'];?>
</td>
        <td width="50%"></td>
      </tr>
      <tr>
	<td><?php echo $_smarty_tpl->tpl_vars['description']->value['LABEL'];?>
:<?php if ($_smarty_tpl->tpl_vars['mode']->value != 'view') {?> <span  class="required">*</span><?php }?></td>
	<td><?php echo $_smarty_tpl->tpl_vars['description']->value['INPUT'];?>
</td>
        <td width="50%"></td>
      </tr>
    </table>
  </td>
</tr>
</table>
<input type="hidden" name="id_group" value="<?php echo $_smarty_tpl->tpl_vars['id_group']->value;?>
">
</form>
<?php }
}
