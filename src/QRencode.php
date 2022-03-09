<?php
namespace QRcode;

class QRencode
{
	public $casesensitive = true;
	public $eightbit = false;

	public $version = 0;
	public $size = 3;
	public $margin = 4;

	public $structured = 0; // not supported yet
	public $level = QRstr :: QR_ECLEVEL_L;
	public $hint = QRstr :: QR_MODE_8;

	//----------------------------------------------------------------------
	public static function factory($level = QRstr :: QR_ECLEVEL_L, $size = 3, $margin = 4)
	{
		$enc = new QRencode();
		$enc->size = $size;
		$enc->margin = $margin;

		switch ($level . '')
		{
			case '0':
			case '1':
			case '2':
			case '3':
				$enc->level = $level;
			break;
			case 'l':
			case 'L':
				$enc->level = QRstr :: QR_ECLEVEL_L;
			break;
			case 'm':
			case 'M':
				$enc->level = QRstr :: QR_ECLEVEL_M;
			break;
			case 'q':
			case 'Q':
				$enc->level = QRstr :: QR_ECLEVEL_Q;
			break;
			case 'h':
			case 'H':
				$enc->level = QRstr :: QR_ECLEVEL_H;
			break;
		}

		return $enc;
	}

	//----------------------------------------------------------------------
	public function encodeRAW($intext, $outfile = false)
	{
		$code = new QRcode();

		if ($this->eightbit)
		{
			$code->encodeString8bit($intext, $this->version, $this->level);
		}
		else
		{
			$code->encodeString($intext, $this->version, $this->level, $this->hint, $this->casesensitive);
		}

		return $code->data;
	}

	//----------------------------------------------------------------------
	public function encode($intext, $outfile = false)
	{
		$code = new QRcode();

		if ($this->eightbit)
		{
			$code->encodeString8bit($intext, $this->version, $this->level);
		}
		else
		{
			$code->encodeString($intext, $this->version, $this->level, $this->hint, $this->casesensitive);
		}

		QRtools::markTime('after_encode');

		if ($outfile !== false)
		{
			file_put_contents($outfile, join("\n", QRtools::binarize($code->data)));
		}
		else
		{
			return QRtools::binarize($code->data);
		}
	}

	//----------------------------------------------------------------------
	public function encodePNG($intext, $outfile = false, $saveandprint = false)
	{
		try
		{

			ob_start();
			$tab = $this->encode($intext);
			$err = ob_get_contents();
			ob_end_clean();

			if ($err != '') QRtools::log($outfile, $err);

			$maxSize = (int)(QRconfig :: QR_PNG_MAXIMUM_SIZE / (count($tab) + 2 * $this->margin));

			QRimage::png($tab, $outfile, min(max(1, $this->size), $maxSize), $this->margin, $saveandprint);

		}
		catch(Exception $e)
		{

			QRtools::log($outfile, $e->getMessage());

		}
	}

	//----------------------------------------------------------------------
	public function encodeWEBP($intext, $outfile = false, $q = 57, $saveandprint = false)
	{
		try
		{

			ob_start();
			$tab = $this->encode($intext);
			$err = ob_get_contents();
			ob_end_clean();

			if ($err != '') QRtools::log($outfile, $err);

			$maxSize = (int)(QRconfig :: QR_PNG_MAXIMUM_SIZE / (count($tab) + 2 * $this->margin));

			QRimage::webp($tab, $outfile, min(max(1, $this->size), $maxSize), $this->margin, $q, $saveandprint);

		}
		catch(Exception $e)
		{

			QRtools::log($outfile, $e->getMessage());

		}
	}

	//----------------------------------------------------------------------
	public function encodeB64PNG($intext)
	{
		try
		{

			ob_start();
			$tab = $this->encode($intext);
			$err = ob_get_contents();
			ob_end_clean();

			if ($err != '') QRtools::log('b64png', $err);

			$maxSize = (int)(QRconfig :: QR_PNG_MAXIMUM_SIZE / (count($tab) + 2 * $this->margin));

			$target_image = QRimage::image($tab, min(max(1, $this->size), $maxSize), $this->margin);

			ob_start(); // Let's start output buffering.
			imagepng($target_image); //This will normally output the image, but because of ob_start(), it won't.
			$contents = ob_get_contents(); //Instead, output above is saved to $contents
			ob_end_clean(); //End the output buffer.

			return "data:image/png;base64," . base64_encode($contents);
		}
		catch(Exception $e)
		{

			QRtools::log('b64png', $e->getMessage());

		}
	}

	//----------------------------------------------------------------------
	public function encodeB64WEBP($intext, $q = 57)
	{
		try
		{

			ob_start();
			$tab = $this->encode($intext);
			$err = ob_get_contents();
			ob_end_clean();

			if ($err != '') QRtools::log('b64webp', $err);

			$maxSize = (int)(QRconfig :: QR_PNG_MAXIMUM_SIZE / (count($tab) + 2 * $this->margin));

			$target_image = QRimage::image($tab, min(max(1, $this->size), $maxSize), $this->margin);

			imagepalettetotruecolor($target_image);
			imagealphablending($target_image, true);
			imagesavealpha($target_image, true);

			ob_start(); // Let's start output buffering.
			imagewebp($target_image, null, $q); //This will normally output the image, but because of ob_start(), it won't.
			$contents = ob_get_contents(); //Instead, output above is saved to $contents
			ob_end_clean(); //End the output buffer.

			return "data:image/webp;base64," . base64_encode($contents);
		}
		catch(Exception $e)
		{

			QRtools::log('b64webp', $e->getMessage());

		}
	}
}