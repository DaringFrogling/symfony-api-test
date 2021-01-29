<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClassroomController
 * @Route ("/api/v1")
 */
class ClassroomController extends AbstractApiController
{
    /**
     * @Route("/", name="classroom_list", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $classrooms = $this->getDoctrine()->getRepository(Classroom::class)->findAll();

        return $this->json($classrooms);
    }

    /**
     * @Route("/", name="classroom_create", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $form = $this->buildForm(ClassroomType::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid())
        {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var Classroom $classroom */
        $classroom = $form->getData();

        $this->getDoctrine()->getManager()->persist($classroom);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond($classroom);
    }
}
