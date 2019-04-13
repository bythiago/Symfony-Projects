<?php

namespace AppBundle\Controller;

use AppBundle\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Categoria;


class DefaultController extends Controller
{

    /**
     * @Route("/categoria/edit", name="select")
     */
    public function selectAction(Request $request){

        /**
         * @var EntityManager $em
         */
        $em = $this->getDoctrine()->getManager();

        /** @var Categoria $categoria */
    	$categoria = $this->getDoctrine()->getRepository('AppBundle:Categoria')->find(6);


    	$em->persist($categoria->setNome('COMEDIA' . rand(1, 99)));
    	$em->flush();

        return new Response('Categoria atualizado com sucesso');
    }

    /**
     * @Route("/correios/{nCdServico}/{sCepOrigem}/{sCepDestino}", name="correios")
     */
    public function correiosAction($nCdServico, $sCepOrigem, $sCepDestino){
        $client = new \SoapClient('http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx?wsdl');
        
        $response = $client->__soapCall('CalcPrazo', [
            'CalcPrazo' => [
                'nCdServico' => $nCdServico,
                'sCepOrigem' => $sCepOrigem,
                'sCepDestino' => $sCepDestino
            ]
        ]);  

        print '<pre>';
        var_dump($response);
        exit;
    }
}