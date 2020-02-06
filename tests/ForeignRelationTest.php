<?php

namespace Renepardon\CodeGenerator\Tests;

use Renepardon\CodeGenerator\Models\ForeignRelationship;

class ForeignRelationTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testAbilityToCreateRelationForSingleField()
    {
        $relation = ForeignRelationship::fromString("name:fooModel;is-nullable:true;data-type:varchar;type:BelongsTo;params:assets#hasMany#App\\Models\\Asset|category_id|id");

        // TODO, asset that the relation is created successfully!
        $this->assertTrue($relation instanceof ForeignRelationship);
    }

    /**
     * @throws \Exception
     */
    public function testAbilityToCreateRelationForSingleFieldNotNullable()
    {
        $relation = ForeignRelationship::fromString("name:fooModel;data-type:varchar;type:BelongsTo;params:assets#hasMany#App\\Models\\Asset|category_id|id");

        // TODO, asset that the relation is created successfully!
        $this->assertTrue($relation instanceof ForeignRelationship);
    }
}
