<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<form name="prettyflags" action="#" method="POST">
		<label>
			<select name="ext">
				<option value="png">png</option>
				<option value="jpg">jpg</option>
				<option value="tiff">tiff</option>
				<option value="bmp">bmp</option>
				<option value="gif">gif</option>
			</select>
		</label>
		<label>
			Max width <input type="text" name="width" placeholder="64" />
		</label>
		<label>
			Max height <input type="text" name="height" placeholder="64" />
		</label>
		<label>
			Border Radius <input type="text" name="radius" placeholder="5" />
		</label>
		<label>
			Opacity <input type="text" name="opacity" placeholder="0.8" />
		</label>
		<input type="submit" value="Make the world beautiful..." />
	</form>
</body>
</html>
<?php

if (!empty($_POST))
{
	$folder = 'ugly';
	$destFolder = 'pretty';

	$ext = (isset($_POST['ext'])) ? $_POST['ext'] : 'png';
	$width = (isset($_POST['width'])) ? $_POST['width'] : 64;
	$height = (isset($_POST['height'])) ? $_POST['height'] : 64;
	$radius = (isset($_POST['radius'])) ? $_POST['radius'] : 3;
	$opacity = (isset($_POST['opacity'])) ? $_POST['opacity'] : 0.8;

	@mkdir($destFolder.'/'.$width.'x'.$height,0777,true);

	$cdir = scandir($folder); 
	foreach ($cdir as $key => $value) 
	{
		if ( ! in_array($value,array(".",".."))) 
		{

			# path infos
			$nfos = pathinfo($folder.'/'.$value);
			$name = $nfos['filename'];

			# make destination path
			$dest = $destFolder.'/'.$width.'x'.$height.'/'.$name.'.'.$ext;

			# process
			$img = new Imagick(); 
			$img->setBackgroundColor(new ImagickPixel('transparent'));
			$img->readImage($folder.'/'.$value); 
			$img->setImageFormat($ext);
			$img->scaleImage($width,$height,true);
			$img->setImageOpacity($opacity);
			if ($radius > 0) $img->roundCorners($radius,$radius,1,0,-1);
			$img->writeImage($dest); 
			$img->clear(); 
			$img->destroy(); 

			#
			print '<img src="' . $dest . '" />';

			// print $destFolder.'/'.$value . '<br />';

		}
	}
} ?>