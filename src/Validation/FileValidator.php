<?php namespace EdmondsCommerce\VendorOverride\Validation;

use EdmondsCommerce\VendorOverride\Override\OverrideCollection;
use EdmondsCommerce\VendorOverride\Override\OverrideCollectionFactory;
use EdmondsCommerce\VendorOverride\Validation\File\MD5;

/**
 * Class FileValidator
 * @package EdmondsCommerce\VendorOverride
 * Performs a series of checks on override files and
 */
class FileValidator
{
    /**
     * @var string
     */
    private $overridePath;

    /**
     * @var string
     */
    private $vendorPath;

    /**
     * @var OverrideCollection
     */
    private $overrideCollection;

    /**
     * @var MD5
     */
    private $md5Check;

    public function __construct($overridePath, $vendorPath)
    {
        $this->overridePath = $overridePath;
        $this->vendorPath = $vendorPath;

        $factory = new OverrideCollectionFactory();
        $this->overrideCollection = $factory->make($overridePath, $this->vendorPath);

        $this->md5Check = new MD5();
    }

    public function check()
    {
        $files = [];
        $noFailures = true;
        foreach ($this->overrideCollection->getFiles() as $overrideFile)
        {
            //Check existence
//            $this->md5Check->compareFileToMD5($overrideFile->getTargetPath())
            $overridePath = $this->overridePath . $overrideFile;
            $md5FilePath = $overridePath . '.md5';
            $filePath = $this->vendorPath . '/' . $overrideFile;

            $md5Check = file_get_contents($md5FilePath);
            $file = file_get_contents($filePath);
            if (!$file)
            {
                echo "Could not read file: " . $filePath . "\n";
                $noFailures = false;
                continue;
            }

            $fileMd5 = md5($file);

            if ($fileMd5 != $md5Check)
            {
                //MD5 failed, check that this does not match the rewrite we have already
                $overrideMd5 = md5(file_get_contents($overridePath));
                if ($fileMd5 != $overrideMd5)
                {
                    $noFailures = false;
                    echo "MD5 check failed for " . $filePath . "\n";
                }
            }
        }

        return $noFailures;
    }

    /**
     * @return OverrideCollection
     */
    public function getOverrideCollection()
    {
        return $this->overrideCollection;
    }


}