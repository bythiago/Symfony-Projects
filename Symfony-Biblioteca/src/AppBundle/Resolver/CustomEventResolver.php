<?php
//src/AppBundle/Resolver/CustomEventResolver.php

namespace AppBundle\Resolver;

use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\Event;
use Xiidea\EasyAuditBundle\Events\DoctrineEvents;
use Xiidea\EasyAuditBundle\Events\DoctrineObjectEvent;
use Xiidea\EasyAuditBundle\Resolver\EventResolverInterface;


class CustomEventResolver implements EventResolverInterface
{
    /**
     * @var array
     */
    protected $identity = ['', ''];

    /**
     * @var $event DoctrineObjectEvent
     */
    protected $event;

    protected $entity;

    /**
     * @var EntityManager
     */
    protected $em;

    protected $changeSetGetterMethods = [
        'getEntityChangeSet',
        'getDocumentChangeSet',
    ];

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * @param Event $event
     * @param string $eventName
     * @return array|mixed
     */
    public function getEventLogInfo(Event $event, $eventName)
    {
        $this->entity = $event->getLifecycleEventArgs()->getObject();

        return array(
            'type'=> $this->getEventType($this->entity, $eventName),
            'description'=> json_encode($this->getChangeSets($this->entity))
        );
    }

    /**
     * @param $object
     * @return \ReflectionClass
     */
    protected function getReflectionClassFromObject($object)
    {
        return new \ReflectionClass(ClassUtils::getClass($object));
    }

    /**
     * @param $entity
     * @return mixed|null
     */
    protected function getChangeSets($entity)
    {
        $unitOfWork = $this->getUnitOfWork();
        foreach ($this->changeSetGetterMethods as $method) {
            $getter = [$unitOfWork, $method];
            if (is_callable($getter)) {
                return call_user_func($getter, $entity);
            }
        }

        return null;
    }

    /**
     * @return \Doctrine\ORM\UnitOfWork
     */
    protected function getUnitOfWork()
    {
        return $this->em->getUnitOfWork();
    }

    /**
     * @param $entity
     * @param $eventName
     * @return string
     */
    private function getEventType($entity, $eventName){
        return $this->getReflectionClassFromObject($entity)->getShortName().' has '.DoctrineEvents::getShortEventType($eventName);
    }

}