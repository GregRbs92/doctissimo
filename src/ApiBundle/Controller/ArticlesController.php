<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * @Rest\Route("/blog")
 */
class ArticlesController extends Controller
{
    /**
     * Retrieve all the articles
     *
     * @Rest\Get("/articles", name="get_articles")
     *
     * @return Response
     */
    public function getAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository(Article::class)->findAll();
        $response = $this->get('serializer')->serialize(['data' => $articles], 'json', ['groups' => ['short_article']]);
        return new Response($response);
    }

    /**
     * Retrieve one article from its id
     *
     * @Rest\Get("/articles/{id}", name="get_article_by_id")
     *
     * @param Article $article
     * @return Response
     */
    public function getByIdAction(Article $article)
    {
        $response = $this->get('serializer')->serialize(['data' => $article], 'json', ['groups' => ['full_article']]);
        return new Response($response);
    }

    /**
     * @Rest\Post("/articles", name="create_article")
     *
     * @param Request $request
     * @return Response
     */
    public function createArticleAction(Request $request) {
        $body = $request->request->all();
        $serializer = $this->get('serializer');
        $article = $serializer->denormalize($body, Article::class, 'json');
        $errors = $this->get('validator')->validate($article);

        if (count($errors) > 0) {
            throw new HttpException(400);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return new Response($serializer->serialize($article, 'json'));
    }
}
