<?php
/* Smarty version 3.1.33, created on 2022-12-29 14:58:59
  from '/var/www/html/modules/configuracion_general/themes/default/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63adf183e38342_89244275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3535c59ddcfd60613c6baf4a27a9a998aac51600' => 
    array (
      0 => '/var/www/html/modules/configuracion_general/themes/default/form.tpl',
      1 => 1672343937,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63adf183e38342_89244275 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/configuracion_general/themes/css/configuraciongeneral_module.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type='text/javascript' src="modules/configuracion_general/themes/js/configuraciongeneral_module.js"><?php echo '</script'; ?>
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
            <td align="left"><B><?php echo $_smarty_tpl->tpl_vars['activo']->value['LABEL'];?>
</B></td>
            <td align="left">
                <?php echo $_smarty_tpl->tpl_vars['activo']->value['INPUT'];?>

            </td>

        </tr>
        <tr class="letra12">
            <td colspan="6" align="right">
                <input class="button" type="button" name="probarconexion" value="Probar Conexión"
                    id="btnprobarconexion">
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

<fieldset style="border-radius: 5px; padding: 5px; min-height:150px;  margin-top:20px;">
    <legend><span> Gestión de notificaciones </span> </legend>
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
            <td colspan="3" align="right">
                <b><?php echo $_smarty_tpl->tpl_vars['cant_lineas']->value['LABEL'];?>
</b>
            </td>
            <td align="right">
                <?php echo $_smarty_tpl->tpl_vars['cant_lineas']->value['INPUT'];?>

            </td>
        </tr>
        <tr class="letra12">
            <td colspan="2" align="left" width="70%">
                <!--<?php echo $_smarty_tpl->tpl_vars['activar_desactivar']->value['INPUT'];?>
-->
                <div class="material-switch font-weight-bold">
                    Desactivar&nbsp;&nbsp;
                    <input id="activar_desactivar" name="activar_desactivar" type="checkbox" />
                    <label for="activar_desactivar" class="label-success"></label>&nbsp;&nbsp;Activar
                </div>
            </td>
            <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['barridos']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['barridos']->value['INPUT'];?>
</td>
        </tr>
        <tr class="letra12">
            <td width="50%">
                <table class="tabForm notificacionesTable" style="font-size: 16px;" width="100%">
                    <tr class="letra12">
                        <td>Activar</td>
                        <td>Tipo Evento</td>
                        <td>Destino</td>
                    </tr>
                    <tr class="">
                        <td>
                            <input type="checkbox" id="chkivr_confirmado" name="chkivr_confirmado" class="chkivr" />
                        </td>
                        <td class="letra12">Confirmado</td>
                        <td>
                            <select name="ivrconfirmado" id="ivrconfirmado" style="display:none;">
                                <option value="">Seleccione...</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['configListas']->value['ivrLista'], 'ivr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ivr']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['ivr']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['ivr']->value['name'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <td>
                            <input type="checkbox" id="chkivr_restaurado" name="chkivr_restaurado" class="chkivr" />
                        </td>
                        <td class="letra12">Restaurado</td>
                        <td>
                            <select name="ivrrestaurado" id="ivrrestaurado" style="display:none;">
                                <option value="">Seleccione...</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['configListas']->value['ivrLista'], 'ivr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ivr']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['ivr']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['ivr']->value['name'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <td>
                            <input type="checkbox" id="chkivr_cancelado" name="chkivr_cancelado" class="chkivr" />
                        </td>
                        <td class="letra12">Cancelado
                        </td>
                        <td>
                            <select name="ivrcancelado" id="ivrcancelado" style="display:none;">
                                <option value="">Seleccione...</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['configListas']->value['ivrLista'], 'ivr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ivr']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['ivr']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['ivr']->value['name'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <td>
                            <input type="checkbox" id="chkivr_programado" name="chkivr_programado" class="chkivr" />
                        </td>
                        <td class="letra12">Programado</td>
                        <td>
                            <select name="ivrprogramado" id="ivrprogramado" style="display:none;">
                                <option value="">Seleccione...</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['configListas']->value['ivrLista'], 'ivr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ivr']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['ivr']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['ivr']->value['name'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="50%">
                <table class="tabForm notificacionesTable" style="font-size: 16px;" width="100%">
                    <tr class="letra12">
                        <td><b>Plan Marcado:</b></td>
                        <td></td>
                    </tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['configListas']->value['outgoingRouteList'], 'route');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['route']->value) {
?>
                        <tr class="letra12">
                            <td colspan="2" align="right">
                                <div class="radio-containerd" style="text-align:left; width:60%">
                                    <input name="outgoingroute_<?php echo $_smarty_tpl->tpl_vars['route']->value['id'];?>
" id="outgoingroute_<?php echo $_smarty_tpl->tpl_vars['route']->value['id'];?>
" type="checkbox"
                                        value="<?php echo $_smarty_tpl->tpl_vars['route']->value['id'];?>
">
                                    <label for="outgoingroute_<?php echo $_smarty_tpl->tpl_vars['route']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['route']->value['name'];?>
</label>
                                </div>

                            </td>
                        </tr>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
            </td>
        </tr>
    </table>
</fieldset>
<table style="width:90%; margin-top:20px;">
    <tr>
        <td align="right">
            <input class="button" type="button" name="btnguardardatos" id="btnguardardatos" value="Guardar">
        </td>
    </tr>
</table>





<input class="button" type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" /><?php }
}
