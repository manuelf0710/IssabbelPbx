<link href="modules/auditorias/themes/css/auditorias_module.css" rel="stylesheet" />
<script type='text/javascript' src="modules/auditorias/themes/js/auditorias_module.js"></script>
<fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
    <legend><span> Auditorias </span> </legend>
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
            <td align="left"><b>{$fecha_inicial.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
                <input type="text" name="fecha_inicial" id="fecha_inicial" value="" class="calendar-reports">
            </td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$fecha_final.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
                <input type="text" name="fecha_final" id="fecha_final" value="" class="calendar-reports">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input class="button" type="submit" name="save_new" value="Aceptar">
            </td>
        </tr>
    </table>
    <input class="button" type="hidden" name="id" value="{$ID}" />
</fieldset>