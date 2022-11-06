<?php

namespace Database\Seeders;

use App\Models\Detail_data;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Detail_data::factory()->create([
            'id_user'=>1,
            'alamat'=>'Kost Griya Berkah, jebres',
            'tempat_lahir'=>'Pemalang',
            'tanggal_lahir'=>"2003-04-11",
            'id_agama'=>1,
            'foto_ktp'=>'azra.jpg',
            'umur'=>20
        ]);
    }
}
