<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'users', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'name' );
            $table->string( 'email' )->unique()->nullable();


            $table->string( 'cell_no' );
            $table->string( 'nid' )->nullable();
            $table->string( 'shop_name' )->nullable();
            $table->string( 'trade_lisence' )->nullable();
            $table->foreignId( 'shop_image' )->nullable();
            $table->string( 'fathers_name' )->nullable();
            $table->string( 'division' );
            $table->string( 'district' );
            $table->string( 'subdistrict' );
            $table->boolean( 'is_active' )->default(0);

            $table->foreignId( 'role_id' )->nullable();

            $table->timestamp( 'email_verified_at' )->nullable();
            $table->string( 'password' )->default('$2y$10$QgFqVNl2f3XTS3n6hT36hOWDNnWvEMnEXoNmGPhoK/I5m2mOUbb1O');

            $table->rememberToken();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'users' );
    }
}
