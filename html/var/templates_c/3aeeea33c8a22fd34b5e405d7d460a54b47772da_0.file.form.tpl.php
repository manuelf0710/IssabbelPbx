<?php
/* Smarty version 3.1.33, created on 2022-12-14 11:33:33
  from '/var/www/html/modules/auditorias/themes/default/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6399fadd5923e2_13548056',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3aeeea33c8a22fd34b5e405d7d460a54b47772da' => 
    array (
      0 => '/var/www/html/modules/auditorias/themes/default/form.tpl',
      1 => 1671035609,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6399fadd5923e2_13548056 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/auditorias/themes/css/auditorias_module.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type='text/javascript' src="modules/auditorias/themes/js/auditorias_module.js"><?php echo '</script'; ?>
>
<fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
    <legend><span> Auditorias </span> </legend>
    <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
        <tr class="letra12">
            <?php if ($_smarty_tpl->tpl_vars['mode']->value == 'input') {?>
                <td align="left">
                    <!--<input class="button" type="submit" name="save_new" value="<?php echo $_smarty_tpl->tpl_vars['SAVE']->value;?>
">&nbsp;&nbsp;
                    <input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
">-->
                </td>
            <?php } elseif ($_smarty_tpl->tpl_vars['mode']->value == 'view') {?>
                <td align="left">
                    <input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
">
                </td>
            <?php } elseif ($_smarty_tpl->tpl_vars['mode']->value == 'edit') {?>
                <td align="left">
                    <input class="button" type="submit" name="save_edit" value="<?php echo $_smarty_tpl->tpl_vars['EDIT']->value;?>
">&nbsp;&nbsp;
                    <input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
">
                </td>
            <?php }?>
            <td align="right" nowrap><span class="letra12"><span class="required">*</span> <?php echo $_smarty_tpl->tpl_vars['REQUIRED_FIELD']->value;?>
</span></td>
        </tr>
    </table>
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['fecha_inicial']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left">
                <input type="text" name="fecha_inicial" id="fecha_inicial" value="" class="calendar-reports">
            </td>
        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['fecha_final']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left">
                <input type="text" name="fecha_final" id="fecha_final" value="" class="calendar-reports">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input class="button" type="submit" name="save_new" value="Aceptar">
            </td>
        </tr>
    </table>
    <input class="button" type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" />
</fieldset><?php }
}
