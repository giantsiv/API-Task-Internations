<?php

namespace App\Controller;

use App\Entity\GroupC;
use App\Entity\GroupingC;
use App\Entity\UserC;
use App\Form\Type\GroupingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GroupingController extends AbstractAPIController
{
    public function  indexAction(Request $request): Response
    {
        $grouping = $this->getDoctrine()->getRepository(GroupingC::class)->findAll();

        return $this->respond($grouping);
    }

    public function assignAction(Request $request): Response
    {

        $form = $this->buildForm(GroupingType::class);

        $form->handleRequest($request);


        $parameters = json_decode($request->getContent(), true);

        if(!$this->findUser($parameters['user'])){ //check if user exists
            throw new NotFoundHttpException('That user does not exist');
        }
        if(!$this->findGroup($parameters['group'])){ //check if group exists
            throw new NotFoundHttpException('That group does not exist');
        }

        if($this->findGrouping($parameters['user'], $parameters['group'])){ //check if user is already assigned to that group
            return $this->respond('This user is already assigned to that group');
        }

        if(!$form->isSubmitted() || !$form->isValid()){
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var GroupingC $grouping */
        $grouping = $form->getData();

        $this->getDoctrine()->getManager()->persist($grouping);
        $this->getDoctrine()->getManager()->flush();

        return $this->json($grouping);
    }

    public function deleteAction(Request $request): Response
    {
        $userid = $request->get('user');
        $groupid = $request->get('group');



        if(!$grouping = $this->findGrouping($userid, $groupid)){
            throw new NotFoundHttpException('That user is not assigned to that group');
        }

        $this->getDoctrine()->getManager()->remove($grouping);
        $this->getDoctrine()->getManager()->flush();
        return  $this->respond('Successfully removed user from group');


    }

    private function findGrouping(int $user, int $group) //check if user is assigned to that group
    {
        $get_grouping = $this->getDoctrine()->getRepository(GroupingC::class)->findOneBy([
            'user' => $user,
            'group' => $group
        ]);

        if($get_grouping){
            return $get_grouping;
        }
        else{
            return false;
        }
    }

    private function findUser(int $user)
    {
        $get_user = $this->getDoctrine()->getRepository(UserC::class)->findOneBy(['id' => $user]);

        if($get_user){
            return true;
        }
        else{
            return false;
        }
    }
    private function findGroup(int $group)
    {
        $get_group = $this->getDoctrine()->getRepository(GroupC::class)->findOneBy(['id' => $group]);

        if($get_group){
            return true;
        }
        else{
            return false;
        }
    }
}
