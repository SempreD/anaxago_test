<?php declare(strict_types = 1);

namespace Anaxago\ApiBundle\Controller;

use Anaxago\CoreBundle\Entity\Project;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;


/**
 * Class ProjectController
 *
 * @package Anaxago\ApiBundle\Controller
 */
class ProjectController extends FOSRestController
{
    /**
     * @Rest\Get(
     *     path = "/projects"
     * ),
     * @Rest\View(
     *     statusCode = 200
     * )
     *
     * @return array
     */
    public function getProjects(): array
    {
        return $this->getDoctrine()
            ->getRepository(Project::class)
            ->findAll();
    }

    /**
     * @Rest\Get(
     *     path = "/projects/{statut}"
     * ),
     * @Rest\View(
     *     statusCode = 200
     * )
     *
     * @return array
     */
    public function getProjectsWithStatut(string $statut): array
    {
        return $this->getDoctrine()
            ->getRepository(Project::class)
            ->findBy([
                'statut' => $statut,
            ]);
    }
}