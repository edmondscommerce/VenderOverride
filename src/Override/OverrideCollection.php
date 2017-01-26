<?php namespace EdmondsCommerce\VendorOverride\Override;

class OverrideCollection
{
    /**
     * @var Override[]
     */
    private $files;

    public function __construct($files)
    {
        $this->files = $files;
    }

    /**
     * @return Override[]
     */
    public function getFiles()
    {
        return $this->files;
    }
}