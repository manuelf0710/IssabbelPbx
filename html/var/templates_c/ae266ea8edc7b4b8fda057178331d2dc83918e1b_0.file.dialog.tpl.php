<?php
/* Smarty version 3.1.33, created on 2022-12-22 14:00:11
  from '/var/www/html/modules/endpoint_configurator/dialogs/standard/tpl/dialog.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_63a4a93b5908c9_10872941',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae266ea8edc7b4b8fda057178331d2dc83918e1b' => 
    array (
      0 => '/var/www/html/modules/endpoint_configurator/dialogs/standard/tpl/dialog.tpl',
      1 => 1575123453,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a4a93b5908c9_10872941 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/x-handlebars" data-template-name="endpointconfig-standard">
    <ul>
        <li><a href="#endpointconfig-standard-information"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TITLE_INFORMATION']->value;?>
</a></li>
        <li><a href="#endpointconfig-standard-accounts"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TITLE_ACCOUNTS']->value;?>
</a></li>
        <li><a href="#endpointconfig-standard-network"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TITLE_NETWORK']->value;?>
</a></li>
        <li><a href="#endpointconfig-standard-credentials"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TITLE_CREDENTIALS']->value;?>
</a></li>
        <li><a href="#endpointconfig-standard-endpointproperties"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TITLE_PROPERTIES']->value;?>
</a></li>
    </ul>
    <div id="endpointconfig-standard-information">
        <table border="0">
            <tbody>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_MANUFACTURER']->value;?>
:</b></td><td>{{name_manufacturer}}</td></tr>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_MODEL']->value;?>
:</b></td><td>{{#if modelObj.name_model}}{{modelObj.name_model}} ({{modelObj.description}}){{else}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_UNKNOWN_MODEL']->value;?>
{{/if}}</td></tr>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_MAX_SIP_ACCOUNTS']->value;?>
:</b></td><td>{{#if details}}{{details.max_sip_accounts}}{{else}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_UNKNOWN']->value;?>
{{/if}}</td></tr>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_MAX_IAX2_ACCOUNTS']->value;?>
:</b></td><td>{{#if details}}{{details.max_iax2_accounts}}{{else}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_UNKNOWN']->value;?>
{{/if}}</td></tr>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_MAC']->value;?>
:</b></td><td>{{mac_address}}</td></tr>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_CURRENT_IP']->value;?>
:</b></td><td>{{#if last_known_ipv4 }}{{last_known_ipv4}}{{else}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_UNKNOWN']->value;?>
{{/if}}</td></tr>
                <tr title="<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TOOLTIP_DYNIP']->value;?>
"><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_DYNIP']->value;?>
:</b></td><td>{{#if modelObj}}{{#if modelObj.dynamic_ip_supported}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_YES']->value;?>
{{else}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_NO']->value;?>
{{/if}}{{else}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_UNKNOWN']->value;?>
{{/if}}</td></tr>
                <tr title="<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TOOLTIP_STATICIP']->value;?>
"><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_STATICIP']->value;?>
:</b></td><td>{{#if modelObj}}{{#if modelObj.static_ip_supported}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_YES']->value;?>
{{else}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_NO']->value;?>
{{/if}}{{else}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_UNKNOWN']->value;?>
{{/if}}</td></tr>
                <tr title="<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TOOLTIP_VLAN']->value;?>
"><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_VLAN']->value;?>
:</b></td><td>(unimplemented in DB)</td></tr>
                <tr title="<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TOOLTIP_STATICPROV']->value;?>
"><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_STATICPROV']->value;?>
:</b></td><td>{{#if modelObj}}{{#if modelObj.static_prov_supported}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_YES']->value;?>
{{else}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_NO']->value;?>
{{/if}}{{else}}<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_UNKNOWN']->value;?>
{{/if}}</td></tr>
            </tbody>
        </table>
    </div>
    <div id="endpointconfig-standard-accounts">
        <table border="0" width="100%">
        <thead>
            <tr>
                <th><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_UNASSIGNED_ACCOUNTS']->value;?>
 ({{App.accountsController.length}})</th>
                <th><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_ASSIGNED_ACCOUNTS']->value;?>
 ({{details.accountsController.length}})</th>
            </tr>
        </thead>
        <tbody><tr>
        
        <td valign="top" width="50%">
            {{#view App.StandardUnboundAccountsView controllerBinding="App.accountsController"}}
            {{#each controller}}
                <li {{bindAttr id="idattr"}} {{action "selectAccount" this }} >
                    {{#if priority}}{{priority}}: {{/if}}{{tech}}/{{account}} ({{extension}}) - {{description}}
                    {{#if registerip}}<br/><span title="<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TOOLTIP_REGISTERED']->value;?>
" style="color: red"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_REGISTERED_AT']->value;?>
: {{registerip}}</span>{{/if}}
                </li>
            {{/each}}
            {{/view}}
        </td>
        <td valign="top" >
            <table border="0" width="100%"><tbody><tr><td>
            {{#view App.StandardBoundAccountsView controllerBinding="details.accountsController"}}
            {{#each controller}}
                <li {{bindAttr id="idattr"}} {{action "selectAccount" this }} >
                    {{#if priority}}{{priority}}: {{/if}}{{tech}}/{{account}} ({{extension}}) - {{description}}
                    {{#if registerip}}<br/><span title="<?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TOOLTIP_REGISTERED']->value;?>
" style="color: red"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_REGISTERED_AT']->value;?>
: {{registerip}}</span>{{/if}}
                </li>
            {{/each}}
            {{/view}}
            </td></tr>
            <tr><td>
            {{#if details.accountsController.selectedAccount}}
                {{#with details.accountsController.selectedAccount}}
                <b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_PROPERTIES']->value;?>
 {{tech}}/{{account}} ({{extension}}) - {{description}}</b>
                {{view App.EndpointconfigPropertylistView controllerBinding="propertiesController" }}
                {{/with}}
            {{else}}
                <?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_NOACCOUNTS']->value;?>

            {{/if}}
            </td></tr>
            </tbody></table>
        </td>
        
        </tr>
        </tbody></table>
    </div>
    <div id="endpointconfig-standard-network">
        {{#view App.NetworkTypeView controllerBinding="controller" }}
            <input value="1" id="networktype-isDHCP" type="radio" name="networktype" {{action "setDHCP" on="change"}} {{bindAttr checked="isDHCP"}} />
            <label for="networktype-isDHCP"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_DYNIP']->value;?>
</label>
            <input value="0" id="networktype-isStatic" type="radio" name="networktype" {{action "setStatic" on="change"}} {{bindAttr checked="isStatic"}} />
            <label for="networktype-isStatic"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_STATICIP']->value;?>
</label>
        {{/view}}
        {{#if isStatic}}
        <fieldset class="ui-corner-all">
            <legend><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_STATIC_NETATTR']->value;?>
:</legend>
            <table border="0">
            <tbody>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_STATIC_IP']->value;?>
:</b></td><td>{{view Ember.TextField placeholderBinding="last_known_ipv4" pattern="^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$" valueBinding="details.static_ip"}}</td></tr>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_STATIC_NETMASK']->value;?>
:</b></td><td>{{view Ember.TextField placeholder="255.255.255.0" pattern="^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$" valueBinding="details.static_mask"}}</td></tr>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_STATIC_GW']->value;?>
:</b></td><td>{{view Ember.TextField placeholder="192.168.0.1" pattern="^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$" valueBinding="details.static_gw"}}</td></tr>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_STATIC_DNS1']->value;?>
:</b></td><td>{{view Ember.TextField placeholder="8.8.8.8" pattern="^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$" valueBinding="details.static_dns1"}}</td></tr>
                <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_STATIC_DNS2']->value;?>
:</b></td><td>{{view Ember.TextField placeholder="8.8.4.4" pattern="^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$" valueBinding="details.static_dns2"}}</td></tr>
            </tbody>
            </table>
        </fieldset>
        {{/if}}
    </div>
    <div id="endpointconfig-standard-credentials">
        <table border="0">
        <tbody>
            <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TELNET_USER']->value;?>
:</b></td><td>{{view Ember.TextField valueBinding="details.telnet_username"}}</td></tr>
            <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_TELNET_PASS']->value;?>
:</b></td><td>{{view Ember.TextField type="password" valueBinding="details.telnet_password"}}</td></tr>
            <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_HTTP_USER']->value;?>
:</b></td><td>{{view Ember.TextField valueBinding="details.http_username"}}</td></tr>
            <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_HTTP_PASS']->value;?>
:</b></td><td>{{view Ember.TextField type="password" valueBinding="details.http_password"}}</td></tr>
            <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_SSH_USER']->value;?>
:</b></td><td>{{view Ember.TextField valueBinding="details.ssh_username"}}</td></tr>
            <tr><td><b><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_SSH_PASS']->value;?>
:</b></td><td>{{view Ember.TextField type="password" valueBinding="details.ssh_password"}}</td></tr>
        </tbody>
        </table>
    </div>
    <div id="endpointconfig-standard-endpointproperties">
        <p><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_PROPERTIES_MESSAGE']->value;?>
</p>
        {{view App.EndpointconfigPropertylistView controllerBinding="details.endpointPropertiesController" }}
    </div>
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/x-handlebars" data-template-name="endpointconfig-propertylist">
    <table  cellspacing="0" cellpadding="0" class="neo-mini-table" ><tbody>
		<tr class="neo-table-title-row">
		    <td class="neo-table-title-row"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_PROPERTY']->value;?>
</td>
		    <td class="neo-table-title-row"><?php echo $_smarty_tpl->tpl_vars['DIALOG_STANDARD_LBL_VALUE']->value;?>
</td>
		    <td class="neo-table-title-row">&nbsp;</td>
		</tr>
    
    {{#each controller }}
    <tr class="neo-table-data-row">
        <td class="neo-table-data-row"><b>{{key}}:</b></td>
        <td class="neo-table-data-row">{{view Ember.TextField valueBinding="value"}}</td>
        <td class="neo-table-data-row">{{view App.DeletePropertyButtonView label="-" propkeyBinding="key"}}</td>
    </tr>
    {{/each}}
    <tr class="neo-table-data-row">
        <td class="neo-table-data-row">{{view Ember.TextField size="20" valueBinding="controller.tempKey"}}</td>
        <td class="neo-table-data-row">{{view Ember.TextField size="20" valueBinding="controller.tempValue"}}</td>
        <td class="neo-table-data-row">{{view App.AddPropertyButtonView label="+"}}</td>
    </tr>
    
    </tbody></table>
<?php echo '</script'; ?>
><?php }
}
