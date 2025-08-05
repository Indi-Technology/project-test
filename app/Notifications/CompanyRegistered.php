<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyRegistered extends Notification
{
	use Queueable;

	protected $company;

	/**
	 * Create a new notification instance.
	 */
	public function __construct($company)
	{
		$this->company = $company;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array<int, string>
	 */
	public function via(object $notifiable): array
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 */
	public function toMail(object $notifiable): MailMessage
	{
		\Log::info('Sending notification to: ' . $notifiable->email);
		\Log::info('Company: ' . $this->company->name);

		return (new MailMessage)
			->subject('New Company Registered')
			->greeting('Hello ' . $notifiable->name . ',')
			->line('A new company has just been added to the system.')
			->line('Company Name: ' . $this->company->name)
			->action('View Company', url('/companies/' . $this->company->id))
			->line('Please review the details or assign necessary actions.');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(object $notifiable): array
	{
		return [
			//
		];
	}
}
