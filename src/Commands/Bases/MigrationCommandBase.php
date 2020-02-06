<?php

namespace Renepardon\CodeGenerator\Commands\Bases;

use Illuminate\Console\Command;
use Renepardon\CodeGenerator\Traits\Migration;

class MigrationCommandBase extends Command
{
    use Migration;

    /**
     * Create a of the migration command.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->setMigrator();
    }

    protected function getMigratorNotes()
    {
        return $this->migrator->setOutput($this->output);
    }
}
