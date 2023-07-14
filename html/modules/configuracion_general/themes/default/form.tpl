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
    <table class="tabForm" style="font-size: 16px;" width="100%" >

        <tr class="letra12">
            <td align="left" width="250">
                <!--{$activar_desactivar.INPUT}-->
                <div class="material-switch font-weight-bold">
                    Desactivar&nbsp;&nbsp;
                    <input id="activar_desactivar" name="activar_desactivar" value="1" type="checkbox"
                        {if 1 == $dataForm.configuracionGeneral.activo}checked{/if} />
                    <label for="activar_desactivar" class="label-success"></label>&nbsp;&nbsp;Activar
                </div>
            </td>
        </tr>
        <tr class="letra12">
            <td><b>Destino:</b></td>
            <td  align="right" width="150">
            <input type="checkbox" value="1" id="chkivr_restaurado" name="chkivr_restaurado"
            data-destino="ivrrestaurado" data-labelivr="restaurado" class="chkivr" style="display:none"
           checked />                        
                <select name="ivrrestaurado" id="ivrrestaurado">

                    <option value="">Seleccione...</option>
                    {foreach $configListas['ivrLista'] as $ivr}
                        <option value="{$ivr.id}"
                            {if $ivr.id == $dataForm.configuracionGeneral.ivr_restaurado}selected{/if}>
                            {$ivr.name}</option>
                    {/foreach}
                </select>
            </td>
            <td class="letra12 pl" width="250"><b>Fecha Finalización del Evento:</b><br>YYYY-mm-dd</td> 
            <td>
                <input class="calendar-configgeneral" style="width: 85px;" type="text" id="fecha_busqueda" name="fecha_busqueda" value="{$dataForm.configuracionGeneral.fecha_busqueda}" readonly>                      
            </td>
        </tr>       
        <tr class="letra12">
            <td><b>{$cant_lineas.LABEL}</b></td>
            <td align="right">
                <input type="number" name="cant_lineas" id="cant_lineas" value="{$dataForm.configuracionGeneral.cant_lineas}">
            </td>
            <td align="left" class="pl"><b> Hora Inicial Notif:</b></td> 
            <td>
                    <select name="horainicialnot" id="horainicialnot">
                    {foreach from= $configListas['optionsHours'] key=k item=v}
                        <option value="{$k}"
                            {if $k == $dataForm.configuracionGeneral.horainicialnot}selected{/if}>{$v}</option>
                    {/foreach}
                   </select>

                &nbsp;
                <select name="minutoinicialnot" id="minutoinicialnot">
                    {foreach from= $configListas['optionsMins'] key=k item=v}
                        <option value="{$k}"
                            {if $k == $dataForm.configuracionGeneral.minutoinicialnot}selected{/if}>{$v}
                        </option>
                    {/foreach}
                </select>            
            </td>
        </tr>       
        <tr class="letra12">
            <td ><b>{$barridos.LABEL}: <span class="required">*</span></b></td>
            <td align="right">
                <select name="barridos" id="barridos" style>

                    <option value="">Seleccione...</option>
                    {foreach from=[1,2,3,4,5] item=num}
                        <option value="{$num}" {if $num == $dataForm.configuracionGeneral.barridos}selected{/if}>{$num}
                        </option>
                    {/foreach}
                </select>
            </td> 
            <td class="pl">
            <b> Hora Final Notif:</b>
            </td>
            <td>
                <select name="horafinalnot" id="horafinalnot">
                    {foreach from= $configListas['optionsHours'] key=k item=v}
                        <option value="{$k}"
                            {if $k == $dataForm.configuracionGeneral.horafinalnot}selected{/if}>{$v}</option>
                    {/foreach}
                </select>

                &nbsp;
                <select name="minutofinalnot" id="minutofinalnot">
                    {foreach from= $configListas['optionsMins'] key=k item=v}
                        <option value="{$k}"
                            {if $k == $dataForm.configuracionGeneral.minutofinalnot}selected{/if}>{$v}</option>
                    {/foreach}
                </select>
            </td>          
        </tr>       
        <tr class="letra12">
            <td><b>Plan Marcado:</b></td>
            <td align="right">
            {$counter = 100}
            <select name="notificacion_troncal" id="notificacion_troncal">
                    <option value="">Seleccione...</option>
                {foreach $configListas['outgoingRouteList'] as $route}
                    <option value="{$route.trunkid}" {if $route.id == $dataForm.configuracionGeneral.notificacion_troncal}selected{/if}>{$route.name}</option>
                    {$counter = $counter + 1}
                {/foreach}
                
            </select>                        
            </td>
            <td class="pl"> <b>{$diainicialnot.LABEL}:</b></td>
            <td>
                <select name="diainicialnot" id="diainicialnot">
                    <option value="">Seleccione...</option>
                    {foreach from= $configListas['diasLista'] key=k item=v}
                        <option value="{$k}"
                            {if $k == $dataForm.configuracionGeneral.dia_inicial_notif}selected{/if}>{$v}
                        </option>
                    {/foreach}
                </select>
            </td>
        </tr>       
        <tr class="letra12">
            <td class="letra12">
                <b><span title="Tiempo en segundos que puede durar la llamada antes de que el usuario final conteste">Timeout:<span></b>
                 <br>
                <b>(segundos)</b>
            </td>
            <td align="right"><input type="number" id="timeout" name="timeout"value="{$dataForm.configuracionGeneral.timeout}"></td>  
            <td class="pl"> <b>{$diafinalnot.LABEL}:</b></td>
            <td>
                <select name="diafinalnot" id="diafinalnot">
                    <option value="">Seleccione...</option>
                    {foreach from= $configListas['diasLista'] key=k item=v}
                        <option value="{$k}"
                            {if $k == $dataForm.configuracionGeneral.dia_final_notif}selected{/if}>{$v}</option>
                    {/foreach}
                </select>
            </td>

        </tr> 
        <tr class="letra12">
        <td><b>Grupo Hora:</b></td>
        <td  align="right" width="150">                       
            <select name="timegroup" id="timegroup">

                <option value="">Seleccione...</option>
                {foreach $configListas['timeGroupList'] as $ivr}
                    <option value="{$ivr.id}"
                        {if $ivr.id == $dataForm.configuracionGeneral.timegroup}selected{/if}>
                        {$ivr.description}</option>
                {/foreach}
            </select>
            <input type="hidden" name="fechafinpermitida" id="fechafinpermitida" value="{$dataForm.configuracionGeneral.fechaminpermitida}">
            <input type="hidden" name="ahora" id="ahora" value="{$dataForm.configuracionGeneral.ahora}">
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





<input class="button" type="hidden" name="id" value="1" />