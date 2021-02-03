<?php


namespace App\Controller;

use App\Entity\Classroom;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractApiController extends AbstractFOSRestController
{
    protected function buildForm(string $type, $data = null, array $options = []): FormInterface
    {
        return $this->container->get('form.factory')->createNamed('', $type, $data, $options);
    }

    protected function respond($data, int $statusCode = Response::HTTP_OK): Response
    {
        return $this->handleView($this->view($data, $statusCode));
    }

    protected function findList()
    {
        $item = $this->getDoctrine()->getRepository(Classroom::class)->findAll();

        if(!$item) {
            throw new NotFoundHttpException("Data doesnt exist");
        }

        return $item;
    }

    protected function findOne(Request $request, $data = '')
    {
        $itemId = $request->get($data);
        $item = $this->getDoctrine()->getRepository(Classroom::class)->findOneBy([
            'class_id' => $itemId
        ]);

        if(!$item) {
            throw new NotFoundHttpException("$data doesnt exist");
        }
        return $item;
    }
}