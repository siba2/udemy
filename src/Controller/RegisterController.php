<?php
/**
 * Created by PhpStorm.
 * User: sebastian
 * Date: 2019-01-02
 * Time: 12:16
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller {

    /**
     * @Route("/register", name="user_register")
     */
    public function register(UserPasswordEncoderInterface $passwordEncoder, Request $request) {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());

            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->redirect('micro_post_index');
        }

        return $this->render('register/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

}