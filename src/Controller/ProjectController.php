<?php 

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectController extends AbstractController {

    protected $projects = [];

    public function __construct()
    {
        $this->projects[1] = new Project(1, "First project", "FP"); 
        $this->projects[2] = new Project(2, "Second project", "SP");    
        $this->projects[3] = new Project(3, "Third project", "TP");    
    }


    public function list() : Response
    {
        return $this->render('list.html.twig', [
            'projects' => $this->projects
        ]);
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