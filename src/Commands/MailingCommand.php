<?php

namespace Agencetwogether\Mailing\Commands;

use Illuminate\Console\Command;

class MailingCommand extends Command
{
    public $signature = 'mailing';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
