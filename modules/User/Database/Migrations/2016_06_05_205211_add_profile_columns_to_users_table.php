<?php

use Illuminate\Database\Schema\Blueprint;
use KekecMed\Core\Abstracts\Database\Migrations\AbstractMigration;

/**
 * Class AddProfileColumnsToUsersTable
 * -----------------------------
 * This migration adds profile related fields
 * to the users table
 * -----------------------------
 *
 * @author Selcuk Kekec <senycorp@googlemail.com>
 */
class AddProfileColumnsToUsersTable extends AbstractMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->getTableName(), function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'firstname')) {
                $table->string('firstname');
            }

            if (!Schema::hasColumn('users', 'lastname')) {
                $table->string('lastname');
            }

            if (!Schema::hasColumn('users', 'online')) {
                $table->boolean('online')->default(true);
            }

            if (!Schema::hasColumn('users', 'setting')) {
                $table->json('setting');
            }

            if (!Schema::hasColumn('users', 'image')) {
                $table->string('image');
            }
        });
    }

    /**
     * Get Table Name as String
     *
     * @return string
     */
    protected function getTableName()
    {
        return 'users';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->getTableName(), function (Blueprint $table) {
            if (Schema::hasColumn('users', 'firstname')) {
                $table->dropColumn('firstname');
            }

            if (Schema::hasColumn('users', 'lastname')) {
                $table->dropColumn('lastname');
            }

            if (Schema::hasColumn('users', 'online')) {
                $table->dropColumn('online')->default(true);
            }

            if (Schema::hasColumn('users', 'setting')) {
                $table->dropColumn('setting')->default('{}');
            }

            if (Schema::hasColumn('users', 'image')) {
                $table->dropColumn('image');
            }

            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
}
