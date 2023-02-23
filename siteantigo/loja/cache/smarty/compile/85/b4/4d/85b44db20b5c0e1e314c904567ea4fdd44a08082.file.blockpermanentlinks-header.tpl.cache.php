<?php /* Smarty version Smarty-3.1.14, created on 2014-11-25 11:58:35
         compiled from "E:\home\industrias118\industriasacramento.com.br\web\loja\themes\theme818\modules\blockpermanentlinks\blockpermanentlinks-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3176354748b0b713067-44904948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85b44db20b5c0e1e314c904567ea4fdd44a08082' => 
    array (
      0 => 'E:\\home\\industrias118\\industriasacramento.com.br\\web\\loja\\themes\\theme818\\modules\\blockpermanentlinks\\blockpermanentlinks-header.tpl',
      1 => 1416573233,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3176354748b0b713067-44904948',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54748b0b82c230_30234537',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54748b0b82c230_30234537')) {function content_54748b0b82c230_30234537($_smarty_tpl) {?>

<!-- Block permanent links module HEADER -->
<section class="header-box blockpermanentlinks-header">
    <ul id="header_links" class="hidden-xs">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('index.php');?>
" class="header_links_home"><?php echo smartyTranslate(array('s'=>'home','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
       <li id="header_link_sitemap"><a class="header_links_sitemap" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('sitemap'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
        <li id="header_link_contact"><a class="header_links_contact" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'contact','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'contact','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
        
        
    </ul>
	<div class="new-menu-bg">
    <div class="mobile-link-top header-button visible-xs">
    	
            <h4 class="icon_wrapp">
                 <span class="title-hed"></span><i class="arrow_header_top_menu arrow_header_top icon-reorder"></i>
            </h4>
            <ul id="mobilelink" class="list_header">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('index.php');?>
" class="header_links_home"><?php echo smartyTranslate(array('s'=>'home','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
                <li id="header_link_sitemap"><a class="header_links_sitemap" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('sitemap'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
                <li id="header_link_contact"><a class="header_links_contact" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'contact','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'contact','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- /Block permanent links module HEADER -->


<?php }} ?>