<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Entity\User;

class ContactListController extends Controller
{
    public function indexAction($interlocutorId)
    {
        $userRepo = $this->get('user.repository');
        /* @var $userRepo \Repository\UserRepository */

        $user = $this->getUser();
        /* @var User $user */

        $interlocutor = $userRepo->get($interlocutorId);

        $contacts = $userRepo->getAllWithout($user);

        return $this->render('main/contactList.html.twig', [
            'contacts'      => $contacts,
            'interlocutor'  => $interlocutor
        ]);
    }

}
