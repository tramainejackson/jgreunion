<?php

namespace App\Mail;

use App\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Registration_User extends Mailable
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
    public function __construct(Registration $registration, $reunion, $total_adults, $total_youth, $total_children)
    {
        $this->registration = $registration;
        $this->totalYouths = $total_youth;
        $this->totalAdults = $total_adults;
        $this->totalChildren = $total_children;
        $this->reunion = $reunion;
		$this->adults = explode('; ', $this->registration->adult_names);
		$this->youths = explode('; ', $this->registration->youth_names);
		$this->childs = explode('; ', $this->registration->child_names);
		$this->shirtSizes = explode('; ', $this->registration->shirt_sizes);
		$this->adultSizes = array_slice($this->shirtSizes, 0, count($this->adults));
		$this->youthSizes = array_slice($this->shirtSizes, count($this->adults), count($this->youths));
		$this->childrenSizes = array_slice($this->shirtSizes, (count($this->adults) + count($this->youths)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->reunion->reunion_year . ' Reunion Registration')->view('emails.new_message', compact('reunion', 'registration', 'totalYouths', 'totalAdults', 'totalChildren', 'adultSizes', 'youthSizes', 'childrenSizes'));
    }
}
