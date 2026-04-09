<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $staffRole = Role::where('name', 'staff')->first();

        $allMenus = Menu::all();
        $limitedMenus = Menu::where('name', 'Dashboard')->get();

        $adminRole->menus()->sync($allMenus->pluck('id')->toArray());
        $staffRole->menus()->sync($limitedMenus->pluck('id')->toArray());
    }
}
