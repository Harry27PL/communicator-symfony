<?php

namespace AppBundle\Controller\Auth;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegisterController extends Controller
{
    public function indexAction()
    {
        $userRegister = $this->get('user.register');
        /* @var $userRegister \Service\User\UserRegister */

        $formData = [
            'values' => $userRegister->getDefaultValues(),
            'errors' => clearArray($userRegister->getDefaultValues())
        ];

        if ($_POST) {

            $formData = $userRegister->validate($_POST['username'], $_POST['email'], $_POST['password']);

            if (!hasValue($formData['errors'])) {

                $user = $userRegister->register($_POST['username'], $_POST['email'], $_POST['password']);

                return $this->redirect($this->generateUrl('main'));
            }
        }

        return $this->render('auth/register.html.twig', $formData);
    }

}
