{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}​
<script type="text/javascript" src="modules/cpfmodule/js/maskedinput.js"></script>
<script type="text/javascript" src="modules/cpfmodule/js/functions.js"></script>
<script type="text/javascript">
var urlCep = 'modules/cpfmodule/getCep.php?cep=';
// <![CDATA[
var countries2 = new Array();
var countriesNeedIDNumber2 = new Array();
var countriesNeedZipCode2 = new Array();
{foreach from=$countries2 item='country'}
 {if isset($country.states) && $country.contains_states}
    countries2[{$country.id_country|intval}] = new Array();
    {foreach from=$country.states item='state' name='states'}
      countries2[{$country.id_country|intval}].push({ldelim}'id' : '{$state.id_state}', 'name' : '{$state.name|addslashes}'{rdelim});
    {/foreach}
 {/if}
 {if $country.need_identification_number}
    countriesNeedIDNumber2.push({$country.id_country|intval});
 {/if}
 {if isset($country.need_zip_code)}
    countriesNeedZipCode2[{$country.id_country|intval}] = {$country.need_zip_code};
 {/if}
{/foreach}
$(function(){ldelim}
$('.id_state option[value={if isset($smarty.post.id_state)}{$smarty.post.id_state|intval}{else}{if isset($address->id_state)}{$address->id_state|intval}{/if}{/if}]').attr('selected', true);
{rdelim});
{literal}
 $(document).ready(function() {
 $('#company').on('input',function(){
   vat_number();
 });
  vat_number();
  function vat_number()
  {
   if ($('#company').val() != '')
     $('#vat_number').show();
   else
    $('#vat_number').hide();
  }
 });

{/literal}
//]]>
 $('.form_datetime').datetimepicker({
        format: 'dd/mm/yyyy hh:ii:ss',
        language:  'pt-BR',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0
    });

</script>


{capture name=path}{l s='Your addresses'}{/capture}
<div class="box">
	<h1 class="page-subheading">{l s='Your addresses'}</h1>
	<p class="info-title">
		{if isset($id_address) && (isset($smarty.post.alias) || isset($address->alias))}
			{l s='Modify address'} 
			{if isset($smarty.post.alias)}
				"{$smarty.post.alias}"
			{else}
				{if isset($address->alias)}"{$address->alias|escape:'html':'UTF-8'}"{/if}
			{/if}
		{else}
			{l s='To add a new address, please fill out the form below.'}
		{/if}
	</p>
	{include file="$tpl_dir./errors.tpl"}
	<p class="required"><sup>*</sup>{l s='Required field'}</p>
	<form action="{$link->getPageLink('address', true)|escape:'html':'UTF-8'}" method="post" class="std" id="add_address">
		<!--h3 class="page-subheading">{if isset($id_address)}{l s='Your address'}{else}{l s='New address'}{/if}</h3-->
		{assign var="stateExist" value=false}
		{assign var="postCodeExist" value=false}
		{assign var="dniExist" value=false}
		{assign var="homePhoneExist" value=false}
		{assign var="mobilePhoneExist" value=false}
		{assign var="atLeastOneExists" value=false}
		{foreach from=$ordered_adr_fields item=field_name}
			{if $field_name eq 'company'}
				<div class="form-group">
					<label for="company">{l s='Company'}</label>
					<input class="form-control validate" data-validate="{$address_validation.$field_name.validate}" type="text" id="company" name="company" value="{if isset($smarty.post.company)}{$smarty.post.company}{else}{if isset($address->company)}{$address->company|escape:'html':'UTF-8'}{/if}{/if}" />
				</div>
			{/if}
			{if $field_name eq 'vat_number'}
				<div id="vat_area">
					<div id="vat_number">
						<div class="form-group">
							<label for="vat-number">{l s='VAT number'}</label>
							<input type="text" class="form-control validate" data-validate="{$address_validation.$field_name.validate}" id="vat-number" name="vat_number" value="{if isset($smarty.post.vat_number)}{$smarty.post.vat_number}{else}{if isset($address->vat_number)}{$address->vat_number|escape:'html':'UTF-8'}{/if}{/if}" />
						</div>
					</div>
				</div>
			{/if}
			{if $field_name eq 'dni'}
			{assign var="dniExist" value=true}
			<div class="required form-group">
				<label for="dni">{l s='Identification number'}</label>
				<input class="form-control" data-validate="{$address_validation.$field_name.validate}" type="text" name="dni" id="dni" value="{if isset($smarty.post.dni)}{$smarty.post.dni}{else}{if isset($address->dni)}{$address->dni|escape:'html'}{/if}{/if}" />
				<span class="form_info">{l s='DNI / NIF / NIE'}</span>
			</div>
			{/if}
			{if $field_name eq 'firstname'}
				<div class="required form-group">
					<label for="firstname">{l s='First name'} <sup>*</sup></label>
					<input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate}" type="text" name="firstname" id="firstname" value="{if isset($smarty.post.firstname)}{$smarty.post.firstname}{else}{if isset($address->firstname)}{$address->firstname|escape:'html':'UTF-8'}{/if}{/if}" />
				</div>
			{/if}
			{if $field_name eq 'lastname'}
				<div class="required form-group">
					<label for="lastname">{l s='Last name'} <sup>*</sup></label>
					<input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate}" type="text" id="lastname" name="lastname" value="{if isset($smarty.post.lastname)}{$smarty.post.lastname}{else}{if isset($address->lastname)}{$address->lastname|escape:'html':'UTF-8'}{/if}{/if}" />
				</div>
			{/if}
			{if $field_name eq 'address1'}
				<div class="required form-group">
					<label for="address1">{l s='Address'} <sup>*</sup></label>
					<input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate}" type="text" id="address1" name="address1" value="{if isset($smarty.post.address1)}{$smarty.post.address1}{else}{if isset($address->address1)}{$address->address1|escape:'html':'UTF-8'}{/if}{/if}" />
				</div>
			{/if}
			
					<!-- Inicio Alteração
			Alteração no bloco de código para informar o Numero do Endereço. 
		-->
			{if $field_name eq 'numero'}
				<div class="required form-group">
					<label for="numero">{l s='Numero'} <sup>*</sup></label>
					<input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate}" type="text" id="numero" name="numero" value="{if isset($smarty.post.numero)}{$smarty.post.numero}{else}{if isset($address->numero)}{$address->numero|escape:'html':'UTF-8'}{/if}{/if}" />
				</div>
			{/if}

		<!-- Fim Alteração
			Alteração no bloco de código para informar o Numero do Endereço. 
		-->		
			{if $field_name eq 'address2'}
				<div class="required form-group">
					<label for="address2">{l s='Address (Line 2)'}</label>
					<input class="validate form-control" data-validate="{$address_validation.$field_name.validate}" type="text" id="address2" name="address2" value="{if isset($smarty.post.address2)}{$smarty.post.address2}{else}{if isset($address->address2)}{$address->address2|escape:'html':'UTF-8'}{/if}{/if}" />
				</div>
			{/if}
                      
                  

		   {if !$postCodeExist && $field_name eq 'PostCode:name' || $field_name eq 'postcode'}
			<div class="required postcode form-group unvisible">
				<label for="postcode">{l s='Zip/Postal Code'} <sup>*</sup></label> <a href=".\busca_cep.htm"  target="new">    Busca CEP</a>
				<input maxlength="9" class="is_required validate form-control" data-validate="{$address_validation.postcode.validate}" type="text" id="postcode" name="postcode" value="{if isset($smarty.post.postcode)}{$smarty.post.postcode}{else}{if isset($address->postcode)}{$address->postcode|escape:'html':'UTF-8'}{/if}{/if}" onBlur="getEndereco()" />	
				   <span style="display:block">
				   <span class="form_info">{l s='(somente números)'}</span>
						<span id="alertcep" class="alertcep" name="alertcep"></span>
						</span> 		
			</div>
		{/if}

			{if $field_name eq 'city'}
				<div class="required form-group">
					<label for="city">{l s='City'} <sup>*</sup></label>
					<input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate}" type="text" name="city" id="city" value="{if isset($smarty.post.city)}{$smarty.post.city}{else}{if isset($address->city)}{$address->city|escape:'html':'UTF-8'}{/if}{/if}" maxlength="64"    />
				</div>
				{* if customer hasn't update his layout address, country has to be verified but it's deprecated *}
			{/if}

                    {if $field_name eq 'complemento'}
				<div class="required form-group">
					<label for="complemento">{l s='Complemento'} <sup>*</sup></label>
					<input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate}" type="text" id="complemento" name="complemento" value="{if isset($smarty.post.complemento)}{$smarty.post.complemento}{else}{if isset($address->complemento)}{$address->complemento|escape:'html':'UTF-8'}{/if}{/if}" />
				</div> 
		     {/if}
			{if $field_name eq 'Country:name' || $field_name eq 'country'}
				<div class="required form-group">
					<label for="id_country">{l s='Country'}<sup>*</sup></label>
					<select id="id_country" class="form-control" name="id_country">{$countries_list}</select>
				</div>
			{/if}
			{if $field_name eq 'State:name'}
				{assign var="stateExist" value=true}
				<div class="required id_state form-group">
					<label for="id_state">{l s='State'} <sup>*</sup></label>
					<select name="id_state" id="id_state" class="form-control">
						<option value="">-</option>
					</select>
				</div>
			{/if}
			{if $field_name eq 'phone'}
				{assign var="homePhoneExist" value=true}
				<div class="form-group phone-number">
					<label for="phone">{l s='Home phone'}{if isset($one_phone_at_least) && $one_phone_at_least} <sup>**</sup>{/if}</label>
					<input class="{if isset($one_phone_at_least) && $one_phone_at_least}is_required{/if} validate form-control" data-validate="{$address_validation.phone.validate}" type="tel" id="phone" name="phone" value="{if isset($smarty.post.phone)}{$smarty.post.phone}{else}{if isset($address->phone)}{$address->phone|escape:'html':'UTF-8'}{/if}{/if}"  />
				</div>
				{if isset($one_phone_at_least) && $one_phone_at_least}
					{assign var="atLeastOneExists" value=true}
					<p class="inline-infos required">** {l s='You must register at least one phone number.'}</p>
				{/if}
				<div class="clearfix"></div>
			{/if}
			{if $field_name eq 'phone_mobile'}
				{assign var="mobilePhoneExist" value=true}
				<div class="{if isset($one_phone_at_least) && $one_phone_at_least}required {/if}form-group">
					<label for="phone_mobile">{l s='Mobile phone'}{if isset($one_phone_at_least) && $one_phone_at_least} <sup>**</sup>{/if}</label>
					<input class="validate form-control" data-validate="{$address_validation.phone_mobile.validate}" type="tel" id="phone_mobile" name="phone_mobile" value="{if isset($smarty.post.phone_mobile)}{$smarty.post.phone_mobile}{else}{if isset($address->phone_mobile)}{$address->phone_mobile|escape:'html':'UTF-8'}{/if}{/if}" />
				</div>
			{/if}

			{if $PS_SHOW_DELIVERY_DATE}

			{if $field_name eq 'delivery_date'}
	        <div class="form-group"> 
	           <label for="delivery_date" class="control-label">{l s='Delivery date'}</label><br/>               
                <div  class="input-group date form_datetime form-control"  >                    
                    <input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate}" name="delivery_date" id="delivery_date" type="text" value="{if isset($smarty.post.delivery_date)}{$smarty.post.delivery_date}{else}{if isset($address->delivery_date)}{$address->delivery_date|escape:'html':'UTF-8'}{/if}{/if}"  readonly>
                    <span class="input-group-addon"><span class="icon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
			{/if}			
			{/if}
		{/foreach}
		{if !$stateExist}
			<div class="required id_state form-group unvisible">
				<label for="id_state">{l s='State'} <sup>*</sup></label>
				<select name="id_state" id="id_state" class="form-control">
					<option value="">-</option>
				</select>
			</div>
		{/if}
		
		{if !$dniExist}
			<div class="required dni form-group unvisible">
				<label for="dni">{l s='Identification number'} <sup>*</sup></label>
				<input class="is_required form-control" data-validate="{$address_validation.dni.validate}" type="text" name="dni" id="dni" value="{if isset($smarty.post.dni)}{$smarty.post.dni}{else}{if isset($address->dni)}{$address->dni|escape:'html'}{/if}{/if}" />
				<span class="form_info">{l s='DNI / NIF / NIE'}</span>
			</div>
		{/if}
		<div class="form-group">
			<label for="other">{l s='Additional information'}</label>
			<textarea class="validate form-control" data-validate="{$address_validation.other.validate}" id="other" name="other" cols="26" rows="3" >{if isset($smarty.post.other)}{$smarty.post.other}{else}{if isset($address->other)}{$address->other|escape:'html':'UTF-8'}{/if}{/if}</textarea>
		</div>
		{if !$homePhoneExist}
			<div class="form-group phone-number">
				<label for="phone">{l s='Home phone'}</label>
				<input class="{if isset($one_phone_at_least) && $one_phone_at_least}is_required{/if} validate form-control" data-validate="{$address_validation.phone.validate}" type="tel" id="phone" name="phone" value="{if isset($smarty.post.phone)}{$smarty.post.phone}{else}{if isset($address->phone)}{$address->phone|escape:'html':'UTF-8'}{/if}{/if}"  />
			</div>
		{/if}
		{if isset($one_phone_at_least) && $one_phone_at_least && !$atLeastOneExists }
			<p class="inline-infos required">{l s='You must register at least one phone number.'}</p>
		{/if}
		<div class="clearfix"></div>
		{if !$mobilePhoneExist}
			<div class="{if isset($one_phone_at_least) && $one_phone_at_least}required {/if}form-group">
				<label for="phone_mobile">{l s='Mobile phone'}{if isset($one_phone_at_least) && $one_phone_at_least} <sup>**</sup>{/if}</label>
				<input class="validate form-control" data-validate="{$address_validation.phone_mobile.validate}" type="tel" id="phone_mobile" name="phone_mobile" value="{if isset($smarty.post.phone_mobile)}{$smarty.post.phone_mobile}{else}{if isset($address->phone_mobile)}{$address->phone_mobile|escape:'html':'UTF-8'}{/if}{/if}" />
			</div>
		{/if}
		<div class="required form-group" id="adress_alias">
			<label for="alias">{l s='Please assign an address title for future reference.'} <sup>*</sup></label>
			<input type="text" id="alias" class="is_required validate form-control" data-validate="{$address_validation.alias.validate}" name="alias" value="{if isset($smarty.post.alias)}{$smarty.post.alias}{else if isset($address->alias)}{$address->alias|escape:'html':'UTF-8'}{elseif !$select_address}{l s='My address'}{/if}" />
		</div>
		<p class="submit2">
			{if isset($id_address)}<input type="hidden" name="id_address" value="{$id_address|intval}" />{/if}
			{if isset($back)}<input type="hidden" name="back" value="{$back}" />{/if}
			{if isset($mod)}<input type="hidden" name="mod" value="{$mod}" />{/if}
			{if isset($select_address)}<input type="hidden" name="select_address" value="{$select_address|intval}" />{/if}
			<input type="hidden" name="token" value="{$token}" />		
			<button type="submit" name="submitAddress" id="submitAddress" class="btn btn-default button button-medium">
				<span>
					{l s='Save'}
					<i class="icon-chevron-right right"></i>
				</span>
			</button>
		</p>
	</form>
</div>
<ul class="footer_links clearfix">
	<li>
		<a class="btn btn-defaul button button-small" href="{$link->getPageLink('addresses', true)|escape:'html':'UTF-8'}">
			<span><i class="icon-chevron-left"></i> {l s='Back to your addresses'}</span>
		</a>
	</li>
</ul>
{strip}
{if isset($smarty.post.id_state) && $smarty.post.id_state}
	{addJsDef idSelectedState=$smarty.post.id_state|intval}
{else if isset($address->id_state) && $address->id_state}
	{addJsDef idSelectedState=$address->id_state|intval}
{else}
	{addJsDef idSelectedState=false}
{/if}
{if isset($smarty.post.id_country) && $smarty.post.id_country}
	{addJsDef idSelectedCountry=$smarty.post.id_country|intval}
{else if isset($address->id_country) && $address->id_country}
	{addJsDef idSelectedCountry=$address->id_country|intval}
{else}
	{addJsDef idSelectedCountry=false}
{/if}
{if isset($countries)}
	{addJsDef countries=$countries}
{/if}
{if isset($vatnumber_ajax_call) && $vatnumber_ajax_call}
	{addJsDef vatnumber_ajax_call=$vatnumber_ajax_call}
{/if}
{/strip}
