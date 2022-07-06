<?php

use Illuminate\Database\Seeder;

class ServiceApiShortLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_api_shortlink')->delete();

        $titleData = [
        	'123Link'
        ];
        
        $apiURL1 = 'https://123link.co/api?';
        foreach($titleData as $item){
        	factory(App\ServiceApiShortLink::class)->create([
        		'name_service' => $item,
                'key_service' => $item,
                'api_service_url' => $apiURL1
        	]);
        }
    }
}
