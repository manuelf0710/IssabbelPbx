<?php
/* Smarty version 3.1.33, created on 2022-12-13 13:51:31
  from '/var/www/html/modules/userlist/themes/default/new.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6398c9b3c70e34_39395969',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f38acada1bc9df9b52fe9feee7e2a3016c047938' => 
    array (
      0 => '/var/www/html/modules/userlist/themes/default/new.tpl',
      1 => 1578493345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6398c9b3c70e34_39395969 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['userExtension_success']->value == 1) {?>

<?php echo '<script'; ?>
 type="text/javascript">
if (window.opener && !window.opener.closed) {
    window.opener.location.reload();
}
window.close();
<?php echo '</script'; ?>
>

<?php } else { ?>
<form method="POST">
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
  <td>
    <table width="100%" cellpadding="4" cellspacing="0" border="0">
      <tr>
        <td align="left">
          <button class="button" type="submit" name="save" value="<?php echo $_smarty_tpl->tpl_vars['SAVE']->value;?>
"><i class='fa fa-save'></i> <?php echo $_smarty_tpl->tpl_vars['SAVE']->value;?>
</button>
          <?php if ($_smarty_tpl->tpl_vars['editUserExtension']->value != 'yes') {?><input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
"><?php }?>
        </td>
        <?php if ($_smarty_tpl->tpl_vars['mode']->value != 'view') {?>
          <td align="right" nowrap><span class="letra12"><span  class="required">*</span> <?php echo $_smarty_tpl->tpl_vars['REQUIRED_FIELD']->value;?>
</span></td>
        <?php }?>
     </tr>
   </table>
  </td>
</tr>
<tr>
  <td>
    <fieldset>
        <legend><b><?php echo $_smarty_tpl->tpl_vars['LBL_CORE_FIELDS']->value;?>
</b></legend>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabForm">
          <tr>
            <td width="20%"><?php echo $_smarty_tpl->tpl_vars['name']->value['LABEL'];?>
: <?php if ($_smarty_tpl->tpl_vars['mode']->value != 'view') {?><span  class="required">*</span><?php }?></td>
            <td width="30%"><?php echo $_smarty_tpl->tpl_vars['name']->value['INPUT'];?>
</td>
            <td width="25%"><?php echo $_smarty_tpl->tpl_vars['description']->value['LABEL'];?>
:</td>
            <td width="25%"><?php echo $_smarty_tpl->tpl_vars['description']->value['INPUT'];?>
</td>
          </tr>
          <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['password1']->value['LABEL'];?>
: <?php if ($_smarty_tpl->tpl_vars['mode']->value != 'view') {?><span  class="required">*</span><?php }?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['password1']->value['INPUT'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['password2']->value['LABEL'];?>
: <?php if ($_smarty_tpl->tpl_vars['mode']->value != 'view') {?><span class="required">*</span><?php }?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['password2']->value['INPUT'];?>
</td>
          </tr>
          <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['group']->value['LABEL'];?>
: <?php if ($_smarty_tpl->tpl_vars['mode']->value != 'view') {?><span  class="required">*</span><?php }?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['group']->value['INPUT'];?>
</td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table>
    </fieldset>
    <?php echo $_smarty_tpl->tpl_vars['PLUGIN_CONTENT']->value;?>

  </td>
</tr>
</table>
<input type="hidden" name="id_user" value="<?php echo $_smarty_tpl->tpl_vars['id_user']->value;?>
">
</form>
<?php }
}
}
