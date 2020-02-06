<?php

namespace Renepardon\CodeGenerator;

use File;
use Illuminate\Support\ServiceProvider;
use Renepardon\CodeGenerator\Support\Helpers;

class CodeGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $dir = __DIR__ . '/../';

        // publish the config base file
        $this->publishes([
            $dir . 'config/laravel-code-generator.php' => config_path('laravel-code-generator.php'),
        ], 'config');

        // publish the default-template
        $this->publishes([
            $dir . 'templates/default' => $this->codeGeneratorBase('templates/default'),
        ], 'default-template');

        // publish the defaultcollective-template
        $this->publishes([
            $dir . 'templates/default-collective' => $this->codeGeneratorBase('templates/default-collective'),
        ], 'default-collective-template');
    }

    /**
     * Get the laravel-code-generator base path
     *
     * @param string $path
     *
     * @return string
     */
    protected function codeGeneratorBase($path = null)
    {
        return base_path('resources/laravel-code-generator/') . $path;
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $commands =
            [
                'Renepardon\CodeGenerator\Commands\Framework\CreateControllerCommand',
                'Renepardon\CodeGenerator\Commands\Framework\CreateModelCommand',
                'Renepardon\CodeGenerator\Commands\Framework\CreateLanguageCommand',
                'Renepardon\CodeGenerator\Commands\Framework\CreateFormRequestCommand',
                'Renepardon\CodeGenerator\Commands\Framework\CreateRoutesCommand',
                'Renepardon\CodeGenerator\Commands\Framework\CreateMigrationCommand',
                'Renepardon\CodeGenerator\Commands\Framework\CreateScaffoldCommand',
                'Renepardon\CodeGenerator\Commands\Framework\CreateResourcesCommand',
                'Renepardon\CodeGenerator\Commands\Framework\CreateMappedResourcesCommand',
                'Renepardon\CodeGenerator\Commands\Resources\ResourceFileFromDatabaseCommand',
                'Renepardon\CodeGenerator\Commands\Resources\ResourceFileCreateCommand',
                'Renepardon\CodeGenerator\Commands\Resources\ResourceFileDeleteCommand',
                'Renepardon\CodeGenerator\Commands\Resources\ResourceFileAppendCommand',
                'Renepardon\CodeGenerator\Commands\Resources\ResourceFileReduceCommand',
                'Renepardon\CodeGenerator\Commands\Views\CreateIndexViewCommand',
                'Renepardon\CodeGenerator\Commands\Views\CreateCreateViewCommand',
                'Renepardon\CodeGenerator\Commands\Views\CreateFormViewCommand',
                'Renepardon\CodeGenerator\Commands\Views\CreateEditViewCommand',
                'Renepardon\CodeGenerator\Commands\Views\CreateShowViewCommand',
                'Renepardon\CodeGenerator\Commands\Views\CreateViewsCommand',
                'Renepardon\CodeGenerator\Commands\Views\CreateViewLayoutCommand',
                'Renepardon\CodeGenerator\Commands\Views\CreateLayoutCommand',
                'Renepardon\CodeGenerator\Commands\Api\CreateApiControllerCommand',
                'Renepardon\CodeGenerator\Commands\Api\CreateApiScaffoldCommand',
                'Renepardon\CodeGenerator\Commands\ApiDocs\CreateApiDocsControllerCommand',
                'Renepardon\CodeGenerator\Commands\ApiDocs\CreateApiDocsScaffoldCommand',
                'Renepardon\CodeGenerator\Commands\ApiDocs\CreateApiDocsViewCommand',
            ];

        $commands = array_merge($commands,
            [
                'Renepardon\CodeGenerator\Commands\Migrations\MigrateAllCommand',
                'Renepardon\CodeGenerator\Commands\Migrations\RefreshAllCommand',
                'Renepardon\CodeGenerator\Commands\Migrations\ResetAllCommand',
                'Renepardon\CodeGenerator\Commands\Migrations\RollbackAllCommand',
                'Renepardon\CodeGenerator\Commands\Migrations\StatusAllCommand',
            ]);

        if (Helpers::isApiResourceSupported()) {
            $commands = array_merge($commands,
                [
                    'Renepardon\CodeGenerator\Commands\Api\CreateApiResourceCommand',
                ]);
        }

        $this->commands($commands);
    }

    /**
     * Create a directory if one does not already exists
     *
     * @param string $path
     *
     * @return void
     */
    protected function createDirectory($path)
    {
        if (! File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
    }
}
