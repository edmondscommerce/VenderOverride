<?php namespace EdmondsCommerce\VendorOverride\Validation\File;

class MD5
{
    /**
     * Compare two file's MD5 values
     * @param $file1
     * @param $file2
     *
     * @return bool
     */
    public function compareFiles($file1, $file2)
    {
        return ($this->getFileMd5($file1) == $this->getFileMd5($file2));
    }

    /**
     * Get a file's MD5
     * @param string $filePath
     * @return string
     * @throws \Exception
     */
    public function getFileMd5($filePath)
    {
        $file = file_get_contents($filePath);
        if(!$file)
        {
            throw new \Exception('Could not get file to check MD5: '. $filePath);
        }

        return md5($file);
    }

    /**
     * Compare a file's MD5 to a string MD5
     *
     * @param string $file
     * @param string $md5
     *
     * @return bool
     */
    public function compareFileToMD5($file, $md5)
    {
        return ($this->getFileMd5($file) == $md5);
    }
}