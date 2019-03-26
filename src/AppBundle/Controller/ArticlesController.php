<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Rest\Route("/blog")
 */
class ArticlesController extends Controller
{
    /**
     * @Rest\Route("/articles", name="list_articles")
     */
    public function listArticlesAction() {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository(Article::class)->findAll();
        return $this->render('@App/list_articles.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Rest\Route("/articles/{id}", name="article_details")
     */
    public function getArticleAction(Article $article) {
        return $this->render('@App/show_article.html.twig', [
            'article' => $article
        ]);
    }
}
