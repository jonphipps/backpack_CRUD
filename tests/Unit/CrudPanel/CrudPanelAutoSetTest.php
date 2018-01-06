<?php

namespace Backpack\CRUD\Tests\Unit\CrudPanel;

use Backpack\CRUD\Tests\Unit\Models\ColumnType;
use Backpack\CRUD\Tests\Unit\Models\User;

class CrudPanelAutoSetTest extends BaseDBCrudPanelTest
{
    private $expectedUnknownFieldType = 'text';

    private $expectedFieldTypeFromColumnType = [
        'bigIntegerCol' => 'number',
        'binaryCol' => 'text',
        'booleanCol' => 'boolean',
        'charCol' => 'text',
        'dateCol' => 'date',
        'dateTimeCol' => 'datetime',
        'dateTimeTzCol' => 'datetime',
        'decimalCol' => 'number',
        'doubleCol' => 'number',
        'enumCol' => 'text',
        'floatCol' => 'number',
        'integerCol' => 'number',
        'ipAddressCol' => 'text',
        'jsonCol' => 'textarea',
        'jsonbCol' => 'textarea',
        'longTextCol' => 'textarea',
        'macAddressCol' => 'text',
        'mediumIntegerCol' => 'number',
        'mediumTextCol' => 'textarea',
        'smallIntegerCol' => 'number',
        'stringCol' => 'text',
        'textCol' => 'textarea',
        'timeCol' => 'time',
        'timeTzCol' => 'time',
        'tinyIntegerCol' => 'number',
        'timestampCol' => 'datetime',
        'timestampTzCol' => 'datetime',
        'uuidCol' => 'text',
    ];

    private $expectedColumnTypesFromDb = [
        'bigIntegerCol' => [
            'type' => 'integer',
            'default' => '',
        ],
        'binaryCol' => [
            'type' => 'blob',
            'default' => '',
        ],
        'booleanCol' => [
            'type' => 'boolean',
            'default' => '',
        ],
        'charCol' => [
            'type' => 'string',
            'default' => '',
        ],
        'dateCol' => [
            'type' => 'date',
            'default' => '',
        ],
        'dateTimeCol' => [
            'type' => 'datetime',
            'default' => '',
        ],
        'dateTimeTzCol' => [
            'type' => 'datetime',
            'default' => '',
        ],
        'decimalCol' => [
            'type' => 'decimal',
            'default' => '',
        ],
        'doubleCol' => [
            'type' => 'float',
            'default' => '',
        ],
        'enumCol' => [
            'type' => 'string',
            'default' => '',
        ],
        'floatCol' => [
            'type' => 'float',
            'default' => '',
        ],
        'integerCol' => [
            'type' => 'integer',
            'default' => '',
        ],
        'ipAddressCol' => [
            'type' => 'string',
            'default' => '',
        ],
        'jsonCol' => [
            'type' => 'text',
            'default' => '',
        ],
        'jsonbCol' => [
            'type' => 'text',
            'default' => '',
        ],
        'longTextCol' => [
            'type' => 'text',
            'default' => '',
        ],
        'macAddressCol' => [
            'type' => 'string',
            'default' => '',
        ],
        'mediumIntegerCol' => [
            'type' => 'integer',
            'default' => '',
        ],
        'mediumTextCol' => [
            'type' => 'text',
            'default' => '',
        ],
        'smallIntegerCol' => [
            'type' => 'integer',
            'default' => '',
        ],
        'stringCol' => [
            'type' => 'string',
            'default' => '',
        ],
        'textCol' => [
            'type' => 'text',
            'default' => '',
        ],
        'timeCol' => [
            'type' => 'time',
            'default' => '',
        ],
        'timeTzCol' => [
            'type' => 'time',
            'default' => '',
        ],
        'tinyIntegerCol' => [
            'type' => 'integer',
            'default' => '',
        ],
        'timestampCol' => [
            'type' => 'datetime',
            'default' => '',
        ],
        'timestampTzCol' => [
            'type' => 'datetime',
            'default' => '',
        ],
        'uuidCol' => [
            'type' => 'string',
            'default' => '',
        ],
    ];

    private $expectedColumnTypes = [
        'bigIntegerCol' => [
            'name' => 'bigIntegerCol',
            'label' => 'BigIntegerCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'binaryCol' => [
            'name' => 'binaryCol',
            'label' => 'BinaryCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'booleanCol' => [
            'name' => 'booleanCol',
            'label' => 'BooleanCol',
            'value' => null,
            'default' => null,
            'type' => 'boolean',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'charCol' => [
            'name' => 'charCol',
            'label' => 'CharCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'dateCol' => [
            'name' => 'dateCol',
            'label' => 'DateCol',
            'value' => null,
            'default' => null,
            'type' => 'date',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'dateTimeCol' => [
            'name' => 'dateTimeCol',
            'label' => 'DateTimeCol',
            'value' => null,
            'default' => null,
            'type' => 'datetime',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'dateTimeTzCol' => [
            'name' => 'dateTimeTzCol',
            'label' => 'DateTimeTzCol',
            'value' => null,
            'default' => null,
            'type' => 'datetime',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'decimalCol' => [
            'name' => 'decimalCol',
            'label' => 'DecimalCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'doubleCol' => [
            'name' => 'doubleCol',
            'label' => 'DoubleCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'enumCol' => [
            'name' => 'enumCol',
            'label' => 'EnumCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'floatCol' => [
            'name' => 'floatCol',
            'label' => 'FloatCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'integerCol' => [
            'name' => 'integerCol',
            'label' => 'IntegerCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'ipAddressCol' => [
            'name' => 'ipAddressCol',
            'label' => 'IpAddressCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'jsonCol' => [
            'name' => 'jsonCol',
            'label' => 'JsonCol',
            'value' => null,
            'default' => null,
            'type' => 'textarea',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'jsonbCol' => [
            'name' => 'jsonbCol',
            'label' => 'JsonbCol',
            'value' => null,
            'default' => null,
            'type' => 'textarea',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'longTextCol' => [
            'name' => 'longTextCol',
            'label' => 'LongTextCol',
            'value' => null,
            'default' => null,
            'type' => 'textarea',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'macAddressCol' => [
            'name' => 'macAddressCol',
            'label' => 'MacAddressCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'mediumIntegerCol' => [
            'name' => 'mediumIntegerCol',
            'label' => 'MediumIntegerCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'mediumTextCol' => [
            'name' => 'mediumTextCol',
            'label' => 'MediumTextCol',
            'value' => null,
            'default' => null,
            'type' => 'textarea',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'smallIntegerCol' => [
            'name' => 'smallIntegerCol',
            'label' => 'SmallIntegerCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'stringCol' => [
            'name' => 'stringCol',
            'label' => 'StringCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'textCol' => [
            'name' => 'textCol',
            'label' => 'TextCol',
            'value' => null,
            'default' => null,
            'type' => 'textarea',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'timeCol' => [
            'name' => 'timeCol',
            'label' => 'TimeCol',
            'value' => null,
            'default' => null,
            'type' => 'time',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'timeTzCol' => [
            'name' => 'timeTzCol',
            'label' => 'TimeTzCol',
            'value' => null,
            'default' => null,
            'type' => 'time',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'tinyIntegerCol' => [
            'name' => 'tinyIntegerCol',
            'label' => 'TinyIntegerCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'timestampCol' => [
            'name' => 'timestampCol',
            'label' => 'TimestampCol',
            'value' => null,
            'default' => null,
            'type' => 'datetime',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'timestampTzCol' => [
            'name' => 'timestampTzCol',
            'label' => 'TimestampTzCol',
            'value' => null,
            'default' => null,
            'type' => 'datetime',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'uuidCol' => [
            'name' => 'uuidCol',
            'label' => 'UuidCol',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
    ];

    private $expectedFieldsFromDb = [
        'bigIntegerCol' => [
            'name' => 'bigIntegerCol',
            'label' => 'Big Integer Col',
            'value' => null,
            'default' => null,
            'type' => 'number',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'binaryCol' => [
            'name' => 'binaryCol',
            'label' => 'Binary Col',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'booleanCol' => [
            'name' => 'booleanCol',
            'label' => 'Boolean Col',
            'value' => null,
            'default' => null,
            'type' => 'checkbox',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'charCol' => [
            'name' => 'charCol',
            'label' => 'Char Col',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'dateCol' => [
            'name' => 'dateCol',
            'label' => 'Date Col',
            'value' => null,
            'default' => null,
            'type' => 'date',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'dateTimeCol' => [
            'name' => 'dateTimeCol',
            'label' => 'Date Time Col',
            'value' => null,
            'default' => null,
            'type' => 'datetime',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'dateTimeTzCol' => [
            'name' => 'dateTimeTzCol',
            'label' => 'Date Time Tz Col',
            'value' => null,
            'default' => null,
            'type' => 'datetime',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'decimalCol' => [
            'name' => 'decimalCol',
            'label' => 'Decimal Col',
            'value' => null,
            'default' => null,
            'type' => 'number',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'doubleCol' => [
            'name' => 'doubleCol',
            'label' => 'Double Col',
            'value' => null,
            'default' => null,
            'type' => 'number',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'enumCol' => [
            'name' => 'enumCol',
            'label' => 'Enum Col',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'floatCol' => [
            'name' => 'floatCol',
            'label' => 'Float Col',
            'value' => null,
            'default' => null,
            'type' => 'number',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'integerCol' => [
            'name' => 'integerCol',
            'label' => 'Integer Col',
            'value' => null,
            'default' => null,
            'type' => 'number',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'ipAddressCol' => [
            'name' => 'ipAddressCol',
            'label' => 'Ip Address Col',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'jsonCol' => [
            'name' => 'jsonCol',
            'label' => 'Json Col',
            'value' => null,
            'default' => null,
            'type' => 'textarea',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'jsonbCol' => [
            'name' => 'jsonbCol',
            'label' => 'Jsonb Col',
            'value' => null,
            'default' => null,
            'type' => 'textarea',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'longTextCol' => [
            'name' => 'longTextCol',
            'label' => 'Long Text Col',
            'value' => null,
            'default' => null,
            'type' => 'textarea',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'macAddressCol' => [
            'name' => 'macAddressCol',
            'label' => 'Mac Address Col',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'mediumIntegerCol' => [
            'name' => 'mediumIntegerCol',
            'label' => 'Medium Integer Col',
            'value' => null,
            'default' => null,
            'type' => 'number',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'mediumTextCol' => [
            'name' => 'mediumTextCol',
            'label' => 'Medium Text Col',
            'value' => null,
            'default' => null,
            'type' => 'textarea',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'smallIntegerCol' => [
            'name' => 'smallIntegerCol',
            'label' => 'Small Integer Col',
            'value' => null,
            'default' => null,
            'type' => 'number',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'stringCol' => [
            'name' => 'stringCol',
            'label' => 'String Col',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'textCol' => [
            'name' => 'textCol',
            'label' => 'Text Col',
            'value' => null,
            'default' => null,
            'type' => 'textarea',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'timeCol' => [
            'name' => 'timeCol',
            'label' => 'Time Col',
            'value' => null,
            'default' => null,
            'type' => 'time',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'timeTzCol' => [
            'name' => 'timeTzCol',
            'label' => 'Time Tz Col',
            'value' => null,
            'default' => null,
            'type' => 'time',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'tinyIntegerCol' => [
            'name' => 'tinyIntegerCol',
            'label' => 'Tiny Integer Col',
            'value' => null,
            'default' => null,
            'type' => 'number',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'timestampCol' => [
            'name' => 'timestampCol',
            'label' => 'Timestamp Col',
            'value' => null,
            'default' => null,
            'type' => 'datetime',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'timestampTzCol' => [
            'name' => 'timestampTzCol',
            'label' => 'Timestamp Tz Col',
            'value' => null,
            'default' => null,
            'type' => 'datetime',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
        'uuidCol' => [
            'name' => 'uuidCol',
            'label' => 'Uuid Col',
            'value' => null,
            'default' => null,
            'type' => 'text',
            'values' => [],
            'attributes' => [],
            'autoset' => true,
        ],
    ];

    public function testGetFieldTypeFromDbColumnType()
    {
        $this->crudPanel->setModel(ColumnType::class);
        $this->crudPanel->setFromDb();

        $fieldTypesFromColumnType = [];
        foreach ($this->crudPanel->create_fields as $field) {
            $fieldTypesFromColumnType[] = $this->crudPanel->getFieldTypeFromDbColumnType($field['name']);
        }

        $this->assertEquals(array_values($this->expectedFieldTypeFromColumnType), $fieldTypesFromColumnType);
    }

    public function testSetFromDb()
    {
        $this->crudPanel->setModel(ColumnType::class);

        $this->crudPanel->setFromDb();

        $this->assertEquals($this->expectedFieldsFromDb, $this->crudPanel->create_fields);
        $this->assertEquals($this->expectedFieldsFromDb, $this->crudPanel->update_fields);
    }

    public function testGetDbColumnTypes()
    {
        $this->crudPanel->setModel(ColumnType::class);

        $columnTypes = $this->crudPanel->getDbColumnTypes();

        $this->assertEquals($this->expectedColumnTypesFromDb, $columnTypes);
    }

    public function testGetFieldTypeFromDbColumnTypeUnknownField()
    {
        $fieldType = $this->crudPanel->getFieldTypeFromDbColumnType('someFieldName1');

        $this->assertEquals($this->expectedUnknownFieldType, $fieldType);
    }

    public function testMakeLabel()
    {
        //$this->markTestIncomplete('Not correctly implemented');

        $idLabel = $this->crudPanel->makeLabel('id');
        $snakeCaseFKLabel = $this->crudPanel->makeLabel('id_user');
        $camelCaseFKLabel = $this->crudPanel->makeLabel('idUser');
        $camelCaseFKLabelReversed = $this->crudPanel->makeLabel('userId');
        $dateLabel = $this->crudPanel->makeLabel('created_at');
        $camelCaseLabel = $this->crudPanel->makeLabel('camelCaseLabel');
        $camelCaseRandomLabel = $this->crudPanel->makeLabel('camelCaseLabelRANDOMCase');
        $simpleLabel = $this->crudPanel->makeLabel('label');
        $snakeCaseLabel = $this->crudPanel->makeLabel('snake_case_label');
        $snakeCaseRandomLabel = $this->crudPanel->makeLabel('snake_Case_random_CASE');
        $allCapsLabel = $this->crudPanel->makeLabel('ALLCAPSLABEL');

        // TODO: the id label gets removed. it should not be removed if it is not followed by anything.
        // TODO: improve method documentation to know what to expect.
        $this->assertEquals('Id', $idLabel);
        $this->assertEquals('Id User', $snakeCaseFKLabel);
        $this->assertEquals('Id User', $camelCaseFKLabel);
        $this->assertEquals('User', $camelCaseFKLabelReversed);
        $this->assertEquals('Created', $dateLabel);
        $this->assertEquals('Camel Case Label', $camelCaseLabel);
        $this->assertEquals('Camel Case Label Random Case', $camelCaseRandomLabel);
        $this->assertEquals('Label', $simpleLabel);
        $this->assertEquals('Snake Case Label', $snakeCaseLabel);
        $this->assertEquals('Snake Case Random Case', $snakeCaseRandomLabel);
        $this->assertEquals('Allcapslabel', $allCapsLabel);
    }

    public function testMakeLabelEmpty()
    {
        $label = $this->crudPanel->makeLabel('');

        $this->assertEmpty($label);
    }

    public function testGetDbColumnsNames()
    {
        $this->crudPanel->setModel(ColumnType::class);

        $columnNames = $this->crudPanel->getDbColumnsNames();

        $this->assertEquals(array_keys($this->expectedColumnTypes), $columnNames);
    }

    public function testGetColumnTypeFromDbColumnType()
    {
        $this->crudPanel->setModel(ColumnType::class);
        $this->crudPanel->setFromDb();

        $this->assertEquals(\count($this->expectedColumnTypes), \count($this->crudPanel->columns));
        foreach ($this->crudPanel->columns as $key => $value) {
            $this->assertEquals($this->expectedColumnTypes[$key]['type'], $value['type']);
        }

    }

    public function testExcludeMetadataColumns()
    {
        $this->crudPanel->setModel(User::class);

        config(['backpack.crud.exclude_metadata_columns' => true]);
        $this->crudPanel->setFromDb();
        $this->assertCount(4, $this->crudPanel->columns);

        config(['backpack.crud.exclude_metadata_columns' => false]);
        $this->crudPanel->setFromDb();
        $this->assertCount(7, $this->crudPanel->columns);

    }
}
