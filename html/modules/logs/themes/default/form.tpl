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
            <td align="right" nowrap><span class="letra12"></td>
        </tr>
    </table>
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
            <td align="left"><b>Fecha Inicial: </b></td>
            <td align="left">
                <input type="text" name="fecha_inicial" id="fecha_inicial" value="{$fecha_inicial}" class="calendar-reports">
            </td>
            <td align="left"><b>Fecha Final: </b></td>
            <td align="left">
                <input type="text" name="fecha_final" id="fecha_final" value="{$fecha_final}" class="calendar-reports">
            </td>   
        </tr>
        <tr class="letra12">
            <td align="left"><b>Tipo:</b></td>
            <td align="left">
            <select name="tipo" id="tipo">
                    <option value="error" {if "error" == $tipo}selected{/if}>Error</option>
                    <option value="informativa" {if "informativa" == $tipo}selected{/if}>Informativa</option>
                    <option value="todos" {if "todos" == $tipo}selected{/if}>Todos</option>
            </select>            
            </td>
            <td align="left"><b>Módulo:</b></td>
            <td align="left">
                <select name="modulo" id="modulo">
                    <option value="apache" {if "apache" == $modulo}selected{/if}>Apache Error Log</option>
                    <option value="apacheAccess" {if "apacheAccess" == $modulo}selected{/if}>Apache Access Log</option>
                    <option value="Auditorias" {if "Auditorias" == $modulo}selected{/if}>Auditorias</option>
                    <option value="conexionbd" {if "conexionbd" == $modulo}selected{/if}>Conexión a Base de datos</option>
                    <option value="mariadb" {if "mariadb" == $modulo}selected{/if}>MariaDB</option>
                    <option value="cronjob" {if "cronjob" == $modulo}selected{/if}>Notificación Eventos</option>
                </select>
            </td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>Filtrar sin fecha:</b></td>
            <td align="left">
                <input type="checkbox" id="include_fecha" name="include_fecha" value="1" {if "1" == $include_fecha}checked{/if}>
            </td>  
        </tr>
        <tr class="letra12">
            <td colspan="4" align="right">
                <input class="button" type="button" id="btnsearchlogs" name="save_new" value="Aceptar">
            </td>
        </tr>

    </table>
    <input class="button" type="hidden" name="id" value="{$ID}" />
</fieldset>