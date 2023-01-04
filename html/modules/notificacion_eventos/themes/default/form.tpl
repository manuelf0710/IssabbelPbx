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
        <td align="right" nowrap><span class="letra12"><span  class="required">*</span> {$REQUIRED_FIELD}</span></td>
    </tr>
</table>
<table class="tabForm" style="font-size: 16px;" width="100%" >
    <tr class="letra12">
        <td align="left" width="35%"><b>{$criterio.LABEL}: <span  class="required">*</span></b></td>
        <td align="left">{$criterio.INPUT} 
            <input class="button" type="submit" name="save_new" value="Aceptar">&nbsp;&nbsp;
        </td>
    </tr>

</table>
<input class="button" type="hidden" name="id" value="{$ID}" />

{if $criterioActive eq 'eventos'}
    <table cellpading="10" width="700" style="margin-top:2em">
    <tr class="letra12">
        <td align="left"><b>{$fecha_inicial.LABEL}: <span  class="required">*</span></b></td>
        <td align="left">{$fecha_inicial.INPUT}</td>
        <td align="left"><b>{$fecha_final.LABEL}: <span  class="required">*</span></b></td>
        <td align="left">{$fecha_final.INPUT}</td>
    </tr>  
    <tr class="letra12">
        <td align="left"><b>{$id_evento.LABEL}: <span  class="required">*</span></b></td>
        <td align="left">{$id_evento.INPUT}</td>
    </tr> 
    <tr class="letra12">
        <td align="left"><b>{$tipo_evento.LABEL}: <span  class="required">*</span></b></td>
        <td align="left">{$tipo_evento.INPUT}</td>       
    </tr>
</table>    

    
{/if}



{if $criterioActive eq 'otros'}

{/if}
