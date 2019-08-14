<?php

namespace MiscClass;

define('FS_STRING', 1);
define('FS_EMAIL', 2);
define('FS_FLOAT', 3);
define('FS_INT', 4);
define('FS_URL', 5);
define('FS_ARRAY', 6);
define('FS_ARRAY_STRING', 7);
define('FS_ARRAY_EMAIL', 8);
define('FS_ARRAY_FLOAT', 9);
define('FS_ARRAY_INT', 10);
define('FS_ARRAY_URL', 11);

class Sanitize
{
	public static function clean($var = null, $type = "")
	{
		switch($type) {
			case FS_STRING:
				return filter_var($var, FILTER_SANITIZE_STRING);
				break;
			case FS_EMAIL:
				return filter_var($var, FILTER_SANITIZE_EMAIL);
				break;
			case FS_FLOAT:
				return filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT);
				break;
			case FS_INT:
				return filter_var($var, FILTER_SANITIZE_NUMBER_INT);
				break;
			case FS_URL:
				return filter_var($var, FILTER_SANITIZE_URL);
				break;
			case FS_ARRAY:
				if (!is_array($var)) {
					return array();
				}
				return $var;
				break;
			case FS_ARRAY_STRING:
				return filter_var_array($var, FILTER_SANITIZE_STRING);
				break;
			case FS_ARRAY_EMAIL:
				return filter_var_array($var, FILTER_SANITIZE_EMAIL);
				break;
			case FS_ARRAY_FLOAT:
				return filter_var_array($var, FILTER_SANITIZE_NUMBER_FLOAT);
				break;
			case FS_ARRAY_INT:
				return filter_var_array($var, FILTER_SANITIZE_NUMBER_INT);
				break;
			case FS_ARRAY_URL:
				return filter_var_array($var, FILTER_SANITIZE_URL);
				break;
			default:
				return $var;
		}
	}
}
