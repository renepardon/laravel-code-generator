<?php

namespace Renepardon\CodeGenerator\Commands\Bases;

use Illuminate\Console\Command;
use Renepardon\CodeGenerator\Models\Resource;
use Renepardon\CodeGenerator\Support\Config;
use Renepardon\CodeGenerator\Traits\CommonCommand;

class ResourceFileCommandBase extends Command
{
    use CommonCommand;

    /**
     * Gets the resource from the given file
     *
     * @param string $file
     * @param array  $languages
     *
     * @return Renepardon\CodeGenerator\Models\Resource
     */
    protected function getResources($file, array $languages = [])
    {
        return Resource::fromJson($this->getFileContent($file), 'lcg', $languages);
    }

    /**
     * Gets the destenation filename.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getFilename($name)
    {
        $path = base_path(Config::getResourceFilePath());

        return $path . $name;
    }

    /**
     * Display a common error
     *
     * @return void
     */
    protected function noResourcesProvided()
    {
        $this->error('Nothing to append was provided! Please use the --fields, --relations, or --indexes to append to file.');
    }
}
