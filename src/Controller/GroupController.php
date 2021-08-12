<?php

namespace App\Controller;

use App\Entity\GroupC;
use App\Entity\GroupingC;
use App\Form\Type\GroupType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GroupController extends AbstractAPIController
{
    public function  indexAction(Request $request): Response
    {
        $group = $this->getDoctrine()->getRepository(GroupC::class)->findAll();

        return $this->respond($group);
    }

    public function createAction(Request $request): Response
    {
        $form = $this->buildForm(GroupType::class);

        $form->handleRequest($request);

        if(!$form->isSubmitted() || !$form->isValid()){
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var GroupC $group */
        $group = $form->getData();

        $this->getDoctrine()->getManager()->persist($group);
        $this->getDoctrine()->getManager()->flush();


        return $this->json($group);
    }

    public function deleteAction(Request $request): Response
    {
        $groupId = $request->get('group');

        $group_found = $this->getDoctrine()->getRepository(GroupC::class)->findOneBy([
            'id' => $groupId,
        ]);

        if(!$group_found){ //check if group exists
            throw new NotFoundHttpException('Group not Found');
        }

        if($this->findGrouping($groupId)) //check if group has users assigned to it
        {
            return $this->respond('Group can not be deleted as it has users assigned to it');
        }



        $this->getDoctrine()->getManager()->remove($group_found);
        $this->getDoctrine()->getManager()->flush();
        return  $this->respond('Group deleted successfully');
    }

    private function findGrouping(int $group)
    {
        $grouping_found = $this->getDoctrine()->getRepository(GroupingC::class)->findOneBy([
            'group' => $group
        ]);
        if($grouping_found)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
