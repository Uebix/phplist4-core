<?php
declare(strict_types=1);

namespace PhpList\PhpList4\Tests\System\ApplicationBundle;

use PhpList\PhpList4\Tests\Integration\Domain\Repository\AbstractRepositoryTest;
use PhpList\PhpList4\Tests\Support\Traits\MinkTestTrait;
use PhpList\PhpList4\Tests\Support\Traits\PhpServerTrait;

/**
 * Testcase.
 *
 * @author Oliver Klee <oliver@phplist.com>
 */
class PhpListApplicationBundleTest extends AbstractRepositoryTest
{
    use MinkTestTrait;
    use PhpServerTrait;

    /**
     * @var string
     */
    const BASE_URL = 'http://localhost:8000/';

    /**
     * @test
     */
    public function homepageContainsHelloWorld()
    {
        $page = $this->visit(self::BASE_URL . 'index_testing.php');

        $this->assertContains('Hello world!', $page->getHtml());
    }
}
