<?php
/* Smarty version 3.1.33, created on 2022-12-14 11:17:42
  from '/var/www/html/modules/reportes/themes/default/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6399f726692bb7_82904079',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08079fceee526f1824ff28a90288263202bc689a' => 
    array (
      0 => '/var/www/html/modules/reportes/themes/default/form.tpl',
      1 => 1671034657,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6399f726692bb7_82904079 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/reportes/themes/css/reportes_module.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type='text/javascript' src="modules/reportes/themes/js/reportes_module.js"><?php echo '</script'; ?>
>
<section style="margin: 10px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
        <tr class="letra12">
            <?php if ($_smarty_tpl->tpl_vars['mode']->value == 'input') {?>
                <td align="left">
                    <!--<input class="button" type="submit" name="save_new" value="<?php echo $_smarty_tpl->tpl_vars['SAVE']->value;?>
">&nbsp;&nbsp; -->
                    <!--<input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
">-->
                </td>
            <?php } elseif ($_smarty_tpl->tpl_vars['mode']->value == 'view') {?>
                <td align="left">
                    <input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
">
                </td>
            <?php } elseif ($_smarty_tpl->tpl_vars['mode']->value == 'edit') {?>
                <td align="left">
                    <input class="button" type="submit" name="save_edit" value="<?php echo $_smarty_tpl->tpl_vars['EDIT']->value;?>
">&nbsp;&nbsp;
                    <input class="button" type="submit" name="cancel" value="<?php echo $_smarty_tpl->tpl_vars['CANCEL']->value;?>
">
                </td>
            <?php }?>
        </tr>
    </table>
    <table class="tabForm" style="font-size: 16px;" width="100%">
        <tr class="letra12">
            <td align="left" width="35%"><b><?php echo $_smarty_tpl->tpl_vars['criterio']->value['LABEL'];?>
: <span class="required">*</span></b></td>
            <td align="left"><?php echo $_smarty_tpl->tpl_vars['criterio']->value['INPUT'];?>

                <span class="letra12" style="margin-left:3em"><span class="required">*</span> <?php echo $_smarty_tpl->tpl_vars['REQUIRED_FIELD']->value;?>
</span>
                <!--<input class="button" type="submit" name="save_new" value="Aceptar">-->&nbsp;&nbsp;
            </td>
        </tr>

    </table>
    <input class="button" type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" />

    <?php if ($_smarty_tpl->tpl_vars['criterioActive']->value == 'eventos') {?>

        <fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
            <legend><span> Eventos </span> </legend>
            <table class="tabForm" cellpading="10" width="700" style="margin-top:2em">
                <tr class="letra12">
                    <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['fecha_inicial']->value['LABEL'];?>
: <span class="required">*</span></b></td>
                    <td align="left">
                        <!--<?php echo $_smarty_tpl->tpl_vars['fecha_inicial']->value['INPUT'];?>
-->
                        <input type="text" name="fecha_inicial" id="fecha_inicial" value="" class="calendar-reports">
                    </td>
                    <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['fecha_final']->value['LABEL'];?>
: <span class="required">*</span></b></td>
                    <td align="left">
                        <!--<?php echo $_smarty_tpl->tpl_vars['fecha_final']->value['INPUT'];?>
-->
                        <input type="text" name="fecha_final" id="fecha_final" value="" class="calendar-reports">
                    </td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['id_evento']->value['LABEL'];?>
: <span class="required">*</span></b></td>
                    <td align="left"><?php echo $_smarty_tpl->tpl_vars['id_evento']->value['INPUT'];?>
</td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['tipo_evento']->value['LABEL'];?>
: <span class="required">*</span></b></td>
                    <td align="left"><?php echo $_smarty_tpl->tpl_vars['tipo_evento']->value['INPUT'];?>
</td>
                </tr>
                <tr class="letra12">
                    <td align="left"></td>
                    <td align="left"></td>
                    <td align="left"><input class="button" type="submit" name="save_new" value="Aceptar"></td>
                </tr>

            </table>
        </fieldset>



    <?php }?>



    <?php if ($_smarty_tpl->tpl_vars['criterioActive']->value == 'otros') {?>
        <fieldset style="border-radius: 5px; padding: 5px; min-height:150px;">
            <legend><span> Otros </span> </legend>
            <table class="tabForm" cellpading="10" width="700" style="margin-top:2em">
                <tr class="letra12">
                    <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['nus']->value['LABEL'];?>
: </b></td>
                    <td align="left"><?php echo $_smarty_tpl->tpl_vars['nus']->value['INPUT'];?>
</td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['telefono']->value['LABEL'];?>
: </b></td>
                    <td align="left"><?php echo $_smarty_tpl->tpl_vars['telefono']->value['INPUT'];?>
</td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['fecha_llamada']->value['LABEL'];?>
: </b></td>
                    <td align="left"><?php echo $_smarty_tpl->tpl_vars['fecha_llamada']->value['INPUT'];?>
</td>
                </tr>
                <tr class="letra12">
                    <td align="left"><b><?php echo $_smarty_tpl->tpl_vars['id_evento']->value['LABEL'];?>
: </b></td>
                    <td align="left"><?php echo $_smarty_tpl->tpl_vars['id_evento']->value['INPUT'];?>
</td>
                </tr>
                <tr class="letra12">
                    <td align="left"></td>
                    <td align="left"></td>
                    <td align="left"><input class="button" type="submit" name="save_new" value="Aceptar"></td>
                </tr>
            </table>
        </fieldset>
<?php }
}
}
