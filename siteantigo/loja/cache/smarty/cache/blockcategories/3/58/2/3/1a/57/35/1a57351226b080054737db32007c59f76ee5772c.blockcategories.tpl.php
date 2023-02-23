<?php /*%%SmartyHeaderCode:2680054748b0f9713a5-55869643%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a57351226b080054737db32007c59f76ee5772c' => 
    array (
      0 => 'E:\\home\\industrias118\\industriasacramento.com.br\\web\\loja\\themes\\theme818\\modules\\blockcategories\\blockcategories.tpl',
      1 => 1416573224,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2680054748b0f9713a5-55869643',
  'variables' => 
  array (
    'isDhtml' => 0,
    'blockCategTree' => 0,
    'child' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54748b0fc35967_78515172',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54748b0fc35967_78515172')) {function content_54748b0fc35967_78515172($_smarty_tpl) {?>
<!-- Block categories module -->
<section  id="categories_block_left"  class="column_box block">
	<h4><span>Categorias</span><i class="column_icon_toggle icon-plus-sign"></i></h4>
		<ul class="toggle_content tree dhtml">
				</ul>
		
		<script type="text/javascript">
		// <![CDATA[
			// we hide the tree only if JavaScript is activated
			$('div#categories_block_left ul.dhtml').hide();
		// ]]>
		</script>
</section>
<!-- /Block categories module -->
<?php }} ?>