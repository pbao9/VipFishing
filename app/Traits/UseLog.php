<?php
namespace App\Traits;


use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

trait UseLog {
    /*   * Log an informational message.
     *
     * @param string $message The log message.
     * @param array $context Optional context data.
     */
    public function logInfo(string $message, array $context = []): void
    {
        Log::info($message, $context);
    }

    /**
     * Log an error message.
     *
     * @param string $message The log message.
     * @param Exception $e The exception to log.
     */
    public function logError(string $message, Throwable  $e): void
    {
        Log::error($message, [
            'exception' => $e->getMessage(),
        ]);
    }

    /**
     * Log a "not found" error.
     *
     * @param string $message The log message.
     * @param int|string $identifier The identifier that was not found.
     */
    public function logNotFound(string $message, int|string $identifier): void
    {
        Log::error($message, [
            'identifier' => $identifier
        ]);
    }

}
