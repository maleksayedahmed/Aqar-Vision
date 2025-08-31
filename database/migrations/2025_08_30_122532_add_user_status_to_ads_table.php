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
Schema::table('ads', function (Blueprint $table) {
// New column for the user/agent to control
// It defaults to 'available' so existing active ads work correctly
$table->string('user_status')->default('available')->after('status');
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::table('ads', function (Blueprint $table) {
$table->dropColumn('user_status');
});
}
};