<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18/03/19
 * Time: 3:20 AM
 */

namespace Renepardon\CodeGenerator\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return ['Renepardon\CodeGenerator\CodeGeneratorServiceProvider'];
    }
}
