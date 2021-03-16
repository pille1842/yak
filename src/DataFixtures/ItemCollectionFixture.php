<?php

namespace App\DataFixtures;

use App\Entity\ItemCollection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ItemCollectionFixture extends Fixture implements DependentFixtureInterface
{
    public const COLLECTION1_REFERENCE = 'collection-1';
    public const COLLECTION2_REFERENCE = 'collection-2';
    public const COLLECTION3_REFERENCE = 'collection-3';

    public function load(ObjectManager $manager)
    {
        // This first collection belongs to test1 and contains all his books
        $collection1 = new ItemCollection();
        $collection1->setName("test1's book collection");
        $collection1->setDescription("All the books belonging to test1");
        $collection1->setIsPublic(true);
        $collection1->addOwner($this->getReference(UserFixture::USER1_REFERENCE));
        $manager->persist($collection1);
        $this->addReference(self::COLLECTION1_REFERENCE, $collection1);

        // The second collection belongs to test2 and contains all his DVDs
        $collection2 = new ItemCollection();
        $collection2->setName("test2's movie collection");
        $collection2->setDescription("All the DVDs belonging to test2");
        $collection2->setIsPublic(true);
        $collection2->addOwner($this->getReference(UserFixture::USER2_REFERENCE));
        $manager->persist($collection2);
        $this->addReference(self::COLLECTION2_REFERENCE, $collection2);

        // The third collection is shared between test1 and test2, but isn't publicly viewable
        $collection3 = new ItemCollection();
        $collection3->setName("living room");
        $collection3->setDescription("All the books and movies in the living room");
        $collection3->setIsPublic(false);
        $collection3->addOwner($this->getReference(UserFixture::USER1_REFERENCE));
        $collection3->addOwner($this->getReference(UserFixture::USER2_REFERENCE));
        $manager->persist($collection3);
        $this->addReference(self::COLLECTION3_REFERENCE, $collection3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixture::class
        ];
    }
}
