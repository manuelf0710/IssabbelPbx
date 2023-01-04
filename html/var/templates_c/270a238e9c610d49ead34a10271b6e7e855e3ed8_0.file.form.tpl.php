<?php
/* Smarty version 3.1.33, created on 2022-12-22 14:00:08
  from '/var/www/html/modules/recordings/themes/default/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4a9384d1093_96831754',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '270a238e9c610d49ead34a10271b6e7e855e3ed8' => 
    array (
      0 => '/var/www/html/modules/recordings/themes/default/form.tpl',
      1 => 1575572864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4a9384d1093_96831754 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="99%" border="0" cellspacing="0" cellpadding="4" align="center">
    <tr>
        <td align="left" colspan='2'><input class="button" type="submit" name="save" value="<?php echo $_smarty_tpl->tpl_vars['SAVE']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['DISABLED']->value;?>
/></td>
    </tr>
    <tr>
        <table class="tabForm" style="font-size: 16px;" width="100%" border='0'>
            <tr class="letra12">
                <td colspan='2'>
                    <input type="radio" name="option_record" id="record_by_phone" value="by_record" <?php echo $_smarty_tpl->tpl_vars['check_record']->value;?>
 onclick="Activate_Option_Record()" />
                    <?php echo $_smarty_tpl->tpl_vars['record']->value;?>
 &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="option_record" id="record_by_file" value="by_file" <?php echo $_smarty_tpl->tpl_vars['check_file']->value;?>
 onclick="Activate_Option_Record()" />
                    <?php echo $_smarty_tpl->tpl_vars['file_upload']->value;?>

                </td>
            </tr>
            <tr class="letra12" id='record_option'>
                <td align="left" width='13%'><b><?php echo $_smarty_tpl->tpl_vars['recording_name_Label']->value;?>
</b></td>
                <td align="left">
                    <input size='30' name="recording_name" id="recording_name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['filename']->value;?>
" />&nbsp;[.gsm|.wav] &nbsp;&nbsp;
                    <input class="button" title=<?php echo $_smarty_tpl->tpl_vars['record']->value;?>
 type="submit" name="record" id="record" value="<?php echo $_smarty_tpl->tpl_vars['record']->value;?>
"  <?php echo $_smarty_tpl->tpl_vars['DISABLED']->value;?>
/>
                </td>
            </tr>
            <tr class="letra12" id='upload_option'>
                <td align="left" width='13%'><b><?php echo $_smarty_tpl->tpl_vars['record_Label']->value;?>
</b></td>
                <td align="left">
                    <input name="file_record" id="file_record" type="file" value="<?php echo $_smarty_tpl->tpl_vars['file_record_name']->value;?>
" size='30' <?php echo $_smarty_tpl->tpl_vars['DISABLED']->value;?>
/>
                </td>
            </tr>
        </table>
    </tr>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabForm" id="info">
	<tr><td><i><?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
</i></td></tr>
	<tr><td><i><?php echo $_smarty_tpl->tpl_vars['INFO']->value;?>
</i></td></tr>
    </table>
</table>
<input type='hidden' name='filename' value='<?php echo $_smarty_tpl->tpl_vars['filename']->value;?>
' />


    <?php echo '<script'; ?>
 type="text/javascript">
        Activate_Option_Record();

        function Activate_Option_Record()
        {
            var record_by_phone = document.getElementById('record_by_phone');
            var record_by_file = document.getElementById('record_by_file');
            if(record_by_phone.checked==true)
            {
                document.getElementById('record_option').style.display = '';
		document.getElementById('info').style.display = '';
                document.getElementById('upload_option').style.display = 'none';
            }
            else
            {
                document.getElementById('record_option').style.display = 'none';
		document.getElementById('info').style.display = 'none';
                document.getElementById('upload_option').style.display = '';
            }
        }
    <?php echo '</script'; ?>
>
<?php }
}
