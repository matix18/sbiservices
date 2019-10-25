<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Services;
use App\Repository\ServicesRepository;

class SbisController extends AbstractController
{
    /**
     * @Route("/sbis", name="sbis")
     */
    public function index()
    {
        return $this->render('sbis/index.html.twig', [
            'controller_name' => 'SbisController',
        ]);
    }

    /**
    *@Route("/", name="home")
    */
    public function home()
    {
    	return $this->render('sbis/home.html.twig', [
    		'title' => 'SBISERVICES',
    		'salut' => 'Bienvenue'
    	]);
    }


    // MONTRER LES DETAILS D'UN ARTICLE
    /**
    *@Route("/sbis/view/12", "voir_plus")
    */
    public function voirplus()
    {
    	return $this->render('sbis/voirplus.html.twig');
    }

    // SELECTION DANS LA BASE DE DONNEES
    /**
    *@Route("/sbiservices/view/services", name="services")
    */
    public function services(){
    	$repo = $this->getDoctrine()->getRepository(Services::class);
    	$articles = $repo->findAll();

    	return $this->render('sbis/services.html.twig', [
    		'title' => 'SBISERVICES',
    		'service' => $articles
    	]);
    }


    // INSERTION DANS LA BASE DE DONNEES
    /**
    *@Route("/sbiservices/articles/creer_article", name="article")
    */
    public function articles(Request $request, ObjectManager $manager){

    	if ($request->request->count() > 0) {
    		# code...
    		$article = new Services();
    		$article->setService($request->request->get('service'))
    				->setDescription($request->request->get('description'))
    				->setPicture($request->request->get('picture'));
    		$manager->persist($article);
    		$manager->flush();
    	}

    	return $this->render('sbis/articles.html.twig', [
    		'title' => 'SBISERVICES',
    		'image' => '../sbis/images/rt-domaine-web.png']);
    }

    /**
    *@Route("/sbiservices/view/materiel", name="materiel")
    */
    public function materiel(){
    	return $this->render('sbis/materiels.html.twig', [
    		'title' => 'SBISERVICES']);
    }

    /**
    *@Route("/sbiservices/view/contact", name="contact")
    */
    public function contact(){
    	return $this->render('sbis/contact.html.twig', [
    		'title' => 'SBISERVICES']);
    }

    /**
    *@Route("/sbiservices/view/recherche", name="recherche")
    */
    public function recherche(){
    	return $this->render('sbis/recherche.html.twig', [
    		'title' => 'SBISERVICES']);
    }
}
