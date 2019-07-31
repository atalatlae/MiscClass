<?php

namespace MiscClass;

class HTTPCompress
{
	public function __construct() {
	}

	public static function startCompress() {
		ob_start();
	}

	public static function dumpCompress() {
		$content = ob_get_contents();
		$gzc = gzencode($content);
		ob_end_clean();

		header("Content-Encoding: gzip");
		header("content-length: ".strlen($gzc));

		echo $gzc;
	}
}
