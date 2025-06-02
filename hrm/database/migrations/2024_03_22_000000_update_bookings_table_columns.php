<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop existing columns if they exist
            if (Schema::hasColumn('bookings', 'check_in')) {
                $table->dropColumn('check_in');
            }
            if (Schema::hasColumn('bookings', 'check_out')) {
                $table->dropColumn('check_out');
            }

            // Add new columns if they don't exist
            if (!Schema::hasColumn('bookings', 'check_in_date')) {
                $table->date('check_in_date')->after('room_id');
            }
            if (!Schema::hasColumn('bookings', 'check_out_date')) {
                $table->date('check_out_date')->after('check_in_date');
            }
            if (!Schema::hasColumn('bookings', 'guests')) {
                $table->integer('guests')->after('check_out_date');
            }
            if (!Schema::hasColumn('bookings', 'special_requests')) {
                $table->text('special_requests')->nullable()->after('status');
            }
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn(['check_in_date', 'check_out_date', 'guests', 'special_requests']);
            
            // Add back old columns
            $table->date('check_in')->after('room_id');
            $table->date('check_out')->after('check_in');
        });
    }
}; 