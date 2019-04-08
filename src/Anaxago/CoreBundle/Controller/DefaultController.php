<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Controller;

use Anaxago\CoreBundle\Entity\Project;
use Anaxago\CoreBundle\Entity\User;
use Anaxago\CoreBundle\Enum\StatutEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 *
 * @package Anaxago\CoreBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="anaxago_core_homepage")
     *
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function indexAction(EntityManagerInterface $entityManager): Response
    {
        $projects = $entityManager->getRepository(Project::class)->findAll();

        return $this->render('@AnaxagoCore/Default/index.html.twig', ['projects' => $projects]);
    }

    /**
     * @Route("/statut/{statut}", defaults={"statut"=null}, name="anaxago_core_homepage_statut")
     *
     * @param null|string $statut
     *
     * @return Response
     */
    public function indexStatutAction(?string $statut): Response
    {
        if (in_array($statut, StatutEnum::getAvailableTypes())) {
            $projects = $this->getDoctrine()
                ->getRepository(Project::class)
                ->findBy([
                    'statut' => $statut,
                ]);
        } else {
            $projects = $this->getDoctrine()->getRepository(Project::class)->findAll();
        }

        return $this->render('@AnaxagoCore/Default/index.html.twig', ['projects' => $projects]);
    }

    /**
     * @Route("/interet", name="anaxago_core_homepage_interet")
     *
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function indexInteretAction(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if(null === $user) {
            return $this->redirectToRoute('anaxago_core_homepage');
        }

        $userProjects = $entityManager
            ->getRepository(User::class)
            ->findWithInteret($user);

        return $this->render('@AnaxagoCore/Default/index.html.twig', ['projects' => $userProjects->getProjects()]);
    }
}
