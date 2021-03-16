<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Person;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $derSchwarm = new Book();
        $derSchwarm->setTitle('Der Schwarm');
        $derSchwarm->setIsbn('978-3-596-16453-0');
        $derSchwarm->setDescription(
            "Vor Peru verschwindet ein Fischer. Spurlos. Norwegische Ölbohrexperten ".
            "stoßen auf merkwürdige Organismen, die Hunderte Quadratkilometer Meeresboden ".
            "in Besitz genommen haben. Währenddessen geht mit den Walen entlang der Küste ".
            "British Columbias eine unheimliche Veränderung vor. Nichts von alledem scheint ".
            "miteinander in Zusammenhang zu stehen. Doch Sigur Johanson, Biologe und ".
            "Schöngeist, glaubt nicht an Zufälle. Auch der indianische Walforscher Leon ".
            "Anawak gelangt zu beunruhigenden Schlüssen: Eine Katastrophe kündigt sich an. ".
            "Die Suche nach dem Urheber konfrontiert die Forscher mit ihren schlimmsten ".
            "Albträumen. Frank Schätzing inszeniert den Feldzug der Natur gegen den Menschen ".
            "als atemberaubendes Schreckensszenario mit Tempo und Tiefgang."
        );
        $derSchwarm->setRating(5);
        $derSchwarm->setReview('Packend! Fesselnd!');
        $derSchwarm->setLocation('Regal oben links');
        $derSchwarm->setIsRented(false);
        $derSchwarm->setAddedAt(new DateTime());
        $derSchwarm->setCollection($this->getReference(ItemCollectionFixture::COLLECTION1_REFERENCE));
        $derSchwarm->setAsin('3596164532');
        // Author: Frank Schätzing
        $frank = new Person();
        $frank->setName("Frank Schätzing");
        $frank->setReferenceUrl('https://de.wikipedia.org/wiki/Frank_Sch%C3%A4tzing');
        $manager->persist($frank);
        $derSchwarm->addAuthor($frank);
        // Finish
        $manager->persist($derSchwarm);

        $dune = new Book();
        $dune->setTitle('Der Wüstenplanet');
        $dune->setIsbn('978-3-453-18683-5');
        $dune->setDescription(
            "Herzog Leto, Oberhaupt des Hauses Atreides, erhält Arrakis zum Lehen, den ".
            "Wüstenplaneten, eine lebensfeindliche und doch begehrte Welt, denn in ihren ".
            "Dünenfeldern wird das Gewürz abgebaut. Diese Droge verleiht den Menschen die ".
            "Gabe, in die Zukunft zu blicken, und bildet damit die Grundlage für die ".
            "interstellare Raumfahrt. Als Letos Armee einem tödlichen Hinterhalt zum Opfer ".
            "fällt, flieht sein Sohn Paul in die Wüste und taucht bei den Ureinwohnern ".
            "Arrakis', den Fremen, unter. Er sammelt die Wüstenbeduinen um sich zu einem ".
            "gnadenlosen Rachefeldzug.\n\n".
            "Mit diesem monumentalen Epos schuf Frank Herbert ein atemberaubendes Panorama ".
            "der Menschheit in ferner Zukunft und eine Welt, die man nie vergißt. 1965 ".
            "sowohl mit dem Hugo Gernsback Award als auch dem Nebula Award ausgezeichnet, ".
            "wird 'Der Wüstenplanet' bei Umfragen unter Leserinnen und Lesern regelmäßig ".
            "zum besten SF-Roman aller Zeiten gekürt."
        );
        $dune->setRating(4);
        $dune->setReview('Science Fiction in Topform');
        $dune->setLocation('auf dem Nachttisch');
        $dune->setIsRented(false);
        $dune->setAddedAt(new DateTime());
        $dune->setCollection($this->getReference(ItemCollectionFixture::COLLECTION1_REFERENCE));
        $dune->setAsin('B00KL7ONNW');
        // Author: Frank Herbert
        $herbert = new Person();
        $herbert->setName('Frank Herbert');
        $herbert->setReferenceUrl('https://de.wikipedia.org/wiki/Frank_Herbert');
        $manager->persist($herbert);
        $dune->addAuthor($herbert);
        // Finish
        $manager->persist($dune);

        $aeneis = new Book();
        $aeneis->setTitle('Aeneis');
        $aeneis->setIsbn('978-3-15-018918-4');
        $aeneis->setDescription(
            "Mit der Aeneis hat Vergil ein Epos geschaffen, das nicht nur die ".
            "Nationaldichtung der Römer werden sollte, sondern auch das Vorbild aller ".
            "lateinischen Epik. Dieser Erfolg des Werkes, das auch später in Mittelalter ".
            "und Neuzeit starken Einfluss auf die europäische Geistesgeschichte ausübte, ".
            "ist der Leistung Vergils zu verdanken, die Geschichte des römischen ".
            "Gründervaters Aeneas in vollendete poetische Form zu gießen."
        );
        $aeneis->setRating(2);
        $aeneis->setReview('Staubtrocken!');
        $aeneis->setLocation('auf dem Dachboden');
        $aeneis->setIsRented(true);
        $aeneis->setAddedAt(new DateTime());
        $aeneis->setReturnUntil(new DateTime('Monday'));
        $aeneis->setCollection($this->getReference(ItemCollectionFixture::COLLECTION1_REFERENCE));
        $aeneis->setAsin('3150189187');
        // Authors: Vergil, Edith Binder, Gerhard Binder
        $vergil = new Person();
        $vergil->setName('Vergil');
        $vergil->setReferenceUrl('https://de.wikipedia.org/wiki/Vergil');
        $manager->persist($vergil);
        $aeneis->addAuthor($vergil);
        $edith = new Person();
        $edith->setName('Edith Binder');
        $manager->persist($edith);
        $aeneis->addAuthor($edith);
        $gerhard = new Person();
        $gerhard->setName('Gerhard Binder');
        $manager->persist($gerhard);
        $aeneis->addAuthor($gerhard);
        // Finish
        $manager->persist($aeneis);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ItemCollectionFixture::class
        ];
    }
}
