<?php namespace EdmondsCommerce\VendorOverride;

use EdmondsCommerce\VendorOverride\Override\OverrideCollectionFactory;
use EdmondsCommerce\VendorOverride\Validation\FileValidator;
use EdmondsCommerce\VendorOverride\Validation\VersionValidator;

/**
 * Class ApplyHotFixes
 * @package EdmondsCommerce\VendorOverride
 * Apply all hot fixes in this modules vendor directory to the canonical Composer vendor directory
 * Retain original files and apply a suffic of ".orig" for backup purposes
 * Should notify user of static-content:deploy / di:compile / cache:flush requirement following update
 *
 *
 */
class ApplyHotFixes
{

    public static $overridePath;
    public static $vendorPath;

    public static function run()
    {
        //Set paths
        self::$overridePath = dirname(__DIR__, 1).'/overrides/';
        self::$vendorPath = dirname(__DIR__, 3);

        $versionValidator = new VersionValidator();
        $fileValidator = new FileValidator(self::$overridePath, self::$vendorPath);

        //Build the list of files
        $factory = new OverrideCollectionFactory();
        $overrides = $factory->make(self::$overridePath, self::$vendorPath);


        /*
        $copyCheck = true;
        foreach($files as $file)
        {
            $source = self::$overridePath.$file;
            $destination = self::$vendorPath.'/'.$file;

            echo "Rewriting: ".$destination."...\n";
            //Backup the original file
            if(!copy($destination, $destination.'.orig'))
            {
                echo 'Could not back up to '.$destination.'.orig';
                $copyCheck = false;
            }
            //Overwrite the file
            if(!copy($source, $destination))
            {
                echo 'Could not copy to file '.$destination."\n";
                $copyCheck = false;
            }
        }

        return $copyCheck;*/
    }
}



