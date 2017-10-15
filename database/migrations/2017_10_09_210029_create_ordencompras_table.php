<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdencomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordencompras', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('no_ocp');
			$table->string('cnp_ocp');
			$table->string('aut_ocp');
			$table->string('form_pag');
			$table->string('dia_cred');
			$table->string('tim_entr');
			$table->string('otr_ocp');
			$table->double('subt_ocp');
			$table->double('iva_ocp');
			$table->double('tol_ocp');
			$table->string('obv_ocp');
			
			$table->integer('empre_id')->unsigned()->index();
            $table->foreign('empre_id')->references('id')->on('configuracions') ->onUpdate('cascade') ->onDelete('cascade');
			
			$table->integer('prov_id')->unsigned()->index();
            $table->foreign('prov_id')->references('id')->on('proveedors') ->onUpdate('cascade') ->onDelete('cascade');
		
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
        Schema::dropIfExists('ordencompras');
    }
}