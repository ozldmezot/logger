<?php namespace Ozldmezot\Logger;

class Logger {
	protected $base_dir;

    public function __construct(string $base_dir = 'logs')
    {
        $this->setBaseDir($base_dir);
    }
    public function setBaseDir(string $base_dir)
    {
        $this->base_dir = $base_dir;
    }
    public function error(string $content)
    {
        $this->log($content, 'error');
    }
    public function info(string $content)
    {
        $this->log($content, 'info');
    }
    public function log(string $content, string $type)
    {
		$this->raw(
            date('Y-m-d H:i:s') .' '. $content . "\n\n",
			$type.'_'.date('Y-m-d').'.log'
		);
    }
    public function raw(string $content, string $filename)
    {
        $parts = explode('/', $filename);
        array_pop($parts);
        $dir   = '';
        array_unshift($parts, $this->base_dir);
        foreach($parts as $part)
            if(!is_dir($dir .= "$part/")) {
                mkdir($dir, 0755);
        }
        file_put_contents($this->base_dir. '/'.$filename, $content, FILE_APPEND);
    }
}

