<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Services\CrewPopulatorInterface;
use Illuminate\Database\Seeder;

class MovieCrewSeeder extends Seeder
{
    public function __construct(
        private readonly CrewPopulatorInterface $populator
    ) {}

    public function run(): void
    {
        $this->populator->populateCrew();
    }
}
