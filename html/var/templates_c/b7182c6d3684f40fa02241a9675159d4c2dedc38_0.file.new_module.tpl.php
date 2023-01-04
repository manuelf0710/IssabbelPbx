<?php
/* Smarty version 3.1.33, created on 2022-12-12 12:13:09
  from '/var/www/html/modules/build_module/themes/default/new_module.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63976125998621_46061176',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7182c6d3684f40fa02241a9675159d4c2dedc38' => 
    array (
      0 => '/var/www/html/modules/build_module/themes/default/new_module.tpl',
      1 => 1334865417,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63976125998621_46061176 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/usr/share/php/Smarty/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<div id='error' name='error'></div>
<div>
<table width="99%" cellspacing="0" cellpadding="4" align="center">
    <tr>
        <td align="left"><input  id="save" class="button" type="button" name="save" value="<?php echo $_smarty_tpl->tpl_vars['SAVE']->value;?>
" onclick="save_module()"></td>
        <td align="right" nowrap><span class="letra12"><span  class="required">*</span> <?php echo $_smarty_tpl->tpl_vars['REQUIRED_FIELD']->value;?>
</span></td>
    </tr>
</table>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr class="moduleTitle">
    <td class="moduleTitle" valign="middle"><?php echo $_smarty_tpl->tpl_vars['general_information']->value;?>
</td>
  </tr>
  <tr>
    <td>
      <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
         <td align="left" width="17%"><b><?php echo $_smarty_tpl->tpl_vars['module_name_label']->value;?>
: <span  class="required">*</span></b></td>
         <td align="left" width="22%"><input type='text' name='module_name' id='module_name' value='' onkeyup='generateId(this,"id_module")'></td>
	 <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['your_name_label']->value;?>
: <span  class="required">*</span></b></td>
         <td align="left"><input type='text' name='your_name' id='your_name' value=''></td>
	 <td rowspan="2" align="left" valign="top"><b><?php echo $_smarty_tpl->tpl_vars['group_permissions']->value['LABEL'];?>
:</b></td>
         <td rowspan="2" align="left">
            <select id='group_permissions' name='group_permissions' multiple='multiple' size='3'>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrGroups']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['value']->value == 'administrator') {?>
                        <option value='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
' selected="selected"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
                    <?php } else { ?>
                        <option value='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
         </td>
        
    </tr>
    <tr class="letra12">
	<td align="left"><b><?php echo $_smarty_tpl->tpl_vars['id_module_label']->value;?>
:</b></td>
        <td align="left"><b><i id='id_module'></i></b></td>
	<td align="left"><b><?php echo $_smarty_tpl->tpl_vars['email']->value;?>
: <span  class="required">*</span></b></td>
        <td align="left"><input type='text' name='email_module' id='email_module' value=''></td>

    </tr>
  </table>
  </td>
</tr>
</table>
<br/>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr class="moduleTitle">
    <td class="moduleTitle" valign="middle"><?php echo $_smarty_tpl->tpl_vars['location']->value;?>
</td>
  </tr>
  <tr>
    <td>
       <table class="tabForm" style="font-size: 16px;" width="100%" >
        <tr class="letra12">
          <td width="17%" align="left"><b><?php echo $_smarty_tpl->tpl_vars['module_level']->value;?>
: <span  class="required">*</span></b></td>
          <td align="left">
             <select id='module_level_options' name='module_level_options' onchange='mostrar_menu()'>
                <option value='level_2' ><?php echo $_smarty_tpl->tpl_vars['level_2']->value;?>
</option>
                <option value='level_3' ><?php echo $_smarty_tpl->tpl_vars['level_3']->value;?>
</option>
             </select>
          </td>
          <td width=10<?php echo '%>';?></td>
          <td></td>
          <td></td>
        </tr>

        <tr class="letra12">
          <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['parent_1_exists']->value;?>
: <span  class="required">*</span></b></td>
          <td align="left" width="22%">
             <select id='parent_1_existing_option' name='parent_1_existing_option' onchange='mostrar_menu()'>
                <option value='<?php echo $_smarty_tpl->tpl_vars['peYes']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['peYes']->value;?>
</option>
                <option value='<?php echo $_smarty_tpl->tpl_vars['peNo']->value;?>
' selected="selected"><?php echo $_smarty_tpl->tpl_vars['peNo']->value;?>
</option>
            </select>
          </td>
          <td align="left" id='label_level2' width="14%"></td>
          <td align="left" id='level2_exist'></td>
       </tr>

       <tr class="letra12" id='parent_menu_1'>
          <td align='left'><b><?php echo $_smarty_tpl->tpl_vars['level_1_parent_name']->value;?>
: <span  class='required'>*</span></b></td>
          <td align='left' width="22%"><input type='text' name='parent_1_name' id='parent_1_name' value='' onkeyup='generateId(this,"parent_1_id")'></td>
          <td align='left' width="11%"><b><?php echo $_smarty_tpl->tpl_vars['level_1_parent_id']->value;?>
: </b></td>
          <td align='left'><i id='parent_1_id'></i></td>
       </tr>

       <tr class="letra12" id='parent_menu_2'></tr>
     </table>
    </td>
   </tr>
</table>
<br/>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr class="moduleTitle">
    <td class="moduleTitle" valign="middle"><?php echo $_smarty_tpl->tpl_vars['module_description']->value;?>
</td>
  </tr>
  <tr>
    <td>
       <table class="tabForm" style="font-size: 16px;" width="100%">
     
       <tr class="letra12">
        <td width="17%" align="left"><b><?php echo $_smarty_tpl->tpl_vars['module_type']->value;?>
: <span  class="required">*</span></b></td>
        <td width="15%" align="left">
            <select id='module_type' name='module_type' onchange="show_field_to_create()">
                <option value='form' ><?php echo $_smarty_tpl->tpl_vars['type_form']->value;?>
</option>
                <option value='grid' ><?php echo $_smarty_tpl->tpl_vars['type_grid']->value;?>
</option>
                <option value='framed' ><?php echo $_smarty_tpl->tpl_vars['type_framed']->value;?>
</option>
            </select>
        </td>
        <td width="15%" align="left" id="field_name" ><?php echo $_smarty_tpl->tpl_vars['Field_Name']->value;?>
: <span class="required">*</span></td>
        <td align="left" id="url" style="display:none;" width="35%"><b><?php echo $_smarty_tpl->tpl_vars['Url']->value;?>
: <span class="required">*</span></b></td>
        <td width="15%" align="left" id="v_item" ><input name="valor_item" id="valor_item" value="" type="text" size="15"></td>
        <td width="50%" align="left" id="v_url" style="display:none;"><input name="valor_url" id="valor_url" value="" type="text" size="25"></td>
        <td width="8%" align="left"><input class="button" name="add" id ="add" value=">>" onclick="javascript:agregar_item();" type="button"></td>
       <td rowspan="2"><select name="items" size="4" id="items" style="width: 120px;">
                    </select>
      <input type="hidden" id="select_items" name="select_items">
      </td>
      </tr>
      <tr class="letra12">
	<td width="5%"></td>
	<td width="5%"></td>
	<td width="5%" align="left"><span id="label_type"><?php echo $_smarty_tpl->tpl_vars['Type_Field']->value;?>
:</span></td>
	<td width="5%" align="left">
                   <select name="type" onclick="" id="type_field" style="width: 130px;">
                       <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['option_type']->value['VALUE'],'output'=>$_smarty_tpl->tpl_vars['option_type']->value['NAME'],'selected'=>$_smarty_tpl->tpl_vars['option_type']->value['SELECTED']),$_smarty_tpl);?>

                   </select></td>
	<td width="5%" align="left"><input class="button" name="remove" id="remove" value="<<" onclick="javascript:quitar_item();" type="button"></td>
    </tr> 

    </table>
   </td>
  </tr>
</table>
</div><?php }
}
