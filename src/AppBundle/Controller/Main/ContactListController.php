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

        $messageRepo = $this->get('message.repository');
        /* @var $messageRepo \Repository\MessageRepository */

        $user = $this->getUser();
        /* @var User $user */

        $interlocutor = $userRepo->get($interlocutorId);

        $contacts = $userRepo->getAllWithout($user);

        $unread = [];
        foreach ($contacts as $contact) {
            $unread[$contact->getId()] = $interlocutor == $contact
                ? false
                : $messageRepo->hasUnread($contact);
        }

        return $this->render('main/contactList.html.twig', [
            'contacts'      => $contacts,
            'unread'        => $unread,
            'interlocutor'  => $interlocutor
        ]);
    }

}
