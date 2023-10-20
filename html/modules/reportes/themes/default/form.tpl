<link href="modules/reportes/themes/css/reportes_module.css" rel="stylesheet" />
<script type='text/javascript' src="modules/reportes/themes/js/reportes_module.js"></script>
<section style="margin: 10px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
        <tr class="letra12">
            {if $mode eq 'input'}
                <td align="left">
                    <!--<input class="button" type="submit" name="save_new" value="{$SAVE}">&nbsp;&nbsp; -->
                    <!--<input class="button" type="submit" name="cancel" value="{$CANCEL}">-->
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
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
            <td align="left" width="35%"><b>{$criterio.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
            <select name="criterio" id="criterio">
                <option value="" >Seleccione...</option>
                <option value="eventos" {if 'eventos' == $criterioActive}selected{/if}>Eventos</option>
                <option value="otros" {if 'otros' == $criterioActive}selected{/if}>Otros</option>
                <option value="text2speech" {if 'text2speech' == $criterioActive}selected{/if}>Notificaciones de llamadas</option>
            </select>

                <span class="letra12" style="margin-left:3em"><span class="required">*</span> {$REQUIRED_FIELD}</span>
                <!--<input class="button" type="submit" name="save_new" value="Aceptar">-->&nbsp;&nbsp;
            </td>
        </tr>

    </table>
    <input class="button" type="hidden" name="id" value="{$ID}" />

    {if $criterioActive eq 'text2speech'}

        <fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
            <legend><span> Notificaciones de llamadas </span> </legend>
            <td style="margin: 0tdx">Realice la búsqueda con cualquiera de los <br> siguientes criterios:</p>
            <table class="tabForm" cellpading="10" width="700" style="margin-top:2em">
                <tr class="letra12">
                    <td align="left"><b>Fecha Inicial: <span class="required">*</span></b></td>
                    <td align="left">
                        <input type="text" name="fecha_inicial" id="fecha_inicial" value="{$fecha_inicial}"
                            class="calendar-reports">
                    </td>
                    <td align="left"><b>Fecha Final: <span class="required">*</span></b></td>
                    <td align="left">

                        <input type="text" name="fecha_final" id="fecha_final" value="{$fecha_final}"
                            class="calendar-reports">
                    </td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b>ID Evento: <span class="required">*</span></b></td>
                    <td align="left">
                        <input type="number" name="id_evento" id="id_evento" value="{$id_evento}">
                    </td>
                    <td align="right" colspan="5"><input class="button" type="submit" name="save_new" value="Aceptar"></td>                    
                </tr>

            </table>
        </fieldset>
        {if $id_evento neq ""}
                <p style="margin-top:1em">Registros relacionados con ID evento {$id_evento}</p>
        {/if}
    {/if}
    
    {if $criterioActive eq 'eventos'}

        <fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
            <legend><span> Eventos </span> </legend>
            <td style="margin: 0tdx">Realice la búsqueda con cualquiera de los <br> siguientes criterios:</p>
            <table class="tabForm" cellpading="10" width="700" style="margin-top:2em">
                <tr class="letra12">
                    <td align="left"><b>Fecha Inicial: <span class="required">*</span></b></td>
                    <td align="left">
                        <input type="text" name="fecha_inicial" id="fecha_inicial" value="{$fecha_inicial}"
                            class="calendar-reports">
                    </td>
                    <td align="left"><b>Fecha Final: <span class="required">*</span></b></td>
                    <td align="left">

                        <input type="text" name="fecha_final" id="fecha_final" value="{$fecha_final}"
                            class="calendar-reports">
                    </td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b>ID Evento: <span class="required">*</span></b></td>
                    <td align="left">
                        <input type="number" name="id_evento" id="id_evento" value="{$id_evento}">
                    </td>
                    <td align="right" colspan="5"><input class="button" type="submit" name="save_new" value="Aceptar"></td>                    
                </tr>

            </table>
        </fieldset>
        {if $id_evento neq ""}
                <p style="margin-top:1em">Registros relacionados con ID evento {$id_evento}</p>
        {/if}
    {/if}



    {if $criterioActive eq 'otros'}
        <fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
            <legend><span> Otros </span> </legend>
            <td style="margin: 0tdx">Realice la búsqueda con cualquiera de los <br> siguientes criterios:</p>
            <table class="tabForm" cellpading="10" width="700" style="margin-top:2em">
                <tr class="letra12">
                    <td align="left"><b>NUS: </b></td>
                    <td align="left">
                    <input type="text" name="nus" id="nus" value="{$nus}">
                    </td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b>Teléfono: </b></td>
                    <td align="left">
                    <input type="number" name="telefono" id="telefono" value="{$telefono}">
                    </td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b>Fecha llamada: </b></td>
                    <td align="left">
                    <input type="text" name="fecha_llamada" id="fecha_llamada" value="{$fecha_llamada}"
                            class="calendar-reports">
                    </td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b>Id evento: </b></td>
                    <td align="left">
                    <input type="text" name="id_eventootros" id="id_eventootros" value="{$id_eventootros}">
  
                    </td>
                    <td align="right"><input class="button" type="submit" name="save_new" value="Aceptar"></td>                    
                </tr>
            </table>
        </fieldset>
{/if}