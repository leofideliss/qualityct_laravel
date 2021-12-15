<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert(['name' => 'Acre']);
        DB::table('states')->insert(['name' => 'Alagoas']);
        DB::table('states')->insert(['name' => 'Amapá']);
        DB::table('states')->insert(['name' => 'Amazonas']);
        DB::table('states')->insert(['name' => 'Bahia']);
        DB::table('states')->insert(['name' => 'Ceará']);
        DB::table('states')->insert(['name' => 'Distrito Federal']);
        DB::table('states')->insert(['name' => 'Espirito Santo']);
        DB::table('states')->insert(['name' => 'Goiás']);
        DB::table('states')->insert(['name' => 'Mato Grosso']);
        DB::table('states')->insert(['name' => 'Minas Gerais']);
        DB::table('states')->insert(['name' => 'Pará']);
        DB::table('states')->insert(['name' => 'Paraiba']);
        DB::table('states')->insert(['name' => 'Parana']);
        DB::table('states')->insert(['name' => 'São Paulo']);


        DB::table('cities')->insert(['name' => 'Pres Prudente', 'id_state' => 1]);
        DB::table('cities')->insert(['name' => 'Pres Epitacio', 'id_state' => 1]);
        DB::table('cities')->insert(['name' => 'Pres Venceslau', 'id_state' => 1]);

        DB::table('addresses')->insert([
            'CEP' => '19027185',
            'id_state' => 'SP',
            'id_city' => 'Presidente Prudente',
            'street' => 'Rua Maria Sebastiana',
            'number' => 416,
            'neighborhoods' => 'Jd. São Paulo',
            'complements' => 'Casa',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('clients')->insert([
            'id_address'=> 1,
            'company_name' => 'Curtume Touro',
            'CNPJ' => '46.432.019/0001-08',
            'contact_name' => 'Leonardo',
            'phone' => '99709-4034',
            'email' => 'leofipp@hotmail.com',
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('type_users')->insert(['name' => 'Admin',]);
        DB::table('type_users')->insert(['name' => 'Diretor',]);
        DB::table('type_users')->insert(['name' => 'Químico',]);

        DB::table('leather_types')->insert(['name' => 'Acabado',]);
        DB::table('leather_types')->insert(['name' => 'Semi-acabado',]);

        DB::table('segments')->insert(['name' => 'Moveleiro',]);
        DB::table('segments')->insert(['name' => 'Cabedal Esportivo',]);
        DB::table('segments')->insert(['name' => 'Automotivo',]);


        DB::table('users')->insert([
            'login' => 'teste',
            'email' => 'teste',
            'password' => Hash::make('1234'),
            'created_at' => '2020-12-31 23:59:59',
            'updated_at' => '2020-12-31 23:59:59',
            'id_type_user' => 1,
        ]);

        DB::table('users')->insert([
            'login' => 'admin',
            'email' => 'admin',
            'password' => Hash::make('admin'),
            'created_at' => '2020-12-31 23:59:59',
            'updated_at' => '2020-12-31 23:59:59',
            'id_type_user' => 1,
        ]);

        DB::table('users')->insert([
            'login' => 'dir',
            'email' => 'dir',
            'password' => Hash::make('1234'),
            'created_at' => '2020-12-31 23:59:59',
            'updated_at' => '2020-12-31 23:59:59',
            'id_type_user' => 2,
        ]);

        DB::table('users')->insert([
            'login' => 'estefania',
            'email' => 'laboratorio@curtumetouro.com.br',
            'password' => Hash::make('050521'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'id_type_user' => 3,
        ]);

        DB::table('products')->insert([
            'description' => 'Latego chocolate',
            'color' => 'Chocolate',
            'article' => 'Latego',
            'thickness' => '11/11 MM',
            'id_client' => 1,
            'id_segment' => 1,
            'id_leather_type' => 1,
            'created_at' => '2020-12-31 23:59:59',
            'updated_at' => '2020-12-31 23:59:59',
        ]);

        DB::table('samples')->insert([
            'op_number' => 186084,
            'measure' => '29,7 x 21 cm (A4)',
            'date_col' => date("Y-m-d H:i:s"),
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
            'obs' => 'Couro reparado',
            'id_client' => 1,
            'id_product' => 1,
            'status' => 'nao definido',
        ]);

        DB::table('experiments')->insert([[
            'name' => 'Tração',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Alongamento',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Abrasão',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Pirrolidona',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Rasgamento',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Tropical teste',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'PVC carnal',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'PVC flor',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Solidez UV',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Solidez solar',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Envelhecimento acelerado',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Lastômetro',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Maeser',
            'id_leather_type' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Fricção seco',
            'id_leather_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Fricção úmido',
            'id_leather_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Flexão',
            'id_leather_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Tração',
            'id_leather_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Alongamento',
            'id_leather_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Rasgamento',
            'id_leather_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

        DB::table('experiments')->insert([[
            'name' => 'Adesão',
            'id_leather_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);

      
    }
}
