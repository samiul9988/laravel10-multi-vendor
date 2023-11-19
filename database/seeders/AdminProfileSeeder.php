<?php

namespace Database\Seeders;

use App\Models\Vendor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where( 'email', 'rihox@mailinator.com' )->first();
        $vendor = new Vendor();
        $vendor->banner         = 'upload/123.jpg';
        $vendor->phone          = '01822245144';
        $vendor->email          = 'rihox@mailinator.com';
        $vendor->address        = 'bangladesh';
        $vendor->description    = 'shop Description';
        $vendor->user_id        = $user->id;
        $vendor->save();
    }
}
