<?php
/* Smarty version 3.1.33, created on 2022-12-12 11:29:45
  from '/var/www/html/modules/dashboard/applets/SystemResources/tpl/system_resources.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_639756f93bf7f7_47442334',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '18696a3387939bd825a7ad5543d30d9e58af4d38' => 
    array (
      0 => '/var/www/html/modules/dashboard/applets/SystemResources/tpl/system_resources.tpl',
      1 => 1575122672,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639756f93bf7f7_47442334 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" media="screen" type="text/css" href="modules/<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
/applets/SystemResources/tpl/css/styles.css" />
<?php echo '<script'; ?>
 type='text/javascript' src='modules/<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
/applets/SystemResources/js/javascript.js'><?php echo '</script'; ?>
>
<div style='height:165px; position:relative; text-align:center;'>
    <div style='width:152px; float:left; position: relative;' id='cpugauge'>
        <div id="dashboard-applet-cpugauge" style="width:140px; height:140px"></div>
        <input type="hidden" name="cpugauge_value" id="cpugauge_value" value="<?php echo $_smarty_tpl->tpl_vars['cpugauge']->value['fraction'];?>
" />
        <input type="hidden" name="cpugauge_label" id="cpugauge_label" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LABEL_CPU']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
    </div>
    <div style='width:152px; float:left; position: relative;' id='memgauge'>
        <div id="dashboard-applet-memgauge" style="width:140px; height:140px"></div>
        <input type="hidden" name="memgauge_value" id="memgauge_value" value="<?php echo $_smarty_tpl->tpl_vars['memgauge']->value['fraction'];?>
" />
        <input type="hidden" name="memgauge_label" id="memgauge_label" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LABEL_RAM']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
    </div>
    <div style='width:152px; float:right; position: relative;' id='swapgauge'>
        <div id="dashboard-applet-swapgauge" style="width:140px; height:140px"></div>
        <input type="hidden" name="swapgauge_value" id="swapgauge_value" value="<?php echo $_smarty_tpl->tpl_vars['swapgauge']->value['fraction'];?>
" />
        <input type="hidden" name="swapgauge_label" id="swapgauge_label" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LABEL_SWAP']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
    </div>
</div>
<div class='neo-divisor'></div>
<div class=neo-applet-tline>
    <div class='neo-applet-titem'><strong><?php echo $_smarty_tpl->tpl_vars['LABEL_CPUINFO']->value;?>
:</strong></div>
    <div class='neo-applet-tdesc'><?php echo $_smarty_tpl->tpl_vars['cpu_info']->value;?>
</div>
</div>
<div class=neo-applet-tline>
    <div class='neo-applet-titem'><strong><?php echo $_smarty_tpl->tpl_vars['LABEL_UPTIME']->value;?>
:</strong></div>
    <div class='neo-applet-tdesc'><?php echo $_smarty_tpl->tpl_vars['uptime']->value;?>
</div>
</div>
<div class='neo-applet-tline'>
    <div class='neo-applet-titem'><strong><?php echo $_smarty_tpl->tpl_vars['LABEL_CPUSPEED']->value;?>
:</strong></div>
    <div class='neo-applet-tdesc'><?php echo $_smarty_tpl->tpl_vars['speed']->value;?>
</div>
</div>
<div class='neo-applet-tline'>
    <div class='neo-applet-titem'><strong><?php echo $_smarty_tpl->tpl_vars['LABEL_MEMORYUSE']->value;?>
:</strong></div>
    <div class='neo-applet-tdesc'>RAM: <?php echo $_smarty_tpl->tpl_vars['memtotal']->value;?>
 SWAP: <?php echo $_smarty_tpl->tpl_vars['swaptotal']->value;?>
</div>
</div>
<?php }
}
