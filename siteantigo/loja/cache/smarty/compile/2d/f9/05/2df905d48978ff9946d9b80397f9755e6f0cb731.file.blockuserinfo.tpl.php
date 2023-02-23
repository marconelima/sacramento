<?php /* Smarty version Smarty-3.1.14, created on 2014-11-25 11:58:37
         compiled from "E:\home\industrias118\industriasacramento.com.br\web\loja\themes\theme818\modules\blockuserinfo\blockuserinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1855954748b0d06bad7-05022530%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2df905d48978ff9946d9b80397f9755e6f0cb731' => 
    array (
      0 => 'E:\\home\\industrias118\\industriasacramento.com.br\\web\\loja\\themes\\theme818\\modules\\blockuserinfo\\blockuserinfo.tpl',
      1 => 1416573241,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1855954748b0d06bad7-05022530',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'logged' => 0,
    'link' => 0,
    'PS_CATALOG_MODE' => 0,
    'order_process' => 0,
    'cart_qties' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54748b0d148fc5_63502287',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54748b0d148fc5_63502287')) {function content_54748b0d148fc5_63502287($_smarty_tpl) {?>

<!-- Block user information module HEADER -->
<section class="blockuserinfo header-box">
		<?php if ($_smarty_tpl->tpl_vars['logged']->value){?>
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,"mylogout"), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Log out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="logout" rel="tooltip" data-placement="bottom" data-original-title="first tooltip"><span><i class="icon-unlock"></i></span></a>
		<?php }else{ ?>
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Login','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="login" rel="tooltip" data-placement="bottom" data-original-title="first tooltip" ><span><i class="icon-lock"></i></span></a>
		<?php }?>
</section>

<section id="header_user" class="blockuserinfo-cart header-box <?php if ($_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>header_user_catalog<?php }?>">
		<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>
		<div id="shopping_cart">
        <a class="clearfix" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink($_smarty_tpl->tpl_vars['order_process']->value,true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my shopping cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" rel="nofollow">
          <i class="opancart  icon-shopping-cart"></i>
                <span class="shopping_cart_title"><?php echo smartyTranslate(array('s'=>'Cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
                <span class="ajax_cart_quantity" <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value==0){?> style="display:none"<?php }?>><?php echo $_smarty_tpl->tpl_vars['cart_qties']->value;?>
</span>
                <!--span class="ajax_cart_product_txt<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value!=1){?> hidden<?php }?>"><?php echo smartyTranslate(array('s'=>'Product','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
                <span class="ajax_cart_product_txt_s<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value<2){?> hidden<?php }?>"><?php echo smartyTranslate(array('s'=>'Products','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span-->
                 
                <span class="ajax_cart_no_product" <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value>0){?> style="display:none;"<?php }?>><?php echo smartyTranslate(array('s'=>'(empty)','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
            </a>
		</div>
		<?php }?>
</section><?php }} ?>