<?php /* Smarty version Smarty-3.1.14, created on 2014-11-25 11:59:07
         compiled from "E:\home\industrias118\industriasacramento.com.br\web\loja\themes\theme818\modules\blockwishlist\my-account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3081654748b2b894497-93687461%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8bdad2528d85d3842638eecce1059fcb1e49ba04' => 
    array (
      0 => 'E:\\home\\industrias118\\industriasacramento.com.br\\web\\loja\\themes\\theme818\\modules\\blockwishlist\\my-account.tpl',
      1 => 1416573242,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3081654748b2b894497-93687461',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wishlist_link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54748b2b905d72_58942910',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54748b2b905d72_58942910')) {function content_54748b2b905d72_58942910($_smarty_tpl) {?>

<!-- MODULE WishList -->
<li class="lnk_wishlist">
	<a href="<?php echo $_smarty_tpl->tpl_vars['wishlist_link']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'My wishlists','mod'=>'blockwishlist'),$_smarty_tpl);?>
"><i class="icon-heart-empty"></i><?php echo smartyTranslate(array('s'=>'My wishlists','mod'=>'blockwishlist'),$_smarty_tpl);?>

	</a>
</li>
<!-- END : MODULE WishList --><?php }} ?>