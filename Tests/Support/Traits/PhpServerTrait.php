<?php
declare(strict_types=1);

namespace PhpList\PhpList4\Tests\Support\Traits;

/**
 * Trait for running the PHP server in the background.
 *
 * @author Oliver Klee <oliver@phplist.com>
 */
trait PhpServerTrait
{
    use BackgroundProcessTrait;

    /**
     * @return string
     */
    protected static function getCommand(): string
    {
        return self::getPhpServerCommand();
    }

    /**
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getPhpServerCommand(): string
    {
        $documentRoot = self::getPhpServerOption('document_root');
        self::checkDocumentRoot($documentRoot);

        return sprintf(
            'php -S %1$s:%2$d %3$s',
            self::getPhpServerOption('host'),
            self::getPhpServerOption('port'),
            $documentRoot
        );
    }

    /**
     * @return array
     */
    protected static function getPhpServerOptions(): array
    {
        return [
            'host' => 'localhost',
            'port' => 8000,
            'document_root' => dirname(__DIR__, 3) . '/web/',
        ];
    }

    /**
     * @param string $key
     * @param mixed|null $defaultValue
     *
     * @return mixed
     */
    private static function getPhpServerOption(string $key, $defaultValue = null)
    {
        $options = self::getPhpServerOptions();
        return array_key_exists($key, $options) ? $options[$key] : $defaultValue;
    }

    /**
     * Checks that $documentRoot exists, is a directory and readable.
     *
     * @param string $documentRoot
     *
     * @return void
     *
     * @throws \RuntimeException
     */
    private static function checkDocumentRoot(string $documentRoot)
    {
        if (!file_exists($documentRoot)) {
            throw new \RuntimeException('The document root "' . $documentRoot . '" does not exist.', 1499513246550);
        }
        if (!is_dir($documentRoot)) {
            throw new \RuntimeException(
                'The document root "' . $documentRoot . '" exists, but is no directory.',
                1499513263757
            );
        }
        if (!is_readable($documentRoot)) {
            throw new \RuntimeException(
                'The document root "' . $documentRoot . '" exists and is a directory, but is not readable.',
                1499513279590
            );
        }
    }
}
