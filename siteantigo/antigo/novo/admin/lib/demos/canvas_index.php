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
	
	html_header('Canvas');
	
	$angle = Request::getInt('angle', 30);
	$font = Request::get('font', 'Vera.ttf');
	if (!file_exists(dirname(__FILE__) . '/fonts/' . $font))
		$font = 'Vera.ttf';
	
	$font_size = Request::getInt('font_size', 18);
	$text = Request::get('text', 'Hello world!');
?>

<form name="params" action="?" method="get">

<table>
	<tr>
		<td>
			Text: <input type="text" name="text" value="<?php echo str_replace(array('"'), array('&quot;'), $text); ?>" />
		</td>
		<td>
			Angle: <input type="text" name="angle" id="angle" value="<?php echo $angle; ?>" />
			<input type="button" value="+" onclick="document.getElementById('angle').value = document.getElementById('angle').value*1 + 10; document.params.submit();" />
			<input type="button" value="-" onclick="document.getElementById('angle').value = document.getElementById('angle').value*1 - 10; document.params.submit();" />
		</td>
		<td></td>
	</tr>
	<tr>
		<td>
			Font:
			<select name="font">
<?php
	$di = new DirectoryIterator(dirname(__FILE__) . '/fonts');
	foreach ($di as $file)
		if (!$file->isDot() && substr($file->getFilename(), -4) == '.ttf')
		{
			if ($file->getFilename() == $font)
				$sel = 'selected="selected"';
			else
				$sel = '';
			
			echo "<option $sel value=\"{$file->getFilename()}\">{$file->getFilename()}</option>\n";
		}
?>
			</select>
		</td>
		<td>
			Font size: <input type="text" name="font_size" id="font_size" value="<?php echo $font_size; ?>" />
			<input type="button" value="+" onclick="document.getElementById('font_size').value = document.getElementById('font_size').value*1 + 2; document.params.submit();" />
			<input type="button" value="-" onclick="document.getElementById('font_size').value = document.getElementById('font_size').value*1 - 2; document.params.submit();" />
		</td>
		<td>
			<input type="submit" value="show" />
		</td>
	</tr>
</table>

<strong>This demo also executes:
<pre>
	$canvas->filledRectangle(10, 10, 80, 40, $img->allocateColor(255, 127, 255));
	$canvas->line(60, 80, 30, 100, $img->allocateColor(255, 0, 0));
</pre>
</strong>


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
		
		$img_url = "canvas.php?img={$image}&angle={$angle}&font={$font}&font_size={$font_size}&text=" . urlencode($text);
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