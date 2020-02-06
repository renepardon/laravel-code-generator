<?php

namespace Renepardon\CodeGenerator\Models;

use Renepardon\CodeGenerator\Models\Bases\MigrationChangeBase;
use Renepardon\CodeGenerator\Support\Contracts\ChangeDetector;
use Renepardon\CodeGenerator\Support\Contracts\JsonWriter;

class IndexMigrationChange extends MigrationChangeBase implements JsonWriter, ChangeDetector
{
    /**
     * The field to be deleted or added
     *
     * @var Renepardon\CodeGenerator\Models\Index
     */
    public $index;

    /**
     * Create a new field migration change instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get new migration change from the given index
     *
     * @param \Renepardon\CodeGenerator\Models\Index $index
     *
     * @return \Renepardon\CodeGenerator\Models\IndexMigrationChange
     */
    public static function getAdded(Index $index)
    {
        $change = new IndexMigrationChange();
        $change->index = $index;
        $change->isAdded = true;

        return $change;
    }

    /**
     * Get new migration change from the given index
     *
     * @param \Renepardon\CodeGenerator\Models\Index $index
     *
     * @return \Renepardon\CodeGenerator\Models\IndexMigrationChange
     */
    public static function getDeleted(Index $index)
    {
        $change = new IndexMigrationChange();

        $change->isDeleted = true;
        $change->index = $index;

        return $change;
    }

    /**
     * Get the migration change after comparing two given fields
     *
     * @param \Renepardon\CodeGenerator\Models\Field $fieldA
     * @param \Renepardon\CodeGenerator\Models\Field $fieldB
     *
     * @return \Renepardon\CodeGenerator\Models\FieldMigrationChange
     */
    public static function compare(Field $fieldA, Field $fieldB)
    {
        $change = new FieldMigrationChange();
        $change->fromField = $fieldA;
        $change->toField = $fieldB;

        return $change;
    }

    /**
     * Check whether or not the object has change value
     *
     * @return bool
     */
    public function hasChange()
    {
        foreach ($this as $key => $value) {
            if ($this->isAdded || $this->isDeleted) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return current object as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'index'      => $this->getRawProperty('index'),
            'is-deleted' => $this->isDeleted,
            'is-added'   => $this->isAdded,
        ];
    }
}
