<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateColumnTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // uncomment the next statement to map strings to enum types in doctrine and get over the 'Unknown database type enum' DBAL error
        // Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        Schema::create('column_types', function ($table) {
            $table->bigInteger('bigintegercol');
            $table->binary('binarycol');
            $table->boolean('booleancol');
            $table->char('charcol', 4);
            $table->date('datecol');
            $table->dateTime('datetimecol');
            $table->dateTimeTz('datetimetzcol');
            $table->decimal('decimalcol', 5, 2);
            $table->double('doublecol', 15, 8);
            $table->enum('enumcol', ['foo', 'bar']);
            $table->float('floatcol');
            $table->integer('integercol');
            $table->ipAddress('ipaddresscol');
            $table->json('jsoncol');
            $table->jsonb('jsonbcol');
            $table->longText('longtextcol');
            $table->macAddress('macaddresscol');
            $table->mediumInteger('mediumintegercol');
            $table->mediumText('mediumtextcol');
            $table->smallInteger('smallintegercol');
            $table->string('stringcol');
            $table->text('textcol');
            $table->time('timecol');
            $table->timeTz('timetzcol');
            $table->tinyInteger('tinyintegercol');
            $table->timestamp('timestampcol');
            $table->timestampTz('timestamptzcol')->nullable();
            $table->uuid('uuidcol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('column_types');
    }
}
