<?php
/* Smarty version 3.1.33, created on 2022-12-22 14:02:20
  from '/var/www/html/modules/sec_advanced_settings/themes/default/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4a9bc604cc6_19598529',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8a31997d748b79de3caacfc61c2117f9338bfbd7' => 
    array (
      0 => '/var/www/html/modules/sec_advanced_settings/themes/default/form.tpl',
      1 => 1576169518,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4a9bc604cc6_19598529 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
    <tr class="letra12">
        <?php if ($_smarty_tpl->tpl_vars['mode']->value == 'input') {?>
        <td align="left">
            <input class="button" type="submit" name="update_advanced_security_settings" value="<?php echo $_smarty_tpl->tpl_vars['SAVE']->value;?>
">&nbsp;&nbsp;
        </td>
        <?php }?>
    </tr>
</table>
<table class="tabForm" style="font-size: 16px;" width="100%" >
    <tr>
	<td  width="50%" valign='top'>
	    <table>
		<tr class="letra12">
		    <td align="left"><b class='form-label-style'><?php echo $_smarty_tpl->tpl_vars['subtittle1']->value;?>
</b></td>
		</tr>
		<tr class="letra12">
		    <td align="left" >
                        <b><?php echo $_smarty_tpl->tpl_vars['status_ipbx_frontend']->value['LABEL'];?>
:</b>
                    </td>
		    <td align="left" ><input type="hidden" name="oldstatus_ipbx_frontend" id="oldstatus_ipbx_frontend" value="<?php if ($_smarty_tpl->tpl_vars['value_ipbx_frontend']->value) {?>1<?php } else { ?>0<?php }?>" /><input type="checkbox" name="status_ipbx_frontend" id="status_ipbx_frontend" <?php if ($_smarty_tpl->tpl_vars['value_ipbx_frontend']->value) {?>checked="checked"<?php }?> /></td>
		</tr>
        <tr class="letra12">
            <td align="left" ><b><?php echo $_smarty_tpl->tpl_vars['status_anonymous_sip']->value['LABEL'];?>
:</b></td>
            <td align="left" ><input type="hidden" name="oldstatus_anonymous_sip" id="oldstatus_anonymous_sip" value="<?php if ($_smarty_tpl->tpl_vars['value_anonymous_sip']->value) {?>1<?php } else { ?>0<?php }?>" /><input type="checkbox" name="status_anonymous_sip" id="status_anonymous_sip" <?php if ($_smarty_tpl->tpl_vars['value_anonymous_sip']->value) {?>checked="checked"<?php }?> /></td>
        </tr>
	    </table>
	</td>
	<td width="50%" valign='top'>
	    <table>
		<tr class="letra12">
		    <td align="left"><b class='form-label-style'><?php echo $_smarty_tpl->tpl_vars['subtittle2']->value;?>
</b></td>
		</tr>
		<tr class="letra12">
		    <td align="left" >
                        <b><?php echo $_smarty_tpl->tpl_vars['ipbx_password']->value['LABEL'];?>
:</b>                        
                    </td>
		    <td align="left" ><?php echo $_smarty_tpl->tpl_vars['ipbx_password']->value['INPUT'];?>
</td>
		</tr>
		<tr class="letra12">
		    <td align="left" ><b><?php echo $_smarty_tpl->tpl_vars['ipbx_confirm_passwrod']->value['LABEL'];?>
:</b></td>
		    <td align="left" ><?php echo $_smarty_tpl->tpl_vars['ipbx_confirm_passwrod']->value['INPUT'];?>
</td>
		</tr>
	    </table>
	</td>
    </tr>
</table>
<?php }
}
