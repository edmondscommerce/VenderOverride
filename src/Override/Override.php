<?php namespace EdmondsCommerce\M2HotFixes\Override;

use function Magento\Framework\Filesystem\Driver\file_get_contents;

class Override
{
    /**
     * @var string
     * The path in this module containing changes
     */
    private $overridePath;

    /**
     * @var string
     * The file path that points to the md5 for the original state of the file
     */
    private $md5Path;

    /**
     * Override constructor.
     *
     * @param $overridePath
     * @param $filePath
     */
    public function __construct($overridePath, $md5Path)
    {
        $this->overridePath = $overridePath;
        $this->md5Path = $md5Path;
    }

    /**
     * Get the MD5 for the override file
     */
    public function getOverrideMd5()
    {
        $file = file_get_contents($this->overridePath);
        return md5($file);
    }

    /**
     * Get the target for the override
     */
    public function getTargetPath()
    {

    }

    /**
     * Read the .md5 file for the file we want to rewrite
     * This is the state of the file before rewrites
     */
    public function getFileOriginalMd5()
    {
        return file_get_contents($this->md5Path);
    }

    /**
     * Read the MD5 from the target file
     */
    public function getFileMd5()
    {
        $file = file_get_contents($this->md5Path);
        return md5($file);
    }
}