<?php

namespace Casa\Bundle\QuartoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Casa\Bundle\QuartoBundle\Entity\Moveis;
use Casa\Bundle\QuartoBundle\Repository\MoveisRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{	

    /**
     * @Route("/")
     */
    public function indexAction()
    {
    	$moveis = new Moveis();

        return $this->render('QuartoBundle:Default:index.html.twig');
    }

    /**
     * @Route("/autocomplete", name="autocomplete")
     */
    public function autoCompleteAction(){
    	return $this->render('QuartoBundle:Default:autocomplete.html.twig');
    }

    /**
     * @Route("/create")
     */
    public function createAction(){
		$em = $this->getDoctrine()->getManager();
    	

		

    	for ($i=0; $i < 25 ; $i++) { 
    		$moveis = new Moveis('QuartoBundle');
       	   	
	    	$moveis->setNome('THIAGO ' . md5(time() + $i));
	    	$moveis->setQuantidade(rand(1, rand($i,99)));
	    	$moveis->setDescricao(md5(time() * $i));

	    	$em->persist($moveis);
	    	$em->flush();
	    }


    }

    /**
     * @Route("/listaJson", defaults={"_format"="json"})
     */
    public function listaJsonAction(Request $request)
    {
    	if(!empty($request->request->get('nome'))){
	    	$repository = $this->getDoctrine()->getRepository('QuartoBundle:Moveis');
	    	$moveis = $repository->createQueryBuilder('p')
	    	->where('p.nome like :nome')
	    	->setParameter('nome', "%".$request->request->get('nome')."%")
	    	->getQuery()->getArrayResult();
	    }

		return new JsonResponse($moveis, 200) ;
    }
}
