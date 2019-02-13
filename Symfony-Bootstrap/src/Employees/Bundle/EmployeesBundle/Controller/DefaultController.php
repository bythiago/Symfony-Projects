<?php

namespace Employees\Bundle\EmployeesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Employees\Bundle\EmployeesBundle\Entity\Employees;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/create")
     */
    public function createAction()
    {
        
    	$employeesRepository = $this->getDoctrine()->getManager();

        $employees = new Employees();
        $employees->setbirthDate('1989-10-06');
        $employees->setfirstName(md5(time()));
        $employees->setlastName(md5(time() * 2));
        $employees->setgender('M');
        $employees->sethireDate(date('Y-m-d H:m:s'));

        $employeesRepository->persist($employees);
        $employeesRepository->flush();
                
        return new JsonResponse('Employees created with success!');
        //return new Response('Employees create with success!');
    }

    /**
     * @Route("/update/{id}")
     */
    public function updateAction($id){

    	$em = $this->getDoctrine()->getManager();


    	$employees = $em->getRepository('EmployeesBundle:Employees')->find($id);
    	$employees->setlastName('Vieira');
    	$employees->sethireDate(date('Y-m-d H:m:s'));

    	$em->persist($employees);
    	$em->flush();

    	return new JsonResponse('Employees updated with success!');
    }

    /**
     * @Route("/delete/{id}")
     */
    public function deleteAction($id){
    	$em = $this->getDoctrine()->getManager();
    	$employees = $em->getRepository('EmployeesBundle:Employees')->find($id);

    	$em->remove($employees);
    	$em->flush();

    	return $this->redirect('create');
    	//return new JsonResponse('Employees deleted with success!');
    }

    /**
     * @Route("/")
     * @Route("/read/")
     * @Route("/read/{id}")
     */
    public function readAction($id = NULL){
    	$em = $this->getDoctrine()->getManager();

    	if(isset($id))
    	{
    		$employees = $em->getRepository('EmployeesBundle:Employees')->find($id);
    	} else 
    	{
    		$employees = $em->getRepository('EmployeesBundle:Employees')->findAll();
    	}

    	return $this->render('EmployeesBundle:Default:index.html.twig', 
    		array('employees' => $employees)
    	);
    }

}
