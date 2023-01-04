<?php
/* Smarty version 3.1.33, created on 2022-12-29 12:33:04
  from '/var/www/html/themes/tenant/_common/help.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63adcf5004e697_86984312',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1dd3b7cbd47b9542234e0dc83c4995298a552a4c' => 
    array (
      0 => '/var/www/html/themes/tenant/_common/help.tpl',
      1 => 1578493345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63adcf5004e697_86984312 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
  <title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
  <head>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['WEBPATH']->value;?>
themes/<?php echo $_smarty_tpl->tpl_vars['THEMENAME']->value;?>
/help.css" />
  </head>
  <frameset cols="20%,80%" border="1" > 
    <frame src="frameLeft.php?id_nodo=<?php echo $_smarty_tpl->tpl_vars['id_nodo']->value;?>
" name="navegacion" noresize>
    <frame src="frameRight.php?id_nodo=<?php echo $_smarty_tpl->tpl_vars['id_nodo']->value;?>
&name_nodo=<?php echo $_smarty_tpl->tpl_vars['name_nodo']->value;?>
" name="contenido" class="mainHelp" noresize>
  </frameset>
</html>
<?php }
}
