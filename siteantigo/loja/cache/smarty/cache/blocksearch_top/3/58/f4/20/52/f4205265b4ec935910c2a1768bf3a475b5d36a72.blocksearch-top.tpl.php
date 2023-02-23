<?php /*%%SmartyHeaderCode:1922754748b0c8e9c32-22171931%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4205265b4ec935910c2a1768bf3a475b5d36a72' => 
    array (
      0 => 'E:\\home\\industrias118\\industriasacramento.com.br\\web\\loja\\themes\\theme818\\modules\\blocksearch\\blocksearch-top.tpl',
      1 => 1416573235,
      2 => 'file',
    ),
    '8c23c5ec9ed0336c934907974b81580a7c917b1b' => 
    array (
      0 => 'E:\\home\\industrias118\\industriasacramento.com.br\\web\\loja\\themes\\theme818\\modules\\blocksearch\\blocksearch-instantsearch.tpl',
      1 => 1416573235,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1922754748b0c8e9c32-22171931',
  'variables' => 
  array (
    'hook_mobile' => 0,
    'link' => 0,
    'ENT_QUOTES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54748b0cecc180_99335963',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54748b0cecc180_99335963')) {function content_54748b0cecc180_99335963($_smarty_tpl) {?><!-- block seach mobile -->
<!-- Block search module TOP -->
<section id="search_block_top" class="header-box">
	<form method="get" action="http://industriasacramento.com.br/loja/index.php?controller=search" id="searchbox">
		<p>
			<label for="search_query_top">Busca</label>
			<input type="hidden" name="controller" value="search" />
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="orderway" value="desc" />
			<input class="search_query" type="text" id="search_query_top" name="search_query" value="" />
            <a href="javascript:document.getElementById('searchbox').submit();"><i class="icon-search"></i><span>Busca</span></a>
			
	    </p>
	</form>
</section>
	<script type="text/javascript">
	// <![CDATA[
		function tryToCloseInstantSearch() {
			if ($('#old_center_column').length > 0)
			{
				$('#center_column').remove();
				$('#old_center_column').attr('id', 'center_column');
				$('body').removeClass('instant_search');
				$('#slider .nivo-main-image').trigger('mouseout');
				$('#center_column').show();
				return false;
			}
		}
		
		instantSearchQueries = new Array();
		function stopInstantSearchQueries(){
			for(i=0;i<instantSearchQueries.length;i++) {
				instantSearchQueries[i].abort();
			}
			instantSearchQueries = new Array();
		}
		
		$("#search_query_top").keyup(function(){
			if($(this).val().length > 0){
				stopInstantSearchQueries();
				instantSearchQuery = $.ajax({
					url: 'http://industriasacramento.com.br/loja/index.php?controller=search',
					data: {
						instantSearch: 1,
						id_lang: 1,
						q: $(this).val()
					},
					dataType: 'html',
					type: 'POST',
					success: function(data){
						if($("#search_query_top").val().length > 0)
						{
							tryToCloseInstantSearch();
							$('#center_column').attr('id', 'old_center_column');
							$('#old_center_column').after('<div id="center_column" class="instant ' + $('#old_center_column').attr('class') + '">'+data+'</div>');
							$('#center_column').find('ul#product_list').removeClass('grid').addClass('list');
							$('body').addClass('instant_search');
							$('#old_center_column').hide();
							// Button override
							ajaxCart.overrideButtonsInThePage();
							$('#slider .nivo-main-image').trigger('mouseenter');
							$("#instant_search_results a.close-search").click(function() {
								$("#search_query_top").val('');
								$('body').removeClass('instant_search');
								$('#slider .nivo-main-image').trigger('mouseout');
								return tryToCloseInstantSearch();
							});
							return false;
						}
						else
							tryToCloseInstantSearch();
					}
				});
				instantSearchQueries.push(instantSearchQuery);
			}
			else
				tryToCloseInstantSearch();
		});
	// ]]>
	</script>
	<script type="text/javascript">
	// <![CDATA[
		$('document').ready( function() {
			$("#search_query_top")
				.autocomplete(
					'http://industriasacramento.com.br/loja/index.php?controller=search', {
						minChars: 3,
						max: 10,
						width: 300,
						selectFirst: false,
						scroll: false,
						dataType: "json",
						formatItem: function(data, i, max, value, term) {
							return value;
						},
							parse: function(data) {
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = { data: data[i], value: data[i].cname + ' > ' + data[i].pname };
							return mytab;
						},
						extraParams: {
							ajaxSearch: 1,
							id_lang: 1
						}
					}
				)
				.result(function(event, data, formatted) {
					$('#search_query_top').val(data.pname);
					document.location.href = data.product_link;
						})
		});
	// ]]>
	</script>

<!-- /Block search module TOP -->
<?php }} ?>