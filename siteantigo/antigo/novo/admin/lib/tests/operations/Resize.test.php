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
	
	class ResizeTest extends ImageTester
	{
		function testResizeFill()
		{
			$img = wiImage::load(IMG_PATH . '100x100-color-hole.gif');
			$resized = $img->resize(50, 20, 'fill');
			$this->assertTrue($resized instanceof wiTrueColorImage);
			$this->assertTrue($resized->isTransparent());
			$this->assertEqual(50, $resized->getWidth());
			$this->assertEqual(20, $resized->getHeight());
			$this->assertRGBEqual($resized->getRGBAt(5, 5), 255, 255, 0);
			$this->assertRGBEqual($resized->getRGBAt(45, 5), 0, 0, 255);
			$this->assertRGBEqual($resized->getRGBAt(45, 15), 0, 255, 0);
			$this->assertRGBEqual($resized->getRGBAt(5, 15), 255, 0, 0);
			
			$this->assertRGBEqual($resized->getRGBAt(25, 10), 255, 255, 255);
			$this->assertRGBEqual($img->getTransparentColorRGB(), 255, 255, 255);
		}
		
		function testResizeFillDimensions()
		{
			$img = wiTrueColorImage::create(100, 50);
			$resized = $img->resize(30, null, 'fill');
			$this->assertEqual(30, $resized->getWidth());
			$this->assertEqual(15, $resized->getHeight());
			
			$img = wiTrueColorImage::create(100, 50);
			$resized = $img->resize(null, 30, 'fill');
			$this->assertEqual(60, $resized->getWidth());
			$this->assertEqual(30, $resized->getHeight());
			
			$img = wiTrueColorImage::create(100, 50);
			$resized = $img->resize(30, 30, 'fill');
			$this->assertEqual(30, $resized->getWidth());
			$this->assertEqual(30, $resized->getHeight());
			
			$img = wiTrueColorImage::create(100, 50);
			$resized = $img->resize(30, 40, 'fill');
			$this->assertEqual(30, $resized->getWidth());
			$this->assertEqual(40, $resized->getHeight());
		}
		
		function testResizeInside()
		{
			$img = wiImage::load(IMG_PATH . '100x100-color-hole.gif');
			$resized = $img->resize(50, 20, 'inside');
			$this->assertTrue($resized instanceof wiTrueColorImage);
			$this->assertTrue($resized->isTransparent());
			$this->assertEqual(20, $resized->getWidth());
			$this->assertEqual(20, $resized->getHeight());
			/*
			$this->assertRGBEqual($resized->getRGBAt(5, 5), 255, 255, 0);
			$this->assertRGBEqual($resized->getRGBAt(45, 5), 0, 0, 255);
			$this->assertRGBEqual($resized->getRGBAt(45, 15), 0, 255, 0);
			$this->assertRGBEqual($resized->getRGBAt(5, 15), 255, 0, 0);
			$this->assertRGBEqual($resized->getRGBAt(25, 10), 255, 255, 255);
			$this->assertRGBEqual($img->getTransparentColorRGB(), 255, 255, 255);
			*/
		}
		
		function testResizeDown()
		{
			$img = wiTrueColorImage::create(100, 100);
			$resized = $img->resizeDown(30);
			$this->assertEqual(30, $resized->getWidth());
			$this->assertEqual(30, $resized->getHeight());
			
			$img = wiTrueColorImage::create(200, 100);
			$resized = $img->resizeDown(100);
			$this->assertEqual(100, $resized->getWidth());
			$this->assertEqual(50, $resized->getHeight());
			
			$img = wiTrueColorImage::create(200, 100);
			$resized = $img->resizeDown(null, 30);
			$this->assertEqual(60, $resized->getWidth());
			$this->assertEqual(30, $resized->getHeight());
			
			$img = wiTrueColorImage::create(200, 100);
			$resized = $img->resizeDown(201);
			$this->assertEqual($img->getWidth(), $resized->getWidth());
			$this->assertEqual($img->getHeight(), $resized->getHeight());
			
			$img = wiTrueColorImage::create(200, 100);
			$resized = $img->resizeDown(null, 300);
			$this->assertEqual($img->getWidth(), $resized->getWidth());
			$this->assertEqual($img->getHeight(), $resized->getHeight());
		}
		
		function testResizeUp()
		{
			$img = wiTrueColorImage::create(100, 100);
			$resized = $img->resizeUp(300);
			$this->assertEqual(300, $resized->getWidth());
			$this->assertEqual(300, $resized->getHeight());
			
			$img = wiTrueColorImage::create(200, 100);
			$resized = $img->resizeUp(300);
			$this->assertEqual(300, $resized->getWidth());
			$this->assertEqual(150, $resized->getHeight());
			
			$img = wiTrueColorImage::create(20, 10);
			$resized = $img->resizeUp(null, 30);
			$this->assertEqual(60, $resized->getWidth());
			$this->assertEqual(30, $resized->getHeight());
			
			$img = wiTrueColorImage::create(200, 100);
			$resized = $img->resizeUp(199);
			$this->assertEqual($img->getWidth(), $resized->getWidth());
			$this->assertEqual($img->getHeight(), $resized->getHeight());
			
			$img = wiTrueColorImage::create(200, 100);
			$resized = $img->resizeUp(null, 10);
			$this->assertEqual($img->getWidth(), $resized->getWidth());
			$this->assertEqual($img->getHeight(), $resized->getHeight());
		}
	}
?>