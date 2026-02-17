<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToContactsTable extends Migration
{
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('contacts', 'subject')) {
                $table->string('subject')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('contacts', 'message')) {
                $table->text('message')->nullable()->after('subject');
            }
            if (!Schema::hasColumn('contacts', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['phone', 'subject', 'message']);
        });
    }
}
