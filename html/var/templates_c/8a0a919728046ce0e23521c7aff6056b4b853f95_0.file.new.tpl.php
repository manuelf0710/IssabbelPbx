<?php
/* Smarty version 3.1.33, created on 2022-12-22 14:02:23
  from '/var/www/html/modules/sec_letsencrypt/themes/default/new.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4a9bf52db40_45635163',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8a0a919728046ce0e23521c7aff6056b4b853f95' => 
    array (
      0 => '/var/www/html/modules/sec_letsencrypt/themes/default/new.tpl',
      1 => 1576169518,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4a9bf52db40_45635163 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['NO_HOSTNAME_NOTICE']->value != '') {?>
<br/>
<div class="alert alert-danger">
<?php echo $_smarty_tpl->tpl_vars['NO_HOSTNAME_NOTICE']->value;?>

</div>

<?php } else { ?>

<div class="box-header well span5">

<?php if ($_smarty_tpl->tpl_vars['valueemail']->value == '') {?>
    <h3><?php echo $_smarty_tpl->tpl_vars['INSTALLNEW']->value;?>
</h3>
<?php } else { ?>
       <div id="varstat" class="alert alert-success" align="center">
           <strong><?php echo $_smarty_tpl->tpl_vars['HASDATA']->value;?>
</strong>
       </div>
<?php }?>

<div class='row'>
<div class='col-md-6'>
    <label for="domain"><?php echo $_smarty_tpl->tpl_vars['DOMAIN']->value;?>
</label>
</div>
<div class='col-md-6'>
    <input type="text" placeholder="your.domain.com" id="domain" name="domain" class="text ui-widget-content ui-corner-all form-control col-md-6" value="<?php echo $_smarty_tpl->tpl_vars['valuedomain']->value;?>
"/>
</div>
</div>
<br/>
<div class='row'>
<div class='col-md-6'>
    <label for="email"><?php echo $_smarty_tpl->tpl_vars['EMAIL']->value;?>
</label>
</div>
<div class='col-md-6'>
<input type="text" placeholder="myemail@mycompany.com" id="email" name="email" class="text ui-widget-content ui-corner-all form-control col-md-6" value="<?php echo $_smarty_tpl->tpl_vars['valueemail']->value;?>
"/>
</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['valueemail']->value == '') {?>
<br/>
<div class='row'>
<div class='col-md-6'>
    <label for="staging"><?php echo $_smarty_tpl->tpl_vars['STAGING']->value;?>
</label>
</div>
<div class='col-md-6'>
<input type="checkbox" name="staging" value="--test-cert" id="staging" />
</div>
</div>
<?php }?>
<br/>

<?php if ($_smarty_tpl->tpl_vars['valueemail']->value == '') {?>
    <input name="btninstall" type="submit" id="btninstall" value="<?php echo $_smarty_tpl->tpl_vars['INSTALL']->value;?>
" class="btn btn-primary" />
<?php }?>

</div>

<div id="loading1"></div>
<div id="output"></div>

<?php if ($_smarty_tpl->tpl_vars['valueemail']->value != '') {?>
    <div class="box-header well span5" data-original-title>
        <h3><?php echo $_smarty_tpl->tpl_vars['RENEWCERT']->value;?>
</h3>
        <input name="btnrenew" id="btnrenew" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['RENEW']->value;?>
" class="btn btn-primary" />
    </div>
<?php }?>

<div class="box-header well span5" data-original-title>
    <h3><?php echo $_smarty_tpl->tpl_vars['USAGE']->value;?>
:</h3>
        <ul class="list-group">
            <li class="list-group-item list-group-item-danger"><?php echo $_smarty_tpl->tpl_vars['STEP1']->value;?>
</li>
            <li class="list-group-item list-group-item-danger"><?php echo $_smarty_tpl->tpl_vars['STEP2']->value;?>
</li>
            <li class="list-group-item list-group-item-danger"><?php echo $_smarty_tpl->tpl_vars['STEP3']->value;?>
</li>
            <li class="list-group-item list-group-item-danger"><?php echo $_smarty_tpl->tpl_vars['STEP4']->value;?>
</li>
            <li class="list-group-item list-group-item-danger"><?php echo $_smarty_tpl->tpl_vars['STEP5']->value;?>
</li>
            <li class="list-group-item list-group-item-success"><?php echo $_smarty_tpl->tpl_vars['STEP6']->value;?>
</li>
            <li class="list-group-item list-group-item-warning"><?php echo $_smarty_tpl->tpl_vars['STEP7']->value;?>
</li>
            <li class="list-group-item list-group-item-success"><?php echo $_smarty_tpl->tpl_vars['STEP8']->value;?>
</li>
            <li class="list-group-item list-group-item-success"><?php echo $_smarty_tpl->tpl_vars['STEP9']->value;?>
</li>
            <li class="list-group-item list-group-item-success"><?php echo $_smarty_tpl->tpl_vars['STEP10']->value;?>
</li>
            <li class="list-group-item list-group-item-warning"><?php echo $_smarty_tpl->tpl_vars['STEP11']->value;?>
</li>
        </ul>
</div>
<?php }
}
}
