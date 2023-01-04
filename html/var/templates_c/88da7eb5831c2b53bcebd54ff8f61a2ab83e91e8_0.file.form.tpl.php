<?php
/* Smarty version 3.1.33, created on 2022-12-12 15:10:53
  from '/var/www/html/modules/client/themes/default/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63978acd695f27_02241383',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '88da7eb5831c2b53bcebd54ff8f61a2ab83e91e8' => 
    array (
      0 => '/var/www/html/modules/client/themes/default/form.tpl',
      1 => 1575212159,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63978acd695f27_02241383 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="modules/<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
/libs/js/base.js"><?php echo '</script'; ?>
>
<table width="100%" cellpadding="1" cellspacing="1" height="100%" border=0>
<?php if (!$_smarty_tpl->tpl_vars['FRAMEWORK_TIENE_TITULO_MODULO']->value) {?>
    <tr class="moduleTitle">
        <td colspan="4" class="moduleTitle" align="left">
            <img src="<?php echo $_smarty_tpl->tpl_vars['icon']->value;?>
" border="0" align="absmiddle" />&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['title']->value;?>

        </td>
    </tr>
<?php }?>
    <tr>
        <td>
            <form style='margin-bottom:0;' method="post" action="?menu=<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" enctype="multipart/form-data">
            <table align='left' border="0" class="filterForm" cellspacing="0" cellpadding="0" width="100%">
                <tr><td class="letra12" colspan="2"><b><?php echo $_smarty_tpl->tpl_vars['LABEL_MESSAGE']->value;?>
</b></td></tr>
                <tr>
                    <td class="letra12" align="right" width="20%"><b><?php echo $_smarty_tpl->tpl_vars['File']->value;?>
:</b></td>
                    <td align='left'><input name="fileCRM" type="file" /></td>
                </tr>
                <tr>
                    <td align='left' colspan="2"><input class='button' type = 'submit' name='cargar_datos' value='<?php echo $_smarty_tpl->tpl_vars['ETIQUETA_SUBMIT']->value;?>
' onClick="return validarFile(this.form.fileCRM.value)" /></td>
                </tr>
                <tr>
                	<td class="letra12" align='left'><b><?php echo $_smarty_tpl->tpl_vars['Format_File']->value;?>
:</b></td>
                	<td class="letra12" align='left'><?php echo $_smarty_tpl->tpl_vars['Format_Content']->value;?>
</td>
               	</tr>
               	<tr>
               		<td class="letra12" align='left' colspan="2"><b><a href="?menu=<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
&amp;rawmode=yes&amp;action=csvdownload"><?php echo $_smarty_tpl->tpl_vars['ETIQUETA_DOWNLOAD']->value;?>
&nbsp;&raquo;</a></b></tr>
               	</tr>
            </table>
            </form>
        </td>
    </tr>
</table>

<?php }
}
