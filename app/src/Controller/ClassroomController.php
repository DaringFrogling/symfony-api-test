<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

        return $this->respond($classrooms);
    }

    /**
     * @Route("/{id}", name="classroom_id", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(Request $request): Response
    {
        $classroomId = $request->get('id');

        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->findOneBy([
            'class_id' => $classroomId
        ]);

        if(!$classroom) {
            throw new NotFoundHttpException('Classroom doesnt exist for this ID');
        }

        return $this->respond($classroom);
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

    /**
     * @Route("/{id}", name="classroom_delete", methods={"DELETE"}, requirements={"id"="\d+"})
     */
    public function delete(Request $request): Response
    {
        $classroomId = $request->get('id');
        
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->findOneBy([
            'class_id' => $classroomId
        ]);

        if(!$classroom) {
            throw new NotFoundHttpException('Classroom doesnt exist');
        }

        $this->getDoctrine()->getManager()->remove($classroom);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond(null);
    }

    /**
     * @Route("/{id}", name="classroom_update", methods={"PATCH"}, requirements={"id"="\d+"})
     */
    public function update(Request $request): Response
    {
        $classroomId = $request->get('id');

        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->findOneBy([
            'class_id' => $classroomId
        ]);

        if(!$classroom) {
            throw new NotFoundHttpException('Classroom doesnt exist');
        }

        $form = $this->buildForm(ClassroomType::class, $classroom, [
            'method' => $request->getMethod(),
        ]);
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
