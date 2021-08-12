<?php

namespace App\Controller;

use App\Entity\UserC;
use App\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends AbstractAPIController
{
    public function  indexAction(Request $request): Response
    {
        $users = $this->getDoctrine()->getRepository(UserC::class)->findAll();

        return $this->respond($users);
    }

    public function createAction(Request $request): Response
    {
        $form = $this->buildForm(UserType::class);

        $form->handleRequest($request);

        if(!$form->isSubmitted() || !$form->isValid()){
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var UserC $user */
        $user = $form->getData();

        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();


        return $this->json($user);
    }

    public function deleteAction(Request $request): Response
    {
        $userid = $request->get('user');

        $user_found = $this->getDoctrine()->getRepository(UserC::class)->findOneBy([
            'id' => $userid,
        ]);

        if(!$user_found){
            throw new NotFoundHttpException('User not Found');
        }

        $this->getDoctrine()->getManager()->remove($user_found);
        $this->getDoctrine()->getManager()->flush();
        return  $this->respond('');
    }
}
