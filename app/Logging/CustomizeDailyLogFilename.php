<?php
// app/Logging/CustomizeDailyLogFilename.php
namespace App\Logging;

use Monolog\Logger;

class CustomizeDailyLogFilename
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            if (method_exists($handler, 'setFilenameFormat')) {
                $handler->setFilenameFormat('laravel-{date}', 'Y-m-d');
            }
        }
    }
}