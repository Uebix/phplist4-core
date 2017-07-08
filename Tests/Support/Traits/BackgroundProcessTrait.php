<?php
declare(strict_types=1);

namespace PhpList\PhpList4\Tests\Support\Traits;

use Symfony\Component\Process\Process;

/**
 * Trait for creating background PHP processes.
 *
 * @author Oliver Klee <oliver@phplist.com>
 */
trait BackgroundProcessTrait
{
    /**
     * @var Process
     */
    private static $process = null;

    /**
     * @beforeClass
     *
     * @return void
     */
    public static function startBackgroundProcess()
    {
        self::$process = new Process(self::getCommand());
        self::$process->start();
    }

    /**
     * @before
     *
     * @return void
     *
     * @throws \RuntimeException if the process is not running
     */
    public static function verifyBackgroundProcessStarted()
    {
        $process = self::$process;
        if (!$process->isRunning()) {
            throw new \RuntimeException(
                sprintf(
                    'Failed to start "%s" in background: %s',
                    $process->getCommandLine(),
                    $process->getErrorOutput()
                ),
                1499505529737
            );
        }
    }

    /**
     * @afterClass
     *
     * @return void
     */
    public static function stopBackgroundProcess()
    {
        self::$process->stop();
    }

    /**
     * @after
     *
     * @return void
     */
    public function clearBackgroundProcessOutput()
    {
        self::$process->clearOutput();
        self::$process->clearErrorOutput();
    }

    /**
     * Returns a command to run in background.
     *
     * @return string
     */
    abstract protected static function getCommand(): string;
}
