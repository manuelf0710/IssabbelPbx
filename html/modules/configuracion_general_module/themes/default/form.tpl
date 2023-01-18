<link href="modules/configuracion_general_module/themes/css/configuraciongeneral_module.css" rel="stylesheet" />
<script type='text/javascript' src="modules/configuracion_general_module/themes/js/configuraciongeneral_module.js">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
    <tr class="letra12">
        {if $mode eq 'input'}
            <td align="left">
                <!--<input class="button" type="submit" name="save_new" value="{$SAVE}">&nbsp;&nbsp;
                <input class="button" type="submit" name="cancel" value="{$CANCEL}">-->
            </td>
        {elseif $mode eq 'view'}
            <td align="left">
                <input class="button" type="submit" name="cancel" value="{$CANCEL}">
            </td>
        {elseif $mode eq 'edit'}
            <td align="left">
                <input class="button" type="submit" name="save_edit" value="{$EDIT}">&nbsp;&nbsp;
                <input class="button" type="submit" name="cancel" value="{$CANCEL}">
            </td>
        {/if}
    </tr>
</table>
<!--
<fieldset style="border-radius: 5px; padding: 5px; min-height:150px;  margin-top:20px;">
    <legend><span> Configuración NODEJS </span> </legend>
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
            <td colspan="6" align="right" nowrap>
                <span class="letra12"><span class="required">*</span>{$REQUIRED_FIELD}</span>
            </td>

        </tr>
        <tr>
            <td align="left" class="letra12" width="150"><b>Puerto Nodejs: <span class="required">*</span></b></td>
            <td>
                <input type="text" id="portnodejs" name="portnodejs" value="">
            </td>
        </tr>
    </table>
    <table style="width:98%; margin-top:20px;">
        <tr>
            <td align="right">
                <input class="button" type="button" name="btnguardardatosnode" id="btnguardardatosnode"
                    value="Modificar">
                <div class="row" style="margin-top:5px; padding:10px">
                    <div class="alert alert-danger mt-1" id="conexionnoexitosanode" style="display:none">Conexión no
                        exitosa
                    </div>
                    <div class="alert alert-success mt-1" id="conexionexitosanode" style="display:none">Conexión exitosa
                    </div>
                </div>
            </td>
        </tr>
    </table>
</fieldset>-->
<fieldset style="border-radius: 5px; padding: 5px; min-height:150px;  margin-top:20px;">
    <legend><span> Configuración de conexión Local o MariaDB </span> </legend>
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
            <td colspan="6" align="right" nowrap>
                <span class="letra12"><span class="required">*</span>{$REQUIRED_FIELD}</span>
            </td>

        </tr>
        <tr class="letra12">
            <td align="left"><b>{$motormariadb.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
                {$motormariadb.INPUT}
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$servidormariadb.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$servidormariadb.INPUT}</td>
            <td align="left"><b>{$usuariomariadb.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$usuariomariadb.INPUT}</td>
            <td align="left"><b>{$contrasenamariadb.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$contrasenamariadb.INPUT}<i class="fa fa-eye toogle-type-password"></i></td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$basedatosmariadb.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$basedatosmariadb.INPUT}</td>
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
                <span class="letra12"><span class="required">*</span>{$REQUIRED_FIELD}</span>
            </td>

        </tr>
        <tr class="letra12">
            <td align="left"><b>{$motor.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
                {$motor.INPUT}
                <!--<select name="motor" id="motor">
                    <option value="">Seleccione...</option>
                    {foreach $configListas['conexionesLista'] as $cn}
                        <option value="{$cn.id}">{$cn.motor}</option>
                    {/foreach}
                </select>-->
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$servidor.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$servidor.INPUT}</td>
            <td align="left"><b>{$usuario.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$usuario.INPUT}</td>
            <td align="left"><b>{$contrasena.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$contrasena.INPUT}<i class="fa fa-eye toogle-type-password"></i></td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$basedatos.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$basedatos.INPUT}</td>
            <td align="left"><b>{$tablavista.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$tablavista.INPUT}</td>
            <td align="left"><B>Estado</B></td>
            <td align="left">
                {$activo.INPUT}
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
<input class="button" type="hidden" name="id" value="{$ID}" />