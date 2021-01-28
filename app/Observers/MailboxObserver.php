<?php

namespace App\Observers;

use App\Mailbox;
use App\Traits\IntegrationObserverTrait;

class MailboxObserver
{
    use IntegrationObserverTrait;

    /**
     * Listen to the Mailbox creating event.
     *
     * @param Mailbox $mailbox
     * @return void
     */
    public function creating(Mailbox $mailbox)
    {
        if (config('mum.mailboxes.homedir')) {
            $mailbox->homedir = getHomedirForMailbox($mailbox->local_part, $mailbox->domain->domain);
        }
        if (config('mum.mailboxes.maildir')) {
            $mailbox->maildir = getMaildirForMailbox($mailbox->local_part, $mailbox->domain->domain);
        }
    }
}
