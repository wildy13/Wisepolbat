<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Cache\Repository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Petugas::create([
            'name' => 'Admin',
            'username' => 'admin01',
            'password' => bcrypt(11111),
            'email' => 'wisepolibatam@gmail.com',
            'is_admin' => TRUE
        ]);

        Petugas::create([
            'name' => 'Manajemen',
            'username' => 'manajemen01',
            'password' => bcrypt(11111),
            'email' => 'manajemenpolibatam@gmail.com',
            'is_management' => TRUE
        ]);

        Petugas::create([
            'name' => 'Tim Investigasi',
            'username' => 'investigasi01',
            'password' => bcrypt(11111),
            'email' => 'investigasipolibatam@gmail.com',
            'is_investigation_team' => TRUE
        ]);

        User::create([
            'id' => 1,
            'name' => 'Jodi Kurniawan',
            'nim_or_nid' => '3312001105',
            'email' => 'paklong0011@gmail.com',
            'password' => bcrypt(11111),
            'is_internal' => TRUE,
            'email_verified_at' => Carbon::now(),
            'email_verification_code' => Str::random(40)
        ]);

        Report::create([
            'id' => 1,
            'user_id' => 1,
            'title' => 'Korupsi Dana Bansos',
            'category' => 'Tindak Pidana Korupsi',
            'suspect' => 'Dodi Zulkarnain,Dosen,PNS;Ahmad Sobirin,Direktur 1,PNS;',
            'status' => 'Investigasi',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci corrupti, culpa inventore voluptates non vel assumenda reiciendis sint illo, vitae hic consectetur vero doloremque eum numquam ratione minus, deserunt impedit autem? A cumque harum earum, quidem consequatur suscipit nemo, molestiae atque quo corrupti, aliquam natus ullam expedita alias sapiente placeat!',
        ]);
    }
}
