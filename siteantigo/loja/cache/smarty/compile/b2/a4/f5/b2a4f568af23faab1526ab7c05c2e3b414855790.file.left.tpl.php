<?php /* Smarty version Smarty-3.1.14, created on 2014-11-25 11:58:39
         compiled from "E:\home\industrias118\industriasacramento.com.br\web\loja\modules\tmhtmlcontent\views\templates\hooks\left.tpl" */ ?>
<?php /*%%SmartyHeaderCode:271454748b0fd35a64-84882523%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2a4f568af23faab1526ab7c05c2e3b414855790' => 
    array (
      0 => 'E:\\home\\industrias118\\industriasacramento.com.br\\web\\loja\\modules\\tmhtmlcontent\\views\\templates\\hooks\\left.tpl',
      1 => 1416573139,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '271454748b0fd35a64-84882523',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'htmlitems' => 0,
    'hItem' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54748b1004ac63_55617023',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54748b1004ac63_55617023')) {function content_54748b1004ac63_55617023($_smarty_tpl) {?><div id="htmlcontent_left">
    <ul class="htmlcontent-home clearfix">
        <?php  $_smarty_tpl->tpl_vars['hItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['htmlitems']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['hItem']->key => $_smarty_tpl->tpl_vars['hItem']->value){
$_smarty_tpl->tpl_vars['hItem']->_loop = true;
?>
        	<li class="htmlcontent-item">
            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['url']){?>
                	<a href="<?php echo $_smarty_tpl->tpl_vars['hItem']->value['url'];?>
" class="item-link"<?php if ($_smarty_tpl->tpl_vars['hItem']->value['target']==1){?> target="_blank"<?php }?>>
                <?php }?>
	            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['image']){?>
	                	<img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
images/<?php echo $_smarty_tpl->tpl_vars['hItem']->value['image'];?>
" class="item-img" alt="" />
	                <?php }?>
	            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['title']&&$_smarty_tpl->tpl_vars['hItem']->value['title_use']==1){?>
                        <h3 class="item-title"><?php echo $_smarty_tpl->tpl_vars['hItem']->value['title'];?>
</h3>
	                <?php }?>
	            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['html']){?>
	                	<div class="item-html">
                        	<?php echo $_smarty_tpl->tpl_vars['hItem']->value['html'];?>
                            
                        </div>
	                <?php }?>
            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['url']){?>
                	</a>
                <?php }?>
            </li>
        <?php } ?>
    </ul>
</div>
<?php }} ?>