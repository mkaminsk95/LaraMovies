<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AvatarSeeder extends Seeder
{
    public function run(): void
    {
        $avatars = Storage::disk('assets')->files('avatars');
        foreach ($avatars as $avatar) {
            try {
                Avatar::create([
                    'path' => basename($avatar)
                ]);
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}
