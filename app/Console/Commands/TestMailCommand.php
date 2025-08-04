<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Mail\CompanyWelcomeMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test-company-welcome {email} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test company welcome email functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $name = $this->argument('name');
        
        // Buat company dummy untuk testing
        $company = new Company([
            'name' => $name,
            'email' => $email,
            'website' => 'https://example.com',
        ]);
        $company->created_at = now();
        
        try {
            $this->info('Sending test email to: ' . $email);
            Mail::to($email)->send(new CompanyWelcomeMail($company));
            $this->info('✅ Email sent successfully!');
            $this->info('Check your Mailtrap inbox to see the email.');
        } catch (\Exception $e) {
            $this->error('❌ Failed to send email: ' . $e->getMessage());
        }
    }
}
