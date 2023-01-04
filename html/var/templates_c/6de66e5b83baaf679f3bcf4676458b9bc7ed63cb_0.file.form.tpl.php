<?php
/* Smarty version 3.1.33, created on 2022-12-15 17:24:20
  from '/var/www/html/modules/configuracion_ivrecs/themes/default/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_639b9e948bf5b5_57802947',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6de66e5b83baaf679f3bcf4676458b9bc7ed63cb' => 
    array (
      0 => '/var/www/html/modules/configuracion_ivrecs/themes/default/form.tpl',
      1 => 1671143057,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639b9e948bf5b5_57802947 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/configuracion_ivrecs/themes/css/configuracion_ivrecs_module.css" rel="stylesheet" />
<fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
    <legend><span> Configuración IVR ECS </span> </legend>
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
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['ip_servidor_oms']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['ip_servidor_oms']->value['INPUT'];?>
</td>
        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['ruta']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['ruta']->value['INPUT'];?>
</td>
        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['identificador_ivr']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['identificador_ivr']->value['INPUT'];?>
</td>
        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['cola_desborde']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['cola_desborde']->value['INPUT'];?>
</td>
        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['usuario']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['usuario']->value['INPUT'];?>
</td>
        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['contrasena']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['contrasena']->value['INPUT'];?>
</td>
        </tr>
        <tr class="letra12">
            <td colspan="2" align="right"><input class="button" type="submit" name="save_new" value="<?php echo $_smarty_tpl->tpl_vars['SAVE']->value;?>
"></td>
        </tr>

    </table>
    <input class="button" type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" />
</fieldset><?php }
}
