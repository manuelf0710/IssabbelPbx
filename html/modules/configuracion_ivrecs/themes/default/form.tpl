<link href="modules/configuracion_ivrecs/themes/css/configuracion_ivrecs_module.css" rel="stylesheet" />
<fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
    <legend><span> Configuración IVR ECS </span> </legend>
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
            <td align="left"><b>{$ip_servidor_oms.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$ip_servidor_oms.INPUT}</td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$ruta.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$ruta.INPUT}</td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$identificador_ivr.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$identificador_ivr.INPUT}</td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$cola_desborde.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$cola_desborde.INPUT}</td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$usuario.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$usuario.INPUT}</td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$contrasena.LABEL}: <span class="required">*</span></b></td>
            <td align="left">{$contrasena.INPUT}</td>
        </tr>
        <tr class="letra12">
            <td colspan="2" align="right"><input class="button" type="submit" name="save_new" value="{$SAVE}"></td>
        </tr>

    </table>
    <input class="button" type="hidden" name="id" value="{$ID}" />
</fieldset>