<?php
	/**
    This file is part of WideImage.
		
    WideImage is free software; you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation; either version 2.1 of the License, or
    (at your option) any later version.
		
    WideImage is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Lesser General Public License for more details.
		
    You should have received a copy of the GNU Lesser General Public License
    along with WideImage; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  **/
	
	require_once(dirname(__FILE__) . '/helpers/common.inc.php');
	
	html_header('AutoCrop');
	
	$rgb_threshold = Request::getInt('rgb_threshold', 0);
	$margin = Request::getInt('margin', 0);
	$pixel_cutoff = Request::getInt('pixel_cutoff', 1);
	$base_color = Request::get('base_color', null);
?>

<form action="?" method="get">

<table>
	<tr>
		<td>
	margin: <input type="text" name="margin" value="<?php echo $margin; ?>" />
	rgb threshold: <input type="text" name="rgb_threshold" value="<?php echo $rgb_threshold; ?>" />
	<br />
	pixel cutoff: <input type="text" name="pixel_cutoff" value="<?php echo $pixel_cutoff; ?>" />
	base color in format RRGGBB (leave empty for value of top-left corner): <input type="text" name="base_color" value="<?php echo $base_color; ?>" />
		</td>
		<td>
			<input type="submit" value="show" />
		</td>
	</tr>
</table>

</form>

<table>
<?php
	$i = 0;
	foreach (Registry::get('images') as $image)
	{
		if ($i % 2 == 0)
		{
			if ($i > 0)
				echo "\n</tr>\n";
			echo "<tr>\n";
		}
		$i++;
		
		$img_url = "autocrop.php?img={$image}&margin={$margin}&rgb_threshold={$rgb_threshold}&pixel_cutoff={$pixel_cutoff}&base_color={$base_color}";
?>
		<td class="right">
			<img src="images/<?php echo $image; ?>" />
		</td>
		<td class="left">
			<div class="frame">
			<a href="<?php echo $img_url; ?>"><img src="<?php echo $img_url; ?>" /></a>
			</div>
		</td>
<?php
	}
?>
	</tr>
</table>

		

	</body>
</html>