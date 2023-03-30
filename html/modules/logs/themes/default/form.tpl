<link href="modules/logs/themes/css/logs_module.css" rel="stylesheet" />
<script type='text/javascript' src="modules/logs/themes/js/logs_module.js"></script>
<fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
    <legend><span> Logs </span> </legend>
    <h4 style="margin: 0px">Filtrar por: </h4>
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
            <td align="right" nowrap><span class="letra12"><span class="required">*</span> {$REQUIRED_FIELD}</span></td>
        </tr>
    </table>
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
            <td align="left"><b>Fecha Inicial: <span class="required">*</span></b></td>
            <td align="left">
                <input type="text" name="fecha_inicial" id="fecha_inicial" value="{$fecha_inicial}" class="calendar-reports">
            </td>
            <td align="left"><b>Fecha Final: <span class="required">*</span></b></td>
            <td align="left">
                <input type="text" name="fecha_final" id="fecha_final" value="{$fecha_final}" class="calendar-reports">
            </td>   
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$tipo.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$tipo.INPUT}</td>
            <td align="left"><b>Módulo</b></td>
            <td align="left">
                <select name="modulo" id="modulo">
                    <option value="apache" {if "apache" == $modulo}selected{/if}>Apache</option>
                    <option value="asterisk" {if "asterisk" == $modulo}selected{/if}>Asterisk</option>
                    <option value="Auditorias" {if "Auditorias" == $modulo}selected{/if}>Auditorias</option>
                    <option value="conexionbd" {if "conexionbd" == $modulo}selected{/if}>Conexión a Base de datos</option>
                    <option value="cronjob" {if "cronjob" == $modulo}selected{/if}>Notificación Eventos</option>
                    <option value="php" {if "php" == $modulo}selected{/if}>PHP</option>
                </select>
            </td>
        </tr>
        <tr class="letra12">
            <td colspan="4" align="right">
                <input class="button" type="submit" name="save_new" value="Aceptar">
            </td>
        </tr>

    </table>
    <input class="button" type="hidden" name="id" value="{$ID}" />
</fieldset>