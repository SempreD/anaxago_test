<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Listener;

use Anaxago\CoreBundle\Enum\StatutEnum;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Anaxago\CoreBundle\Entity\Project;
use Doctrine\Common\EventSubscriber;

/**
 * Class SearchIndexer
 * @package Anaxago\CoreBundle\Listener
 */
class SendEmailListener implements EventSubscriber
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return ['preUpdate'];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // only act on some "Product" entity
        if (!$entity instanceof Project) {
            return;
        }

        if ($entity->getMontant() >= $entity->getSeuilDeFinancement()) {

            $body = '';//$this->renderTemplate($contract);

            $message = \Swift_Message::newInstance()
                ->setSubject('Contract  created')
                ->setFrom('noreply@example.com')
                ->setTo('mickael@mickaelnosel.com')
                ->setBody($body)
            ;

            $sent = $this->mailer->send($message);

            if ($sent) {
                $em = $args->getEntityManager();
                $entity->setStatut(StatutEnum::STATUT_FINANCE);
            }
        }
    }
}