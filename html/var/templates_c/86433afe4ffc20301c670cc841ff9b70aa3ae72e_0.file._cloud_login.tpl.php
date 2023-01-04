<?php
/* Smarty version 3.1.33, created on 2022-12-13 13:40:45
  from '/var/www/html/modules/registration/themes/default/_cloud_login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6398c72d188138_27369674',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '86433afe4ffc20301c670cc841ff9b70aa3ae72e' => 
    array (
      0 => '/var/www/html/modules/registration/themes/default/_cloud_login.tpl',
      1 => 1578493345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6398c72d188138_27369674 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
/themes/default/css/styles.css" rel="stylesheet" />
<div onKeyPress="return checkSubmit(event)">
<div id="moduleContainer">
    
    <div class="div_content_style">
    <div class="title_login_register"><?php echo $_smarty_tpl->tpl_vars['registration_server']->value;?>
</div>
    <div class="text_info_registration">
        <?php echo $_smarty_tpl->tpl_vars['INFO_REGISTER']->value;?>

        <div class="close_info" onclick="hideInfoRegistration()">x</div>
    </div>
	
    <div class="info_registration" onclick="showInfoRegistration()">?</div>
        <div id='cloud-login-content'>
           <div id="cloud-login-logo">
                <img src="modules/<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
/images/issabel_logo_mini.png" alt="issabel log" />
            </div>
            <div class="cloud-login-line">
                <img src="modules/<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
/images/icon_user.png" height="18px" alt="issabel log" class="cloud-login-img-input"/>
                <input type="text" id="input_user" name="input_user" class="cloud-login-input" defaultVal="<?php echo $_smarty_tpl->tpl_vars['EMAIL']->value;?>
"/>
            </div>
            <div class="cloud-login-line">
                <img src="modules/<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
/images/icon_password.png" alt="issabel log" class="cloud-login-img-input"/>
                <input type="password" id="input_pass" name="input_pass" class="cloud-login-input" defaultVal="<?php echo $_smarty_tpl->tpl_vars['PASSWORD']->value;?>
"/>
            </div>
            <div class="cloud-login-line action_register_button" >                
                <input type="button" name="input_signup" class="cloud-signup-button" onclick="showPopupCloudRegister('<?php echo $_smarty_tpl->tpl_vars['registration']->value;?>
',540,405)" value="<?php echo $_smarty_tpl->tpl_vars['SIGNUP_ACTION']->value;?>
" style="margin-left:20px" />
                <input type="button" name="input_register" class="cloud-login-button" onclick="registrationByAccount();" value="<?php echo $_smarty_tpl->tpl_vars['REGISTER_ACTION']->value;?>
"/>
                <input type="hidden" name="msgtmp" id="msgtmp" value="<?php echo $_smarty_tpl->tpl_vars['sending']->value;?>
" />
            </div>
            <div class="cloud-login-line" >
                <a class="cloud-link_subscription" href="https://my.issabel.com/forgot.php" ><?php echo $_smarty_tpl->tpl_vars['FORGET_PASSWORD']->value;?>
</a>
            </div>
            <div class="cloud-login-line" >
                <?php echo $_smarty_tpl->tpl_vars['REGISTER_RECOMMENDATION']->value;?>

            </div>
            <div class="cloud-login-line" >
                <?php echo $_smarty_tpl->tpl_vars['PATREON']->value;?>

            </div>
            <div id="msnTextErr" align="center"></div>
            
            <div class="cloud-footernote"><a href="http://www.issabel.org" style="text-decoration: none;" target='_blank'>Issabel</a> <?php echo $_smarty_tpl->tpl_vars['ISSABEL_LICENSED']->value;?>
 <a href="http://www.opensource.org/licenses/gpl-license.php" style="text-decoration: none;" target='_blank'>GPL</a>. 2006 - <?php echo $_smarty_tpl->tpl_vars['currentyear']->value;?>
.</div>
             
        </div>
    </div>
</div>
</div>

<?php echo '<script'; ?>
 src="modules/<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
/themes/default/js/javascript.js" type="text/javascript"><?php echo '</script'; ?>
>



<?php }
}
