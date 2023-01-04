<link href="modules/configuracion_general/themes/css/configuraciongeneral_module.css" rel="stylesheet" />
<script type='text/javascript' src="modules/configuracion_general/themes/js/configuraciongeneral_module.js"></script>
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
            <td align="left"><B>{$activo.LABEL}</B></td>
            <td align="left">
                {$activo.INPUT}
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
                <b>{$cant_lineas.LABEL}</b>
            </td>
            <td align="right">
                {$cant_lineas.INPUT}
            </td>
        </tr>
        <tr class="letra12">
            <td colspan="2" align="left" width="70%">
                <!--{$activar_desactivar.INPUT}-->
                <div class="material-switch font-weight-bold">
                    Desactivar&nbsp;&nbsp;
                    <input id="activar_desactivar" name="activar_desactivar" type="checkbox" />
                    <label for="activar_desactivar" class="label-success"></label>&nbsp;&nbsp;Activar
                </div>
            </td>
            <td align="left"><b>{$barridos.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$barridos.INPUT}</td>
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
                                {foreach $configListas['ivrLista'] as $ivr}
                                    <option value="{$ivr.id}">{$ivr.name}</option>
                                {/foreach}
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
                                {foreach $configListas['ivrLista'] as $ivr}
                                    <option value="{$ivr.id}">{$ivr.name}</option>
                                {/foreach}
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
                                {foreach $configListas['ivrLista'] as $ivr}
                                    <option value="{$ivr.id}">{$ivr.name}</option>
                                {/foreach}
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
                                {foreach $configListas['ivrLista'] as $ivr}
                                    <option value="{$ivr.id}">{$ivr.name}</option>
                                {/foreach}
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
                    {foreach $configListas['outgoingRouteList'] as $route}
                        <tr class="letra12">
                            <td colspan="2" align="right">
                                <div class="radio-containerd" style="text-align:left; width:60%">
                                    <input name="outgoingroute_{$route.id}" id="outgoingroute_{$route.id}" type="checkbox"
                                        value="{$route.id}">
                                    <label for="outgoingroute_{$route.id}">{$route.name}</label>
                                </div>

                            </td>
                        </tr>
                    {/foreach}
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





<input class="button" type="hidden" name="id" value="{$ID}" />