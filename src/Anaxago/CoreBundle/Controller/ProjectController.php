<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Controller;

use Anaxago\CoreBundle\Entity\Project;
use Anaxago\CoreBundle\Enum\StatutEnum;
use Anaxago\CoreBundle\Form\Type\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProjectController
 *
 * @Route("/project")
 *
 * @package Anaxago\CoreBundle\Controller
 */
class ProjectController extends Controller
{
    /**
     * @Route("/{id}", name="anaxago_core_project_show")
     *
     * @param Request $request
     * @param Project $project
     *
     * @return Response
     */
    public function showAction(Request $request, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();
        }

        return $this->render('@AnaxagoCore/Project/show.html.twig', [
            'project' => $project,
        ]);
    }

    /**
     * @Route("/montant/{id}", name="anaxago_core_project_montant")
     *
     * @param Request $request
     * @param Project $project
     *
     * @return Response
     */
    public function montantAction(Request $request, Project $project): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('anaxago_core_homepage');
        }

        $form = $this->createForm(ProjectType::class);

        return $this->render('@AnaxagoCore/Project/montant.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }
}
