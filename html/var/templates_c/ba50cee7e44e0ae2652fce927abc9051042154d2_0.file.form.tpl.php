<?php
/* Smarty version 3.1.33, created on 2023-01-06 13:58:10
  from '/var/www/html/modules/configuracion_general_module/themes/default/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63b86f42c7ec50_82176138',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ba50cee7e44e0ae2652fce927abc9051042154d2' => 
    array (
      0 => '/var/www/html/modules/configuracion_general_module/themes/default/form.tpl',
      1 => 1673031487,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63b86f42c7ec50_82176138 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/configuracion_general_module/themes/css/configuraciongeneral_module.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type='text/javascript' src="modules/configuracion_general_module/themes/js/configuraciongeneral_module.js">
<?php echo '</script'; ?>
>
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
    </tr>
</table>

<fieldset style="border-radius: 5px; padding: 5px; min-height:150px;  margin-top:20px;">
    <legend><span> Configuración de conexión Local o MariaDB </span> </legend>
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
            <td colspan="6" align="right" nowrap>
                <span class="letra12"><span class="required">*</span><?php echo $_smarty_tpl->tpl_vars['REQUIRED_FIELD']->value;?>
</span>
            </td>

        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['motormariadb']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left">
                <?php echo $_smarty_tpl->tpl_vars['motormariadb']->value['INPUT'];?>

            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['servidormariadb']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['servidormariadb']->value['INPUT'];?>
</td>
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['usuariomariadb']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['usuariomariadb']->value['INPUT'];?>
</td>
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['contrasenamariadb']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['contrasenamariadb']->value['INPUT'];?>
<i class="fa fa-eye toogle-type-password"></i></td>
        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['basedatosmariadb']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['basedatosmariadb']->value['INPUT'];?>
</td>
        </tr>
    </table>
    <table style="width:98%; margin-top:20px;">
        <tr>
            <td align="right">
                <input class="button" type="button" name="probarconexionmariadb" value="Probar Conexión"
                    id="btnprobarconexionmariadb">
                <input class="button" type="button" name="btnguardardatosmariadb" id="btnguardardatosmariadb"
                    value="Guardar">

                <div class="row" style="margin-top:5px; padding:10px">
                    <div class="alert alert-danger mt-1" id="conexionnoexitosamariadb" style="display:none">Conexión no
                        exitosa
                    </div>
                    <div class="alert alert-success mt-1" id="conexionexitosamariadb" style="display:none">Conexión
                        exitosa
                    </div>
                </div>
            </td>
        </tr>
    </table>
</fieldset>
<fieldset style="border-radius: 5px; padding: 5px; min-height:150px;  margin-top:20px;">
    <legend><span> Cadena de conexión a base de datos OMS </span> </legend>
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
            <td colspan="6" align="right" nowrap>
                <span class="letra12"><span class="required">*</span><?php echo $_smarty_tpl->tpl_vars['REQUIRED_FIELD']->value;?>
</span>
            </td>

        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['motor']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left">
                <?php echo $_smarty_tpl->tpl_vars['motor']->value['INPUT'];?>

                <!--<select name="motor" id="motor">
                    <option value="">Seleccione...</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['configListas']->value['conexionesLista'], 'cn');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cn']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['cn']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['cn']->value['motor'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>-->
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['servidor']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['servidor']->value['INPUT'];?>
</td>
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['usuario']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['usuario']->value['INPUT'];?>
</td>
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['contrasena']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['contrasena']->value['INPUT'];?>
<i class="fa fa-eye toogle-type-password"></i></td>
        </tr>
        <tr class="letra12">
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['basedatos']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['basedatos']->value['INPUT'];?>
</td>
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['tablavista']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['tablavista']->value['INPUT'];?>
</td>
            <td align="left"><B>Estado</B></td>
            <td align="left">
                <?php echo $_smarty_tpl->tpl_vars['activo']->value['INPUT'];?>

            </td>

        </tr>
    </table>
    <table style="width:98%; margin-top:20px;">
        <tr>
            <td align="right">
                <input class="button" type="button" name="probarconexion" value="Probar Conexión"
                    id="btnprobarconexion">

                <input class="button" type="button" name="btnguardardatos" id="btnguardardatos" value="Guardar">
                <div class="row" style="margin-top:5px; padding:10px">
                    <div class="alert alert-danger mt-1" id="conexionnoexitosa" style="display:none">Conexión no exitosa
                    </div>
                    <div class="alert alert-success mt-1" id="conexionexitosa" style="display:none">Conexión exitosa
                    </div>
                </div>
            </td>
        </tr>
    </table>
</fieldset>
<input class="button" type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" /><?php }
}
