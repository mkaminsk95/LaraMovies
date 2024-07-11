<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Validator;

class UpgradeToAdminUser extends Command implements PromptsForMissingInput
{

    protected $signature = 'app:admin:upgrade-user';
    protected $description = 'Command for upgrading an existing user to admin user.';

    public function __construct(
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $email = $this->ask('What is the email address of account you want to upgrade?');

        if (!$this->isEmailValid($email) || $this->checkIfAlreadyExists($email)) {
            return;
        }

        $this->info('Upgrading admin user...');
        $this->modifyAdminUser($email);

        $this->info('Admin user upgraded successfully.');
    }

    private function isEmailValid(string $email): bool
    {
        $validator = Validator::make([
            'email' => $email
        ], [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return false;
        }

        return true;
    }

    private function checkIfAlreadyExists(string $email): bool
    {
        if (!User::where('email', $email)->exists()) {
            $this->error('User with the given email does\'t exist.');
            return true;
        }

        return false;
    }

    private function modifyAdminUser(string $email): void
    {
        User::where('email', $email)->update(['is_admin' => true]);
    }
}
