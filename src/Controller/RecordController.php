<?php

namespace App\Controller;

use App\Entity\Record;
use App\Entity\Track;
use App\Repository\RecordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RecordController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function createRecord(EntityManagerInterface $entityManager): Response
    {
        //On ajoute en paramètre du controller un objet de type EntityManagerInterface
        //pour obtenir le gestionnaire d'entités configuré (ici Doctrine)

        //Il est également possible de récupérer le manager comme suit.
        //$entityManager = $this->getDoctrine()->getManager();

        //Dans cet exemple, on ajoute directement un élément en dur. Il est évident
        //que dans une vraie application, ces données proviennent le plus souvent
        //d'un formulaire.

        //On crée d'abord une nouvelle instance du modèle que l'on souhaite ajouter
        $record = new Record();
        $record->setName('Unreasonable Behaviour');
        $record->setArtistName('Laurent Garnier');
        $record->setType('LP');
        $record->setYear(2000);

        //On demande ensuite au manager d'enregistrer ce modèle
        // - persist n'effectue pas encore la requête en base de données
        $entityManager->persist($record);

        //On peut ensuite ajouter une liste de pistes à notre disque
        //The Warning 	1:48
        //City Sphere 	6:15
        //Forgotten Thoughts 	6:48
        //The Sound Of The Big Babou 	7:10
        //Unreasonable Behaviour 	1:20
        //Cycles D'oppositions 	5:00
        //The Man With The Red Face 	9:10
        //Communications From The Lab 	4:54
        //Greed (Part 1 + 2) 	6:48
        //Dangerous Drive 	9:05
        //Downfall 	5:39
        //Last Tribute From The 20th Century 	5:16
        $track1 = new Track();
        $track1->setYear(2000);
        $track1->setName('The Warning');
        $track1->setTitle('The Warning');
        $track1->setDuration(108);
        //On peut associer une piste au disque via la propriété "Record"
        $track1->setRecord($record);
        //On demande ensuite au manager d'enregistrer la création de cette piste
        //depuis le dernier appel à persist sur notre disque
        $entityManager->persist($track1);

        $track2 = new Track();
        $track2->setYear(2000);
        $track2->setName('City Sphere');
        $track2->setTitle('City Sphere');
        $track2->setDuration(375);
        //On peut également l'associer au disque via la méthode addTrack de l'objet Record
        $record->addTrack($track2);
        //On demande ensuite au manager d'enregistrer la création de cette piste
        //depuis le dernier appel à persist sur notre disque
        $entityManager->persist($track2);
        //On demande ensuite au manager d'enregistrer les modifications effectuées
        //depuis le dernier appel à persist sur notre disque
        //$entityManager->persist($record);

        //On appelle ensuite "flush" pour envoyer effectivement les requêtes
        //dans la base de données
        $entityManager->flush();

        //A partir d'ici, les données sont effectivement inscrites dans la base de données

        return new Response('Saved new record with id '.$record->getId());
    }

    /**
     * Affiche le disque qui a pour identifiant $id
     * @param int $id
     * @param RecordRepository $recordRepository
     * @return Response
     */
    public function getById(int $id,RecordRepository $recordRepository):Response{

        $record = $recordRepository->find($id);

        if ($record !== null){
            return new Response("{$record->getName()} by {$record->getArtistName()}");
        } else {
            return new Response("record not found",404);
        }

    }
}
