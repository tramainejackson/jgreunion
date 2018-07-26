<?php

namespace App\Mail;

use App\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Registration_Admin extends Mailable
{
    use Queueable, SerializesModels;
	
	/**
	* The variable instances
	*
	* @var contact
	*/
	public $registration;
	public $reunion;
	public $totalAdults;
	public $totalYouths;
	public $totalChildren;
	public $shirtSizes;
	public $adultSizes;
	public $youthSizes;
	public $childrenSizes;
	public $adults;
	public $youth;
	public $childs;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Registration $registration, $reunion)
    {
        $this->registration = $registration;
        $this->reunion = $reunion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {	
        return $this->subject($this->reunion->reunion_year . ' Online Reunion Registration')->view('emails.new_message', compact('reunion', 'registration'));
    }
}
