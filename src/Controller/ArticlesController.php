<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use JsonSerializable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Throwable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use GuzzleHttp\Client;


class ArticlesController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/articles")
     */
    public function getArticles()
    {
        $articles = $this->getDoctrine()->getRepository(Articles::class)->findAll();
        $data = array();
        foreach ($articles as $key => $article) {
            $data[$key]['titre'] = $article->getTitre();
            $data[$key]['contenu'] = $article->getContenu();
            $data[$key]['auteur'] = $article->getAuteur();
            $data[$key]['date de publication'] = $article->getDateDePublication();
        }
        return new JsonResponse($data);
        // $data = serialize($articles);
        // return new Response($data);

        //  return $this->render('articles/index.html.twig', ["articles" => $articles]);
    }


    /**
     *  @Rest\Get("/article/{id}"), name="article")
     * @Method({"GET"})
     */
    public function getArticle($id)
    {
        $article = $this->getDoctrine()->getRepository(Articles::class)->find($id);
        $data = serialize($article);
        /* if ($article) {
           
        } else {
            $data = "not found";
        }*/
        if (!$article) {
            throw $this->createNotFoundException();
        }
        return new Response($data);
    }

    /**
     *  @Rest\Post("/article"), name="ajout_article")
     * @Method({"POST"})
     */
    public function addArticle(Request $request, EntityManagerInterface $manager)
    {
        $article = new Articles();
        //  $form = $this->createForm(ArticleType::class, $article);
        // $form->handleRequest($request);
        $article->setTitre('titre3');
        $article->setContenu('contenu3');
        $article->setAuteur('auteur3');
        $date = new \DateTime('10/01/2020');
        $article->setDateDePublication($date);
        $manager->persist($article);
        $manager->flush();
    }

    /**
     *  @Rest\Put("/article/update/{id}"), name="modifier_article")
     * @Method({"PUT"})
     */
    public function updateArticle(Request $request, EntityManagerInterface $manager, $id)
    {
        $article = new Articles();
        $article = $this->getDoctrine()->getRepository(Articles::class)->find($id);
        $article->setTitre('titre4');
        $article->setContenu('contenu3');
        $article->setAuteur('auteur3');
        $date = new \DateTime('10/01/2020');
        $article->setDateDePublication($date);
        $manager->persist($article);
        $manager->flush();
    }

    /**
     *  @Rest\Delete("/article/delete/{id}"), name="supp_article")
     * @Method({"DELETE"})
     */
    public function deleteArticle(Request $request, EntityManagerInterface $manager, $id)
    {
        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['id' => $id]);
        $manager->remove($article);
        $manager->flush();
        return new Response('deleted');
    }
    /**
     *  @Rest\Get("/trois_articles"), name="trois_articles")
     * @Method({"GET"})
     */
    public function getTroisArticles(Request $request)
    {
        $articles = $this->getDoctrine()->getRepository(Articles::class)->findAll();
        foreach ($articles as $key => $article) {
            $data[$key]['titre'] = $article->getTitre();
            $data[$key]['contenu'] = $article->getContenu();
            $data[$key]['auteur'] = $article->getAuteur();
            $data[$key]['date de publication'] = $article->getDateDePublication();
        }
        $sliced_array = array_slice($data, -3);
        // print_r($sliced_array);
        return new JsonResponse($sliced_array);
    }
}
