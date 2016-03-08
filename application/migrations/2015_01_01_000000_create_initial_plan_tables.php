<?php

class Create_Initial_Plan_Tables
{
	public function up()
	{
        Schema::create('plans', function($table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('email_address');
            $table->string('postcode');
            $table->string('dimensions');
            $table->integer('rows')->unsigned();
            $table->integer('columns')->unsigned();
        });

		Schema::create('plans_planoptions', function($table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->integer('planoption_id')->unsigned();
            $table->timestamps(); // required by default with laravel 3 :(
            $table->integer('row')->unsigned();
            $table->integer('column')->unsigned();
            $table->integer('quantity')->default(1)->unsigned();
        });
	}

	public function down()
	{
		Schema::drop('plans_planoptions');
		Schema::drop('plans');
	}

}