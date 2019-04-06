<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use AppBundle\Entity\Pessoa;

class DefaultController extends Controller
{
    /**
     * @Route("/pessoa/create/{nome}", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $pessoa = new Pessoa();
        $pessoa->setNome($request->get('nome'));

        $em->persist($pessoa);
        $em->flush();
        
        return new Response($pessoa->getNome() . ' created with success');
    }

    /**
     * @Route("/pessoa/show", name="pessoa_show")
     */
    public function showAction()
    {   

        $pessoas = $this->getDoctrine()->getRepository('AppBundle:Pessoa')->findAll();
        $response = new Response($this->serializer($pessoas), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/pessoa/index", name="pessoa_index")
     */
    public function PessoasIndexAction()
    {
        return $this->render('default/index.html.twig');
    }

    private function serializer($object, $type = 'json'){
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->serialize($object, $type);

    }
}
