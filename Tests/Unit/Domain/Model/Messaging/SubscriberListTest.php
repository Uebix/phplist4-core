<?php
declare(strict_types=1);

namespace PhpList\PhpList4\Tests\Unit\Domain\Model\Messaging;

use PhpList\PhpList4\Domain\Model\Messaging\SubscriberList;
use PhpList\PhpList4\Tests\Support\Traits\ModelTestTrait;
use PhpList\PhpList4\Tests\Support\Traits\SimilarDatesAssertionTrait;
use PHPUnit\Framework\TestCase;

/**
 * Testcase.
 *
 * @author Oliver Klee <oliver@phplist.com>
 */
class SubscriberListTest extends TestCase
{
    use ModelTestTrait;
    use SimilarDatesAssertionTrait;

    /**
     * @var SubscriberList
     */
    private $subject = null;

    protected function setUp()
    {
        $this->subject = new SubscriberList();
    }

    /**
     * @test
     */
    public function getIdInitiallyReturnsZero()
    {
        self::assertSame(0, $this->subject->getId());
    }

    /**
     * @test
     */
    public function getIdReturnsId()
    {
        $id = 123456;
        $this->setSubjectId($id);

        self::assertSame($id, $this->subject->getId());
    }

    /**
     * @test
     */
    public function getNameInitiallyReturnsEmptyString()
    {
        self::assertSame('', $this->subject->getName());
    }

    /**
     * @test
     */
    public function setNameSetsName()
    {
        $value = 'phpList releases';
        $this->subject->setName($value);

        self::assertSame($value, $this->subject->getName());
    }

    /**
     * @test
     */
    public function getDescriptionInitiallyReturnsEmptyString()
    {
        self::assertSame('', $this->subject->getDescription());
    }

    /**
     * @test
     */
    public function setDescriptionSetsDescription()
    {
        $value = 'Subscribe to this list when you would like to be notified of new phpList releases.';
        $this->subject->setDescription($value);

        self::assertSame($value, $this->subject->getDescription());
    }

    /**
     * @test
     */
    public function getCreationDateInitiallyReturnsNull()
    {
        self::assertNull($this->subject->getCreationDate());
    }

    /**
     * @test
     */
    public function updateCreationDateSetsCreationDateToNow()
    {
        $this->subject->updateCreationDate();

        self::assertSimilarDates(new \DateTime(), $this->subject->getCreationDate());
    }

    /**
     * @test
     */
    public function getModificationDateInitiallyReturnsNull()
    {
        self::assertNull($this->subject->getModificationDate());
    }

    /**
     * @test
     */
    public function updateModificationDateSetsModificationDateToNow()
    {
        $this->subject->updateModificationDate();

        self::assertSimilarDates(new \DateTime(), $this->subject->getModificationDate());
    }

//    /**
//     * @test
//     */
//    public function getEmailAddressInitiallyReturnsEmptyString()
//    {
//        self::assertSame('', $this->subject->getEmailAddress());
//    }
//
//    /**
//     * @test
//     */
//    public function setEmailAddressSetsEmailAddress()
//    {
//        $value = 'oliver@example.com';
//        $this->subject->setEmailAddress($value);
//
//        self::assertSame($value, $this->subject->getEmailAddress());
//    }
//
//    /**
//     * @test
//     */
//    public function getCreationDateInitiallyReturnsNull()
//    {
//        self::assertNull($this->subject->getCreationDate());
//    }
//
//    /**
//     * @test
//     */
//    public function updateCreationDateSetsCreationDateToNow()
//    {
//        $this->subject->updateCreationDate();
//
//        self::assertSimilarDates(new \DateTime(), $this->subject->getCreationDate());
//    }
//
//    /**
//     * @test
//     */
//    public function getModificationDateInitiallyReturnsNull()
//    {
//        self::assertNull($this->subject->getModificationDate());
//    }
//
//    /**
//     * @test
//     */
//    public function updateModificationDateSetsModificationDateToNow()
//    {
//        $this->subject->updateModificationDate();
//
//        self::assertSimilarDates(new \DateTime(), $this->subject->getModificationDate());
//    }
//
//    /**
//     * @test
//     */
//    public function getPasswordHashInitiallyReturnsEmptyString()
//    {
//        self::assertSame('', $this->subject->getPasswordHash());
//    }
//
//    /**
//     * @test
//     */
//    public function setPasswordHashSetsPasswordHash()
//    {
//        $value = 'Club-Mate';
//        $this->subject->setPasswordHash($value);
//
//        self::assertSame($value, $this->subject->getPasswordHash());
//    }
//
//    /**
//     * @test
//     */
//    public function getPasswordChangeDateInitiallyReturnsNull()
//    {
//        self::assertNull($this->subject->getPasswordChangeDate());
//    }
//
//    /**
//     * @test
//     */
//    public function setPasswordHashSetsPasswordChangeDateToNow()
//    {
//        $date = new \DateTime();
//        $this->subject->setPasswordHash('Zaphod Beeblebrox');
//
//        self::assertSimilarDates($date, $this->subject->getPasswordChangeDate());
//    }
//
//    /**
//     * @test
//     */
//    public function isDisabledInitiallyReturnsFalse()
//    {
//        self::assertFalse($this->subject->isDisabled());
//    }
//
//    /**
//     * @test
//     */
//    public function setDisabledSetsDisabled()
//    {
//        $this->subject->setDisabled(true);
//
//        self::assertTrue($this->subject->isDisabled());
//    }
}
