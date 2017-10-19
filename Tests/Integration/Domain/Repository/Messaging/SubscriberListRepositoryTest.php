<?php
declare(strict_types=1);

namespace PhpList\PhpList4\Tests\Integration\Domain\Repository\Messaging;

use PhpList\PhpList4\Domain\Model\Messaging\SubscriberList;
use PhpList\PhpList4\Domain\Repository\Messaging\SubscriberListRepository;
use PhpList\PhpList4\Tests\Integration\Domain\Repository\AbstractRepositoryTest;
use PhpList\PhpList4\Tests\Support\Traits\SimilarDatesAssertionTrait;

/**
 * Testcase.
 *
 * @author Oliver Klee <oliver@phplist.com>
 */
class SubscriberListRepositoryTest extends AbstractRepositoryTest
{
    use SimilarDatesAssertionTrait;

    /**
     * @var string
     */
    const TABLE_NAME = 'phplist_list';

    /**
     * @var SubscriberListRepository
     */
    private $subject = null;

    protected function setUp()
    {
        parent::setUp();

        $this->subject = $this->container->get(SubscriberListRepository::class);
    }

    /**
     * @test
     */
    public function findReadsModelFromDatabase()
    {
        $this->getDataSet()->addTable(self::TABLE_NAME, __DIR__ . '/Fixtures/SubscriberList.csv');
        $this->applyDatabaseChanges();

        $id = 1;
        $name = 'News';
        $description = 'News (and some fun stuff)';
        $creationDate = new \DateTime('2016-06-22 15:01:17');
        $modificationDate = new \DateTime('2016-06-23 19:50:43');
        $passwordHash = '1491a3c7e7b23b9a6393323babbb095dee0d7d81b2199617b487bd0fb5236f3c';
        $passwordChangeDate = new \DateTime('2017-06-28');
        $disabled = true;

        /** @var SubscriberList $actualModel */
        $actualModel = $this->subject->find($id);

        self::assertSame($id, $actualModel->getId());
        self::assertSame($name, $actualModel->getName());
        self::assertSame($description, $actualModel->getDescription());
        self::assertEquals($creationDate, $actualModel->getCreationDate());
        self::assertEquals($modificationDate, $actualModel->getModificationDate());
//        self::assertSame($passwordHash, $actualModel->getPasswordHash());
//        self::assertEquals($passwordChangeDate, $actualModel->getPasswordChangeDate());
//        self::assertSame($disabled, $actualModel->isDisabled());
    }

//    /**
//     * @test
//     */
//    public function creationDateOfExistingModelStaysUnchangedOnUpdate()
//    {
//        $this->getDataSet()->addTable(self::TABLE_NAME, __DIR__ . '/Fixtures/SubscriberList.csv');
//        $this->applyDatabaseChanges();
//
//        $id = 1;
//        /** @var SubscriberList $model */
//        $model = $this->subject->find($id);
//        $creationDate = $model->getCreationDate();
//
//        $model->setLoginName('mel');
//        $this->entityManager->flush();
//
//        self::assertSame($creationDate, $model->getCreationDate());
//    }
//
//    /**
//     * @test
//     */
//    public function modificationDateOfExistingModelGetsUpdatedOnUpdate()
//    {
//        $this->getDataSet()->addTable(self::TABLE_NAME, __DIR__ . '/Fixtures/SubscriberList.csv');
//        $this->applyDatabaseChanges();
//
//        $id = 1;
//        /** @var SubscriberList $model */
//        $model = $this->subject->find($id);
//        $expectedModificationDate = new \DateTime();
//
//        $model->setLoginName('mel');
//        $this->entityManager->flush();
//
//        self::assertSimilarDates($expectedModificationDate, $model->getModificationDate());
//    }
//
    /**
     * @test
     */
    public function creationDateOfNewModelIsSetToNowOnPersist()
    {
        $this->getDataSet()->addTable(self::TABLE_NAME, __DIR__ . '/Fixtures/SubscriberList.csv');
        $this->applyDatabaseChanges();

        $model = new SubscriberList();
        $expectedCreationDate = new \DateTime();

        $this->entityManager->persist($model);

        self::assertSimilarDates($expectedCreationDate, $model->getCreationDate());
    }

    /**
     * @test
     */
    public function modificationDateOfNewModelIsSetToNowOnPersist()
    {
        $this->getDataSet()->addTable(self::TABLE_NAME, __DIR__ . '/Fixtures/SubscriberList.csv');
        $this->applyDatabaseChanges();

        $model = new SubscriberList();
        $expectedModificationDate = new \DateTime();

        $this->entityManager->persist($model);

        self::assertSimilarDates($expectedModificationDate, $model->getModificationDate());
    }

    /**
     * @test
     */
    public function savePersistsAndFlushesModel()
    {
        $this->touchDatabaseTable(self::TABLE_NAME);

        $model = new SubscriberList();
        $this->subject->save($model);

        self::assertSame($model, $this->subject->find($model->getId()));
    }
}
