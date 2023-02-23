<?php /* Smarty version Smarty-3.1.14, created on 2014-11-25 11:58:34
         compiled from "E:\home\industrias118\industriasacramento.com.br\web\loja\modules\addsharethis\addsharethis_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:269754748b0adb8059-33467195%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bbca4920bfb6d2f94e1f5c810810509cac82505' => 
    array (
      0 => 'E:\\home\\industrias118\\industriasacramento.com.br\\web\\loja\\modules\\addsharethis\\addsharethis_header.tpl',
      1 => 1416572924,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '269754748b0adb8059-33467195',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
    'cover' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54748b0ae36063_21544289',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54748b0ae36063_21544289')) {function content_54748b0ae36063_21544289($_smarty_tpl) {?><meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value->link_rewrite,$_smarty_tpl->tpl_vars['cover']->value['id_image'],'large_default');?>
" />

<?php }} ?>