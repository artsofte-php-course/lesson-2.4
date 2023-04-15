<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Type\TaskType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractController
{

    public function create($id, $key, Request $request, ManagerRegistry $doctrine)
    {
        /** Project $project */
        $project = $doctrine->getRepository(Project::class)->find($id);
        
        if ($project === null) {
            return $this->createNotFoundException(
                sprintf("Project with id %d not found", $id)
            );
        }

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            $project->addTask($task);

            $doctrine->getManager()->persist($task);
            $doctrine->getManager()->flush();

            return $this->redirectToRoute('project_by_id', [
                'key' => $project->getSlug(),
                'id' => $project->getId()
            ]);
        }

        return $this->render(
            'tasks/create.html.twig', [
                'form' => $form->createView()
            ]
        );

    } 

}