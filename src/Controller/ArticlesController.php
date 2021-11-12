<?php

namespace App\Controller;

use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
    }


    /**
     *  @Rest\Get("/article/{id}"), name="article")
     * @Method({"GET"})
     */
    public function getArticle($id)
    {
        $article = $this->getDoctrine()->getRepository(Articles::class)->find($id);
        $data = serialize($article);
        if (!$article) {
            throw $this->createNotFoundException();
        }
        return new Response($data);
    }

    /**
     *  @Rest\Post("/article", name="article")
     * 
     */
    public function addArticle(Request $request, EntityManagerInterface $manager)
    {
        $data = $request->request->all();

        if (isset($data['titre']) && isset($data['contenu']) && isset($data['auteur'])) {
            $article = new Articles();
            $article->setTitre($data['titre']);
            $article->setContenu($data['contenu']);
            $article->setAuteur($data['auteur']);
            $date = new \DateTime();
            $article->setDateDePublication($date);
            $manager->persist($article);
            $manager->flush();
            return new Response('success with id: ' . $article->getId());
        } else {
            return new Response('error');
        }
    }

    /**
     *  @Rest\Put("/article/update/{id}"), name="modifier_article")
     * @Method({"PUT"})
     */
    public function updateArticle(Request $request, EntityManagerInterface $manager, $id)
    {
        $article = new Articles();
        $article = $this->getDoctrine()->getRepository(Articles::class)->find($id);
        $data = $request->request->all();
        // dd($data);
        if ($article) {
            if (isset($data['titre']) && isset($data['contenu']) && isset($data['auteur'])) {
                $article->setTitre($data['titre']);
                $article->setContenu($data['contenu']);
                $article->setAuteur($data['auteur']);
                $date = new \DateTime();
                $article->setDateDePublication($date);
                $manager->merge($article);
                $manager->flush();
                return new Response('updated with id: ' . $article->getId());
            } else {
                return new Response('error');
            }
        } else {
            if (isset($data['titre']) && isset($data['contenu']) && isset($data['auteur'])) {
                $article = new Articles();
                $article->setTitre($data['titre']);
                $article->setContenu($data['contenu']);
                $article->setAuteur($data['auteur']);
                $date = new \DateTime();
                $article->setDateDePublication($date);
                $manager->persist($article);
                $manager->flush();
                return new Response('updated with id: ' . $article->getId());
            }
        }
    }

    /**
     *  @Rest\Delete("/article/delete/{article}"), name="supp_article")
     * @Method({"DELETE"})
     */
    public function deleteArticle(Request $request, EntityManagerInterface $manager, Articles $article)
    {
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
        return new JsonResponse($sliced_array);
    }
}
