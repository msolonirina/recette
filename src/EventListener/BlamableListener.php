<?php

namespace App\EventListener;

use App\Entity\Aliment;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class BlamableListener {

    public function __construct(private EntityManagerInterface $manager)
    {
        
    }

    public function preUpdate(PreUpdateEventArgs $event)
    {
        
        /** @var Aliment $aliment */
        if( ($aliment = $event->getObject()) instanceof Aliment && $event->hasChangedField('prix')) {
            $aliment->setBlamable('Zah indray izay');
            //$this->manager->
            //dd($aliment->getId());
            //dd('tkn mis blammena');
        }

        //dd($event->hasChangedField('prix'));
        
    }
}
