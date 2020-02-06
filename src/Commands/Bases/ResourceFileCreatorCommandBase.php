<?php

namespace Renepardon\CodeGenerator\Commands\Bases;

use Renepardon\CodeGenerator\Support\Arr;
use Renepardon\CodeGenerator\Support\Helpers;
use Renepardon\CodeGenerator\Support\Str;

class ResourceFileCreatorCommandBase extends ResourceFileCommandBase
{
    /**
     * Converts the current command's argument and options into an array.
     *
     * @return array
     */
    protected function getCommandOptions($input)
    {
        return [
            'model-name'          => $this->argument('model-name'),
            '--resource-filename' => $this->option('resource-filename'),
            '--fields'            => $this->option('fields'),
            '--translation-for'   => $this->option('translation-for'),
            '--relations'         => $this->option('relations'),
            '--indexes'           => $this->option('indexes'),
        ];
    }

    /**
     * Gets a clean user inputs.
     *
     * @return object
     */
    protected function getCommandInput()
    {
        $modelName = trim($this->argument('model-name'));
        $filename = trim($this->option('resource-filename'));
        $file = $filename ? Str::finish($filename, '.json') : Helpers::makeJsonFileName($modelName);
        $translationFor = array_unique(Arr::fromString($this->option('translation-for')));
        $fieldNames = array_unique(Arr::fromString($this->option('fields')));
        $relations = Arr::fromString($this->option('relations'));
        $indexes = Arr::fromString($this->option('indexes'));

        return (object)compact(
            'modelName',
            'file',
            'fieldNames',
            'indexes',
            'relations',
            'translationFor'
        );
    }

}
