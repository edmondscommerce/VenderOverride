<?php namespace EdmondsCommerce\VendorOverride\Override;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class OverrideCollectionFactory
{

    public function make($overridePath, $vendorPath)
    {
        $fs = new Filesystem(new Local($overridePath));
        $files = $fs->listContents($overridePath, true);
        $files = array_values(array_filter($files, function($file) {
            return ($file['type'] == 'file' && $file['extension'] != 'md5');
        }));

        $resultFiles = [];
        foreach($files as $file)
        {
            $resultFiles[] = new Override($file['path'], $file['path'].'.md5', $vendorPath.'/'.$file['path']);
        }

        return new OverrideCollection($resultFiles);
    }

}