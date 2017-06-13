<?php namespace Ozldmezot\Logger;

class Logger {

	protected static $base_dir = 'logs';

	public static function setBaseDir(string $base_dir)
	{
		self::$base_dir = $base_dir;
	}
    public static function error(string $content)
    {
        self::log($content, 'error');
    }

    public static function info(string $content)
    {
        self::log($content, 'info');
    }

    public static function log(string $content, string $type)
    {
		self::raw( 
            date('Y-m-d H:i:s') .' '. $content . "\n\n",
			$type.'_'.date('Y-m-d').'.log'
		);
    }

    public static function raw(string $content, string $filename)
    {
        $parts = explode('/', $filename);
        array_pop($parts);
        $dir   = '';
        array_unshift($parts, self::$base_dir);
        foreach($parts as $part)
            if(!is_dir($dir .= "$part/")) {
                var_dump($dir);
                mkdir($dir, 0755);
        }

        file_put_contents(self::$base_dir. '/'.$filename, $content, FILE_APPEND);
    }
}
