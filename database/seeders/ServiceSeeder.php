<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['name' => 'WiFi'], 
            ['name' => 'Posto Macchina'], 
            ['name' => 'Piscina'],
            ['name' => 'Portineria'], 
            ['name' => 'Sauna'], 
            ['name' => 'Vista Mare'],
            ['name' => 'Tv'],
            ['name' => 'Cucina'],
            ['name' => 'Lavatrice']
        ];

        foreach($services as $item){
            $service = new service();
            $service->name = $item['name'];
            $service->save();
        }
    }
}
