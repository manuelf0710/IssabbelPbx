<?php
/* Smarty version 3.1.33, created on 2022-12-22 14:03:15
  from '/var/www/html/modules/calendar/themes/default/calendar_gui.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4a9f3285161_03712293',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54fda4e4314987752970f33254e91d207ff4bfa3' => 
    array (
      0 => '/var/www/html/modules/calendar/themes/default/calendar_gui.tpl',
      1 => 1576847322,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4a9f3285161_03712293 (Smarty_Internal_Template $_smarty_tpl) {
?><form  method='POST' style='margin-bottom:0;' name='formCalendar' id='formCalendar'>
<br />
<table class="tabForm" width="100%"><tr>
	<td id="calendar_toolbar" width="10%" align="left" valign="top">
	    <div id="calendar_buttonbox" style="margin: 0px 10px 6px 10px; text-align: center;" valign="middle">
	        <button type='button' class='button' id="calendar_newevent" ><i class="fa fa-plus"></i>&nbsp;<?php echo $_smarty_tpl->tpl_vars['LBL_CREATE_EVENT']->value;?>
</button>
	    </div>
	    <div id="calendar_datepick">
	    </div>
	    <div id="calendar_ical_links" class="ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
            <div class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all title_size"><?php echo $_smarty_tpl->tpl_vars['LBL_EXPORT_CALENDAR']->value;?>
</div>
            <div class="content_ical">
                <a href="/rest.php/<?php echo $_smarty_tpl->tpl_vars['module_name']->value;?>
/CalendarEvent?format=ical">
                    <span><i class="fa fa-download"></i>&nbsp;<?php echo $_smarty_tpl->tpl_vars['LBL_LINK_ICAL']->value;?>
</span>
                </a>
            </div>
	    </div>
	</td>
	<td align="right" width="90%">
	   <div id="calendar_main"></div>
	</td>
</tr></table>
<input type="hidden" name="server_year" value="<?php echo $_smarty_tpl->tpl_vars['SERVER_YEAR']->value;?>
" />
<input type="hidden" name="server_month" value="<?php echo $_smarty_tpl->tpl_vars['SERVER_MONTH']->value;?>
" />
<input type="hidden" name="event_id" value="<?php echo $_smarty_tpl->tpl_vars['EVENT_ID']->value;?>
" />
</form>

<div id="calendar_eventdialog" style="display: none;">
<?php echo $_smarty_tpl->tpl_vars['EVENT_DIALOG']->value;?>

</div>

<?php echo '<script'; ?>
 type="text/javascript">
var arrLang_main = <?php echo $_smarty_tpl->tpl_vars['ARRLANG_MAIN']->value;?>
;
<?php echo '</script'; ?>
>
<?php }
}
