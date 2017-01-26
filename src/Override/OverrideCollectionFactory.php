<?php namespace EdmondsCommerce\M2HotFixes\Override;

class OverrideCollectionFactory
{

    public function make($overridePath)
    {
        $dirIter = new \DirectoryIterator($overridePath);
        $files = $this->searchDir($dirIter);
        $files = $this->collapseDirArray($files);
        $this->filterFiles($files);
    }


    /**
     * Prepare file lists
     */
    protected function filterFiles($files)
    {
        $md5Files = [];
        $overrideFiles = [];

        foreach($files as $path)
        {
            if(preg_match('/(.+)\.md5$/', $path) === 1)
            {
                $md5Files[] = $path;
            }
            else
            {
                $overrideFiles[] = $path;
            }
        }

        //Group in to override objects
        $result = [];
        foreach($overrideFiles as $overrideFile)
        {
            foreach($md5Files as $md5File)
            {
                if(strpos($md5File, $overrideFile) !== false)
                {
                    $result[] = new Override()
                }
            }
        }
    }

    protected function collapseDirArray(array $tree, $prefix = '')
    {
        $result = [];
        foreach ($tree as $key => $value)
        {
            if (is_array($value))
            {
                $result = $result + $this->collapseDirArray($value,   $prefix.'/'.$key);
            }
            else
            {
                $result[] =  preg_replace('/^overrides\//', '' ,trim($prefix.'/'. $value, '/'));
            }
        }

        return $result;
    }

    protected function searchDir(\DirectoryIterator $directoryIterator)
    {
        $files = [];
        foreach ($directoryIterator as $node)
        {
            if ($node->isDir() && !$node->isDot())
            {
                $files[basename($node->getPath())] = $this->searchDir(new \DirectoryIterator($node->getPathname()));
                continue;
            }

            if ($node->isDot())
            {
                continue;
            }

            $files[basename($node->getPath())][] = $node->getFilename();
        }

        return $files;
    }
}