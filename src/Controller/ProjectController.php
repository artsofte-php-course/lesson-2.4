<?php 

namespace App\Controller;

use App\Entity\Project;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectController extends AbstractController {


    public function list(ManagerRegistry $doctrine) : Response
    {

        $projects = $doctrine->getRepository(Project::class)
                                ->findAll();

        return $this->render('list.html.twig', [
            'projects' => $projects
        ]);
    }

    public function add(ManagerRegistry $doctrine) : Response 
    {
        $projectNum = rand(1,100);
        $project = new Project(sprintf('Project #%d', $projectNum), 
                                sprintf('PRJ-%d', $projectNum));   

        $doctrine->getManager()->persist($project);
        $doctrine->getManager()->flush();

        return new Response();
    }

    public function showById(int $id, string $key) : Response
    {   
        if (!isset($this->projects[$id]) || 
        $this->projects[$id]->getKey() !== $key ) {
            
            return $this->redirect(
                $this->generateUrl('index')
            );

        }

        return $this->render('show.html.twig', [
            'id' => $id,
            'project' => $this->projects[$id]
        ]);
    }

}