<?php
/* Smarty version 3.1.33, created on 2022-12-22 14:04:08
  from '/var/www/html/modules/form_designer/themes/default/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4aa28b1f2a4_77296467',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8544983ca112178d71ddcec46ce54dd3ac56f3fe' => 
    array (
      0 => '/var/www/html/modules/form_designer/themes/default/form.tpl',
      1 => 1575212159,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4aa28b1f2a4_77296467 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- end of Message board -->
<form method="POST" name="form_formulario">
    <table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td>
                <table width="100%" cellpadding="3" cellspacing="0" border="0">
                    <tr>
                        <td align="left">
                        <input class="button" type="button" name="apply_changes" value="<?php echo $_smarty_tpl->tpl_vars['SAVE']->value;?>
" />
                        <input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabForm">
                    <tr>
                        <td align="right" valign="top"><?php echo $_smarty_tpl->tpl_vars['form_nombre']->value['LABEL'];?>
: <span  class="required" <?php echo $_smarty_tpl->tpl_vars['style_field']->value;?>
>*</span></td>
                        <td valign="top"><?php echo $_smarty_tpl->tpl_vars['form_nombre']->value['INPUT'];?>
</td>
                    </tr>
                    <tr>
	                    <td align="right" valign="top"><?php echo $_smarty_tpl->tpl_vars['form_description']->value['LABEL'];?>
:</td>
	                    <td valign="top"><?php echo $_smarty_tpl->tpl_vars['form_description']->value['INPUT'];?>
</td>
                    </tr>
                    <tr><td colspan="2">
<table class="formfield_list" border='0' cellspacing='0' cellpadding='0' width='100%' align='center'>
<thead>
<tr>
    <td width="50"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LABEL_ORDER']->value, ENT_QUOTES, 'UTF-8', true);?>
</td>
    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LABEL_NAME']->value, ENT_QUOTES, 'UTF-8', true);?>
</td>
    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LABEL_TYPE']->value, ENT_QUOTES, 'UTF-8', true);?>
</td>
    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LABEL_ENUMVAL']->value, ENT_QUOTES, 'UTF-8', true);?>
</td>
    <td width="40">&nbsp;</td>
</tr>
</thead>
<tbody id="tbody_fieldlist">
<tr title="<?php echo $_smarty_tpl->tpl_vars['TOOLTIP_DRAGDROP']->value;?>
">
    <td valign="top"><span class="formfield_order">?</span><input type="hidden" name="formfield_id" value="" /></td>
    <td valign="top" class='formfield_name'><input type="text" name="formfield_name" value="(no name)" placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LABEL_NEWFIELD']->value, ENT_QUOTES, 'UTF-8', true);?>
" /></td>
    <td valign="top" class='formfield_type'><select><?php echo $_smarty_tpl->tpl_vars['CMB_TIPO']->value;?>
</select></td>
    <td valign="top" class='formfield_enumval'>
        <span class="formfield_enumval_wrap">
            <span class="formfield_enumval_passive"></span>
            <div class="formfield_enumval_active">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td rowspan='2' valign="top" width="50"><input type="text" name="formfield_enumlist_newitem" id='formfield_enumlist_newitem' value="" /></td>
                        <td valign="top" width="40"><input class="button" type="button" name="formfield_additem" value=">>"/></td>
                        <td rowspan='2' valign="top">
                            <select name="formfield_enumlist_items" size="4" class="formfield_enumlist_items" style="width:120px"></select>
                        </td>
                    </tr>
                    <tr>
                        <td width="40"><input class="button" type="button" name="formfield_delitem" value="<<" /></td>
                    </tr>
                </table>
            </div>
        </span>
    </td>
    <td class='formfield_order'><input class="button" type="button" name="formfield_add" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LABEL_FFADD']->value, ENT_QUOTES, 'UTF-8', true);?>
" /><input class="button" type="button" name="formfield_del" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LABEL_FFDEL']->value, ENT_QUOTES, 'UTF-8', true);?>
" /></td>
</tr>
</tbody>
</table>            
                    </td></tr>
                </table>
            </td>
        </tr>
    </table>
    <?php echo $_smarty_tpl->tpl_vars['id_formulario']->value['INPUT'];?>

</form>
<?php echo '<script'; ?>
 type="text/javascript">
CAMPOS_FORM = <?php echo $_smarty_tpl->tpl_vars['CAMPOS_FORM']->value;?>
;
<?php echo '</script'; ?>
><?php }
}
