<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Service\UsuarioService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsuarioController extends Controller
{
    /**
     * @Route("/usuario/create", name="app_usuario_create")
     */
    public function createAction(Request $request)
    {
        /**
         * @var UsuarioService $service
         */
        $service = $this->get('app.message_generator');
        $service->getHappyMessage();

        /**
         * @var Usuario $usuario
         */
        $usuario = new Usuario();

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        if (($request->isMethod('POST')) && ($this->isCsrfTokenValid('token', $request->get('_token')))) {

            $usuario->setNome($request->get('nome'));
            $usuario->setSexo($request->get('sexo'));
            $usuario->setNascimento($request->get('nascimento'));
            $usuario->setCep($request->get('cep'));
            $usuario->setCpf($request->get('cpf'));
            $usuario->setContato($request->get('contato'));
            $usuario->setStatus(1);

            $errors = $this->get('validator')->validate($usuario);

            if (count($errors) > 0) {
                return $this->render('@App/Usuario/index.html.twig', ['errors' => $errors]);
            } else {
                $em->persist($usuario);
                $em->flush();
                $em->clear();

                return $this->redirect('/usuario/create');
            }

        }

        return $this->render('@App/Usuario/index.html.twig', ['errors' => null]);
    }

    /**
     * @Route("/usuario/read", name="app_usuario_read")
     */

    public function readUsuarios(){

        print '<pre>';
        $usuario = $this->getDoctrine()->getRepository('AppBundle:Usuario')->findBy(array('id' => 1));


        print_r($usuario[0]->getNascimento()->format('d/m/Y'));
        //print_r(\DateTime::createFromFormat('d-m-Y', $usuario[0]->getNascimento()));


        exit;
    }
}
