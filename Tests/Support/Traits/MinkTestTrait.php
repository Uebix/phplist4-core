<?php
declare(strict_types=1);

namespace PhpList\PhpList4\Tests\Support\Traits;

use Behat\Mink\Driver\Goutte\Client as GoutteClient;
use Behat\Mink\Driver\GoutteDriver;
use Behat\Mink\Element\DocumentElement;
use Behat\Mink\Session;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Trait for creating system with Mink.
 *
 * @author Oliver Klee <oliver@phplist.com>
 */
trait MinkTestTrait
{
    /**
     * @var Session
     */
    private $session = null;

    /**
     * @before
     *
     * @return void
     */
    protected function createSession()
    {
        $client = new GoutteClient;

        $client->setClient(
            new GuzzleClient(
                [
                    'allow_redirects' => false,
                    'cookies' => true,
                    'verify' => false
                ]
            )
        );

        $this->session = new Session(new GoutteDriver($client));
    }

    /**
     * @param string $url
     *
     * @return DocumentElement
     */
    protected function visit(string $url): DocumentElement
    {
        $this->session->visit($url);

        return $this->session->getPage();
    }
}
