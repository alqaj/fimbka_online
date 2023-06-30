<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no', 50);
            $table->string('tujuan_pekerjaan', 50);
            $table->string('tujuan_alamat', 50);
            $table->string('jenis_kembali', 50);
            $table->string('kategori_keluar', 50);
            $table->string('jenis_barang', 50);
            $table->integer('created_by')->nullable();
            $table->integer('created_dept')->nullable();
            $table->integer('spv_app_by')->nullable();
            $table->integer('mgr_app_by')->nullable();
            $table->integer('it_app_by')->nullable();
            $table->integer('ga_app_by')->nullable();
            $table->timestamp('creation_date')->nullable();
            $table->timestamp('app_spv_date')->nullable();
            $table->timestamp('app_mgr_date')->nullable();
            $table->timestamp('app_it_date')->nullable();
            $table->timestamp('app_ga_date')->nullable();
            $table->staring('status', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('izin_table_migration');
    }
}
