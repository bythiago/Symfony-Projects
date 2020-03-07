<?php

namespace Acme\StoreBundle\Controller;

use Acme\StoreBundle\Entity\Category;
use Acme\StoreBundle\Entity\Product;
use Doctrine\ORM\TransactionRequiredException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Acl\Domain\Acl;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

/**
 * Class DefaultController
 * @package Acme\StoreBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @Route("/")
     */
    public function storeAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        // the above is a shortcut for this
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return new Response('Well hi there '. $user);
    }

    /**
     * @Route("/{id}")
     */
    public function indexAction($id = 1)
    {

        //return $this->create();

        //return $this->render('StoreBundle:Default:index.html.twig', ['product' => $this->show($id)]);
    }

    public function create()
    {
        try {

            $category = new Category();
            $category->setName('Main Products');

            $product = new Product();
            $product->setName('A Foo Bar');
            $product->setPrice('19.99');
            $product->setDescription('Lorem ipsum dolor');
            $product->setCategory($category);

            $em = $this->getDoctrine()->getManager();
            $em->beginTransaction();
            $em->persist($category);
            $em->persist($product);
            $em->flush();

            $em->commit();

            return new Response('Created product id ' . $product->getId());
        } catch (Exception $e){
            $em->rollback();
            throw new $e->getMessage();
        }
    }

    public function show($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('StoreBundle:Product')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        return $product;
    }

}
