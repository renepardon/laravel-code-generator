<?php

namespace Renepardon\CodeGenerator\Tests;

use Renepardon\CodeGenerator\Support\FieldTransformer;

class FieldTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testEloquentDataMethodForBigInt()
    {
        $sourceString = 'name:foo_count;data-type:bigint';

        $fields = FieldTransformer::fromString($sourceString, 'generic');
        $this->assertTrue(is_array($fields) && 1 == count($fields));
        $field = $fields[0];

        $expected = 'bigInteger';
        $actual = $field->getEloquentDataMethod();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws \Exception
     */
    public function testEloquentDataMethodForBigInteger()
    {
        $sourceString = 'name:foo_count;data-type:biginteger';

        $fields = FieldTransformer::fromString($sourceString, 'generic');
        $this->assertTrue(is_array($fields) && 1 == count($fields));
        $field = $fields[0];

        $expected = 'bigInteger';
        $actual = $field->getEloquentDataMethod();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws \Exception
     */
    public function testAutoIncrementFalseIsHonouredWithUnderscores()
    {
        $this->markTestSkipped('somethings wrong here');
        $sourceString = 'name:id;data-type:varchar;is_primary:true;is_auto_increment:false;is_nullable:false;data-type-params:5000';

        $fields = FieldTransformer::fromString($sourceString, 'generic', []);
        $this->assertTrue(is_array($fields) && 1 == count($fields));
        $field = $fields[0];

        $this->assertFalse($field->isAutoIncrement);
    }

    /**
     * @throws \Exception
     */
    public function testAutoIncrementFalseIsHonouredWithHyphens()
    {
        $this->markTestSkipped('somethings wrong here');
        $sourceString = 'name:id;data-type:varchar;is-primary:true;is-auto-increment:false;is-nullable:false;data-type-params:5000';

        $fields = FieldTransformer::fromString($sourceString, 'generic', []);
        $this->assertTrue(is_array($fields) && 1 == count($fields));
        $field = $fields[0];

        $this->assertFalse($field->isAutoIncrement);
    }
}
