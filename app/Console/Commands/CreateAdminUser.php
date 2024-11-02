<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    protected $signature = 'app:admin:create-user';

    protected $description = 'Command for creating an admin user.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        echo 'test1';
        $email = $this->ask('What is your email?');
        $name = $this->ask('What is your name?');
        $password = $this->secret('What is the password?');
        $passwordConfirmed = $this->secret('Repeat the password?');

        if (! $this->isInputValid($email, $name, $password, $passwordConfirmed) ||
            $this->checkIfAlreadyExists($email, $name)) {
            echo 'test2';

            return;
        }

        $this->info('Creating admin user...');
        $this->createAdminUser($email, $name, $password);

        $this->info('Admin user created successfully. Remember to verify the email address.');
    }

    private function isInputValid(string $email, string $name, string $password, string $passwordConfirmed): bool
    {
        $validator = Validator::make([
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'password_confirmation' => $passwordConfirmed,
        ], [
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:8|max:255|confirmed',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return false;
        }

        return true;
    }

    private function checkIfAlreadyExists(string $email, string $name): bool
    {
        if (User::where('email', $email)->exists()) {
            $this->error('User with the given email already exists.');

            return true;
        }
        if (User::where('name', $name)->exists()) {
            $this->error('User with the given name already exists.');

            return true;
        }

        return false;
    }

    private function createAdminUser(string $email, string $name, string $password): void
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);
    }
}
