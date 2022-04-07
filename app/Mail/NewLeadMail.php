<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewLeadMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lead;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Chegou um lead pegando 🔥 Bora vender! 🚀';
        $fromName = 'ArtisanCRM';

        return $this->subject($subject)->from('leads@leadsformulario.com.br', $fromName)->markdown('mails.leads.new-lead');
    }
}
