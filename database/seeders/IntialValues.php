<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class IntialValues extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('migrate:fresh');

        $user = User::create([
            'name'                => 'Kalyana Krishna Kondapalli',
            'email'               => 'kkrishnakondapalli@gmail.com',
            'contact'             => '+91998996666',
            'qualification'       => 'MSc(IT)',
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'years_of_experience' => '14',
            'skills' => ['Laravel', 'PHP', 'Python', 'React', 'Vuejs'],
            'about_me'            => 'Having 14+ years of experience as a Full-stack developer, Technical Lead, and Scrum manager.',
            'nature'              => 'Will bring my expertise to the organization in such a way that it will help me in growth and 
            provide support for the leads as well as developers in achieving their long and short term goals.',
        ]);

        $user->company()->create([
            'company_name'       => 'TTEC Digital Pvt Ltd',
            'role'               => 'Systems Principal Software Engineer',
            'start_date'         => now()->parse('2020-03-27'),
            'is_current_working' => 1,
            'job_nature'         => 'Full Stack Developer, Tech Lead and Scrum Manager',
        ]);

        Artisan::call('storage:link');
    }
}
