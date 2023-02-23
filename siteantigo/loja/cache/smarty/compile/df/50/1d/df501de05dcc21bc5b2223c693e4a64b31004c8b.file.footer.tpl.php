<?php /* Smarty version Smarty-3.1.14, created on 2014-11-25 11:58:43
         compiled from "E:\home\industrias118\industriasacramento.com.br\web\loja\themes\theme818\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2905454748b13b55a87-59206813%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df501de05dcc21bc5b2223c693e4a64b31004c8b' => 
    array (
      0 => 'E:\\home\\industrias118\\industriasacramento.com.br\\web\\loja\\themes\\theme818\\footer.tpl',
      1 => 1416578572,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2905454748b13b55a87-59206813',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'RightColumn' => 0,
    'HOOK_FOOTER' => 0,
    'PS_ALLOW_MOBILE_DEVICE' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54748b13c20bd2_64515000',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54748b13c20bd2_64515000')) {function content_54748b13c20bd2_64515000($_smarty_tpl) {?>

		<?php if (!$_smarty_tpl->tpl_vars['content_only']->value){?>
				</div>

<!-- Right -->
			<?php if (isset($_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value)&&(str_replace(" ",'',$_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value))!=''){?><?php $_smarty_tpl->tpl_vars['RightColumn'] = new Smarty_variable(3, null, 0);?><?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['RightColumn']->value)&&$_smarty_tpl->tpl_vars['RightColumn']->value!=0){?>
				<div id="right_column" class="col-xs-12 col-sm-3 column">
					<?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>

				</div>
            <?php }?>
			</div>
            </div>
</div>
<!-- Footer -->
			<div class="page_wrapper_3 clearfix">
                <footer id="footer" class="container">
                <div class="row modules">
                    <?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>

                     <?php if ($_smarty_tpl->tpl_vars['PS_ALLOW_MOBILE_DEVICE']->value){?>
                        <p class="center clearfix"><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true);?>
?mobile_theme_ok"><?php echo smartyTranslate(array('s'=>'Browse the mobile site'),$_smarty_tpl);?>
</a></p>
                    <?php }?>
                </div>
                   
                </footer>
            </div>
		</div>
	<?php }?>
	</body>
</html>
<?php }} ?>