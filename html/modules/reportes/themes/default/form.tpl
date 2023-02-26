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
            <td align="left">{$criterio.INPUT}
                <span class="letra12" style="margin-left:3em"><span class="required">*</span> {$REQUIRED_FIELD}</span>
                <!--<input class="button" type="submit" name="save_new" value="Aceptar">-->&nbsp;&nbsp;
            </td>
        </tr>

    </table>
    <input class="button" type="hidden" name="id" value="{$ID}" />

    {if $criterioActive eq 'eventos'}

        <fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
            <legend><span> Eventos </span> </legend>
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
                    <td align="left"><b>Id Evento: <span class="required">*</span></b></td>
                    <td align="left">
                        <input type="number" name="id_evento" id="id_evento" value="{$id_evento}">
                    </td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b>Tipo Evento: <span class="required">*</span></b></td>
                    <td align="left">
                        <select class="form-control" id="tipo_evento" name="tipo_evento">
                            <option value="">Seleccione...</option>
                            {foreach from= $configListas['tipoEventosLista'] key=k item=v}
                                <option value="{$k}" {if $k == $tipo_evento}selected{/if}>{$v}
                                </option>
                            {/foreach}

                        </select>
                    </td>
                </tr>
                <tr class="letra12">
                    <td align="left"></td>
                    <td align="left"></td>
                    <td align="left"><input class="button" type="submit" name="save_new" value="Aceptar"></td>
                </tr>

            </table>
        </fieldset>



    {/if}



    {if $criterioActive eq 'otros'}
        <fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
            <legend><span> Otros </span> </legend>
            <table class="tabForm" cellpading="10" width="700" style="margin-top:2em">
                <tr class="letra12">
                    <td align="left"><b>{$nus.LABEL}: </b></td>
                    <td align="left">{$nus.INPUT}</td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b>{$telefono.LABEL}: </b></td>
                    <td align="left">{$telefono.INPUT}</td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b>{$fecha_llamada.LABEL}: </b></td>
                    <td align="left">{$fecha_llamada.INPUT}</td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b>{$id_evento.LABEL}: </b></td>
                    <td align="left">{$id_evento.INPUT}</td>
                </tr>
                <tr class="letra12">
                    <td align="left"></td>
                    <td align="left"></td>
                    <td align="left"><input class="button" type="submit" name="save_new" value="Aceptar"></td>
                </tr>
            </table>
        </fieldset>
{/if}