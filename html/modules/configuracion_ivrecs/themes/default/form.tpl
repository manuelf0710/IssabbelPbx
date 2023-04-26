<link href="modules/configuracion_ivrecs/themes/css/configuracion_ivrecs_module.css" rel="stylesheet" />
<script type='text/javascript' src="modules/configuracion_ivrecs/themes/js/reportes_module.js">
</script>
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
            <td align="left">
                <input type="text" name="ip" id="ip" value="{$configuracionIVR.ip}">
            </td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$rutao.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
                <input type="text" name="ruta" id="ruta" value="{$configuracionIVR.ruta}">
            </td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$identificador_ivr.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
                <select name="ivr_misc" id="ivr_misc">
                    <option value="">Seleccione...</option>
                    
                    {foreach $ivrMiscList as $ivr}
                        <option value="{$ivr.id}"
                            {if $ivr.id == $configuracionIVR.identificador}selected{/if}>
                            {$ivr.description}-{$ivr.destdial}</option>
                    {/foreach}                    
                </select>            
            </td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$cola_desbordeo.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
                <select name="cola" id="cola">
                    <option value="">Seleccione...</option>
                    
                    {foreach $queueList as $ivr}
                        <option value="{$ivr.extension}"
                            {if $ivr.extension == $configuracionIVR.cola_desborde}selected{/if}>
                            {$ivr.extension}-{$ivr.descr}</option>
                    {/foreach}                      
                </select>
            </td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$usuarioo.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
                <input type="text" name="usuario" id="usuario" value="{$configuracionIVR.usuario}">
            </td>
        </tr>
        <tr class="letra12">
            <td align="left"><b>{$contrasenao.LABEL}: <span class="required">*</span></b></td>
            <td align="left">
                <input type="password" 
                    name="contrasena" id="contrasena" value="{$configuracionIVR.contrasena}"
                >
                <i class="fa fa-eye toogle-type-password" onclick="tooglePassword('contrasena')"></i>
            </td>
            <td align="left">{$contrasenamariadb.INPUT}</td>

        </tr>
        <tr class="letra12">
            <td colspan="2" align="right"><input class="button" type="submit" name="save_new" value="{$SAVE}"></td>
        </tr>

    </table>
    <input class="button" type="hidden" name="id" value="{$ID}" />
    {if $s eq '1'}
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>Guardado exitoso!</strong> se han almacenado todas las configuraciones correctamente.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.href='index.php?menu=configuracion_ivrecs'">
        <span aria-hidden="true">&times;</span>
        </button>
    </div> 
    {/if}   
</fieldset>