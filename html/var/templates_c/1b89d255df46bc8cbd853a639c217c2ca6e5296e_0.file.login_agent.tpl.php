<?php
/* Smarty version 3.1.33, created on 2022-12-12 15:10:39
  from '/var/www/html/modules/agent_console/themes/default/login_agent.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63978abfc0b9e3_85491159',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b89d255df46bc8cbd853a639c217c2ca6e5296e' => 
    array (
      0 => '/var/www/html/modules/agent_console/themes/default/login_agent.tpl',
      1 => 1575212159,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63978abfc0b9e3_85491159 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/usr/share/php/Smarty/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTA_JQUERY_CSS']->value, 'CURR_ITEM');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['CURR_ITEM']->value) {
?>
    <?php if ($_smarty_tpl->tpl_vars['CURR_ITEM']->value[0] == 'css') {?>
<link rel="stylesheet" href='<?php echo $_smarty_tpl->tpl_vars['CURR_ITEM']->value[1];?>
' />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['CURR_ITEM']->value[0] == 'js') {
echo '<script'; ?>
 type="text/javascript" src='<?php echo $_smarty_tpl->tpl_vars['CURR_ITEM']->value[1];?>
'><?php echo '</script'; ?>
>
    <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<?php if ($_smarty_tpl->tpl_vars['NO_EXTENSIONS']->value) {?>
<p><h4 align="center"><?php echo $_smarty_tpl->tpl_vars['LABEL_NOEXTENSIONS']->value;?>
</h4></p>
<?php } elseif ($_smarty_tpl->tpl_vars['NO_AGENTS']->value) {?>
<p><h4 align="center"><?php echo $_smarty_tpl->tpl_vars['LABEL_NOAGENTS']->value;?>
</h4></p>
<?php } else { ?>
<form method="POST"  action="index.php?menu=<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" onsubmit="do_login(); return false;">

<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="498"  class="menudescription">
      <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
        <tr>
          <td class="menudescription2">
              <div align="left"><font color="#ffffff">&nbsp;&raquo;&nbsp;<?php echo $_smarty_tpl->tpl_vars['WELCOME_AGENT']->value;?>
</font></div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="498" bgcolor="#ffffff">
      <table width="100%" border="0" cellspacing="0" cellpadding="8" class="tabForm">
        <tr>
          <td colspan="2">
            <div align="center"><?php echo $_smarty_tpl->tpl_vars['ENTER_USER_PASSWORD']->value;?>
<br/><br/></div>
          </td>
        </tr>
        <tr id="login_fila_estado" <?php echo $_smarty_tpl->tpl_vars['ESTILO_FILA_ESTADO_LOGIN']->value;?>
>
          <td colspan="2">
            <div align="center" id="login_icono_espera" height='1'><img id="reloj" src="modules/<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
/images/loading.gif" border="0" alt=""></div>
            <div align="center" style="font-weight: bold;" id="login_msg_espera"><?php echo $_smarty_tpl->tpl_vars['MSG_ESPERA']->value;?>
</div>
            <div align="center" id="login_msg_error" style="color: #ff0000;"></div>
          </td>
        </tr>
        <tr>
          <td width="40%">
              <div align="right" id="label_agent_user"><?php echo $_smarty_tpl->tpl_vars['USERNAME']->value;?>
:</div>
              <div align="right" id="label_extension_callback"><?php echo $_smarty_tpl->tpl_vars['CALLBACK_EXTENSION']->value;?>
:</div>
          </td>
          <td width="60%">
                <select align="center" id="input_agent_user" name="input_agent_user">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['LISTA_AGENTES']->value,'selected'=>$_smarty_tpl->tpl_vars['ID_AGENT']->value),$_smarty_tpl);?>

                </select>
                <select align="center" id="input_extension_callback" name="input_extension_callback">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['LISTA_EXTENSIONES_CALLBACK']->value,'selected'=>$_smarty_tpl->tpl_vars['ID_EXTENSION_CALLBACK']->value),$_smarty_tpl);?>

                </select>
          </td>
        </tr>
        <tr>
          <td width="40%">
              <div align="right" id="label_extension"><?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value;?>
:</div>
              <div align="right" id="label_password_callback"><?php echo $_smarty_tpl->tpl_vars['PASSWORD']->value;?>
:</div>
          </td>
          <td width="60%">
                <select align="center" name="input_extension" id="input_extension">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['LISTA_EXTENSIONES']->value,'selected'=>$_smarty_tpl->tpl_vars['ID_EXTENSION']->value),$_smarty_tpl);?>

                </select>
		<input type="password" name="input_password_callback" id="input_password_callback">
          </td>
        </tr>
<!-- Begin: CallbackLogin checkbox -->
	<tr id='callbackcheck'>
          <td width="40%">
              <div align="center"><?php echo $_smarty_tpl->tpl_vars['CALLBACK_LOGIN']->value;?>
:</div>
          </td>
          <td width="60%">               
	      <input type="checkbox" name="input_callback" id="input_callback">
          </td>
        </tr>
<!-- End: CallbackLogin checkbox -->
        <tr>
          <td colspan="2" align="center">
            <input type="button" id="submit_agent_login" name="submit_agent_login" value="<?php echo $_smarty_tpl->tpl_vars['LABEL_SUBMIT']->value;?>
" class="button" />
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<input type=hidden name=onlycallback id=onlycallback value="<?php echo $_smarty_tpl->tpl_vars['ONLY_CALLBACK']->value;?>
">

</form>

<?php if ($_smarty_tpl->tpl_vars['REANUDAR_VERIFICACION']->value) {
echo '<script'; ?>
 type="text/javascript">
do_checklogin();
<?php echo '</script'; ?>
>
<?php }
}
}
}
