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
                <input type="number" name="cant_lineas" id="cant_lineas" value="{$dataForm.configuracionGeneral.cant_lineas}">
            </td>
        </tr>
        <tr class="letra12">
            <td colspan="2" align="left" width="70%">
                <!--{$activar_desactivar.INPUT}-->
                <div class="material-switch font-weight-bold">
                    Desactivar&nbsp;&nbsp;
                    <input id="activar_desactivar" name="activar_desactivar" type="checkbox" {if 1 == $dataForm.configuracionGeneral.activo}checked{/if} />
                    <label for="activar_desactivar" class="label-success"></label>&nbsp;&nbsp;Activar
                </div>
            </td>
            <td align="left"><b>{$barridos.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
                <select name="barridos" id="barridos">
                
                <option value="">Seleccione...</option>
                {foreach from=[1,2,3,4,5] item=num}
                    <option value="{$num}" {if $num == $dataForm.configuracionGeneral.barridos}selected{/if}>{$num}</option>
                  {/foreach}
                </select>
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
                            <input type="checkbox" id="chkivr_confirmado" name="chkivr_confirmado" class="chkivr" 
                            {if $dataForm.configuracionGeneral.activar_confirmado == 1}checked{/if}
                            
                            />
                        </td>
                        <td class="letra12">Confirmado</td>
                        <td>
                            <select name="ivrconfirmado" id="ivrconfirmado" style="display:{if $dataForm.configuracionGeneral.activar_confirmado == 1}
                                block,
                            {else}
                               none;
                            {/if}">
                                <option value="">Seleccione...</option>
                                {foreach $configListas['ivrLista'] as $ivr}
                                    <option value="{$ivr.id}"  {if $ivr.id == $dataForm.configuracionGeneral.ivr_confirmado}selected{/if}>{$ivr.name}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <td>
                            <input type="checkbox" id="chkivr_restaurado" name="chkivr_restaurado" class="chkivr"
                        {if $dataForm.configuracionGeneral.activar_restaurado == 1}checked{/if}
                            />
                        </td>
                        <td class="letra12">Restaurado</td>
                        <td>
                            <select name="ivrrestaurado" id="ivrrestaurado" style="display:{if $dataForm.configuracionGeneral.activar_restaurado == 1}
                                block,
                            {else}
                               none;
                            {/if}">                            
                           
                                <option value="">Seleccione...</option>
                                {foreach $configListas['ivrLista'] as $ivr}
                                    <option value="{$ivr.id}" {if $ivr.id == $dataForm.configuracionGeneral.ivr_restaurado}selected{/if}>{$ivr.name}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <td>
                            <input type="checkbox" id="chkivr_cancelado" name="chkivr_cancelado" class="chkivr"
                        {if $dataForm.configuracionGeneral.activar_cancelado == 1}checked{/if}
                            />
                        </td>
                        <td class="letra12">Cancelado
                        </td>
                        <td>
                            <select name="ivrcancelado" id="ivrcancelado" style="display:{if $dataForm.configuracionGeneral.activar_cancelado == 1}
                                block,
                            {else}
                               none;
                            {/if}">                            
                           
                                <option value="">Seleccione...</option>
                                {foreach $configListas['ivrLista'] as $ivr}
                                    <option value="{$ivr.id}" {if $ivr.id == $dataForm.configuracionGeneral.ivr_cancelado}selected{/if}>{$ivr.name}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <td>
                            <input type="checkbox" id="chkivr_programado" name="chkivr_programado" class="chkivr"
                        {if $dataForm.configuracionGeneral.activar_programado == 1}checked{/if}
                            />
                        </td>
                        <td class="letra12">Programado</td>
                        <td>
                            <select name="ivrprogramado" id="ivrprogramado" style="display:
                            {if $dataForm.configuracionGeneral.activar_programado == 1}
                                block,
                            {else}
                               none;
                            {/if}">                            
                                <option value="">Seleccione...</option>
                                {foreach $configListas['ivrLista'] as $ivr}
                                    <option value="{$ivr.id}"{if $ivr.id == $dataForm.configuracionGeneral.ivr_programado}selected{/if} >{$ivr.name}</option>
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
                                        value="{$route.id}" 
                                        {if $route.enable_notificacion == 1}checked{/if}
                                        
                                        >
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
                    <select name="horainicialnot" id="horainicialnot">
                    {foreach from= $configListas['optionsHours'] key=k item=v}
                        <option value="{$k}"{if $k == $dataForm.configuracionGeneral.horainicialnot}selected{/if} >{$v}</option>
                    {/foreach}                          
                    </select>
                    
                    &nbsp;
                    <select name="minutoinicialnot" id="minutoinicialnot">
                    {foreach from= $configListas['optionsMins'] key=k item=v}
                        <option value="{$k}"{if $k == $dataForm.configuracionGeneral.minutoinicialnot}selected{/if} >{$v}</option>
                    {/foreach}                          
                    </select>                    
                </td>
            </tr>
            <tr class="letra12">
                <td>
                       <b> Hora Final Notif:</b>
                </td>
                <td>
                <select name="horafinalnot" id="horafinalnot">
                {foreach from= $configListas['optionsHours'] key=k item=v}
                    <option value="{$k}"{if $k == $dataForm.configuracionGeneral.horafinalnot}selected{/if} >{$v}</option>
                {/foreach}                          
                </select>
                
                &nbsp;  
                <select name="minutofinalnot" id="minutofinalnot">
                {foreach from= $configListas['optionsMins'] key=k item=v}
                    <option value="{$k}"{if $k == $dataForm.configuracionGeneral.minutofinalnot}selected{/if} >{$v}</option>
                {/foreach}                          
                </select>                 
                </td>
            </tr>   
            
            <tr class="letra12">
                <td> <b>{$diainicialnot.LABEL}:</b></td>
                <td>
                <select name="diainicialnot" id="diainicialnot">
                <option value="">Seleccione...</option>
                {foreach from= $configListas['diasLista'] key=k item=v}
                    <option value="{$k}"{if $k == $dataForm.configuracionGeneral.dia_inicial_notif}selected{/if} >{$v}</option>
                  {/foreach}              
                </select>
                </td>
            </tr>
            <tr class="letra12">
                <td> <b>{$diafinalnot.LABEL}:</b></td>
                <td>
                    <select name="diafinalnot" id="diafinalnot">
                    <option value="">Seleccione...</option>
                    {foreach from= $configListas['diasLista'] key=k item=v}
                        <option value="{$k}"{if $k == $dataForm.configuracionGeneral.dia_final_notif}selected{/if} >{$v}</option>
                      {/foreach}              
                    </select>                    
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