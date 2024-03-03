<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
			$table->string('project_name');
			$table->string('location');
			$table->string('locality');
			$table->integer('property_for_id');
			$table->integer('property_type_id');
			$table->integer('building_type_id');
			$table->integer('available_from_id');
			$table->integer('furnishing_status_id');
			$table->integer('age_of_property_id');
			$table->integer('property_view_id');
			$table->integer('measurement_id');
			$table->integer('price_type_id');
			$table->integer('security_deposit_id');
			$table->integer('amenity_id');
			$table->integer('no_of_bedrooms');
			$table->integer('no_of_bathrooms');
			$table->integer('no_of_parking');
		    $table->enum('bachelors_allowed', ['0', '1'])->default('1');
		    $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
