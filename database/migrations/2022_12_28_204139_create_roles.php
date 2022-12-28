<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rolAdmin = Role::create(['name' => 'admin']);
        $rolUser = Role::create(['name' => 'user']);
        $user = User::find(1);
        $user->assignRole($rolAdmin);
        $user = User::find(3);
        $user->assignRole($rolUser);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};