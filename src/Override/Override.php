<?php namespace EdmondsCommerce\VendorOverride\Override;

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

    private $vendorPath;

    /**
     * Override constructor.
     *
     * @param $overridePath
     * @param $md5Path
     * @param $vendorPath
     */
    public function __construct($overridePath, $md5Path, $vendorPath)
    {
        $this->overridePath = $overridePath;
        $this->md5Path = $md5Path;
        $this->vendorPath = $vendorPath;
    }

    /**
     * Get the target for the override
     */
    public function getTargetPath()
    {

    }

}