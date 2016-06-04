<?php

use Illuminate\Database\Seeder;

/**
 * Class DevelopmentSeeder
 * -----------------------------
 * This seeder is created for development
 * environments. It will create some dummy
 * data to quickly work with and start
 * active development without additional work.
 * -----------------------------
 * @author Selcuk Kekec <senycorp@googlemail.com>
 */
class DevelopmentSeeder extends Seeder
{

    /**
     * Count of records
     *
     * @var int
     */
    private $count = 10;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $filename = 'public/'.md5(time().'admin').'.jpg';

        Storage::put(
            $filename,
            file_get_contents('https://robohash.org/'.$filename)
        );

        /**
         * Create some users
         */
        DB::table('users')->insert([
            'firstname' => 'Admin',
            'email' => 'admin@kekecmed.com',
            'password' => bcrypt('admin'),
            'image' => str_replace('public/', '', $filename)
        ]);

        $filename = 'public/'.md5(time().'doctor').'.jpg';

        Storage::put(
            $filename,
            file_get_contents('https://robohash.org/'.$filename)
        );

        DB::table('users')->insert([
            'firstname' => 'Doctor',
            'email' => 'doctor@kekecmed.com',
            'password' => bcrypt('doctor'),
            'image' => str_replace('public/', '', $filename)
        ]);


        /**
         * Create dummy users
         */
        factory(App\User::class, 10)->create()->each(function($u) {
            $filename = 'public/'.md5(time().$u->password).'.jpg';

            Storage::put(
                $filename,
                file_get_contents('https://robohash.org/'.$filename)
            );

            $u->update(['password' => bcrypt('password'), 'image' => str_replace('public/', '', $filename)]);
        });

        /**
         * Create some patients
         */
        factory(App\Patient::class, 100)->create()->each(function($u) {
            $filename = 'public/'.md5(time().$u->password).'.jpg';

            Storage::put(
                $filename,
                file_get_contents('https://robohash.org/'.$filename)
            );

            $u->update(['image' => str_replace('public/', '', $filename)]);
        });

        $faker = new Faker\Generator();

        /**
         * Create Tasks
         */
        factory(App\Task::class, 200)->create()->each(function($u) use($faker) {
            $u->update([
                'creator_id' => $faker->numberBetween(1, 12),
                'assignee_id' => $faker->numberBetween(1, 12),
                'object_id' => $faker->numberBetween(1, 100),
            ]);
        });
    }
}
