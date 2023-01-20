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
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr>
            <td width="50%"></td>
            <td>
                <table>
                <tr class="letra12">
                <td align="right">
                      <b>  Hora Inicial Notif:</b>
                </td>
                <td>
                    {$horainicialnot.INPUT} &nbsp;  {$minutoinicialnot.INPUT}
                </td>
            </tr>
            <tr class="letra12">
                <td>
                       <b> Hora Final Notif:</b>
                </td>
                <td>
                {$horafinalnot.INPUT} &nbsp;  {$minutofinalnot.INPUT}
                </td>
            </tr>   
            
            <tr class="letra12">
                <td> <b>{$diainicialnot.LABEL}:</b></td>
                <td>
                {$diainicialnot.INPUT}
                </td>
            </tr>
            <tr class="letra12">
                <td> <b>{$diafinalnot.LABEL}:</b></td>
                <td>
                    {$diafinalnot.INPUT} 
                </td>        
            </tr>            
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