<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;

use Symfony\Component\Validator\ConstraintViolationList;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ArticleController extends FOSRestController
{

    /**
     * Return the all articles list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Articles List",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     *
     * @return View
     */
    public function getArticlesAction()
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();

        if (!$articles) {
            throw $this->createNotFoundException('Data not found.');
        }

        $view = View::create();
        $view->setData($articles)->setStatusCode(200);

        return $view;
    }

    /**
     * Create an Article from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates an article from the submitted data.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="title", nullable=false, strict=true, description="Title.")
     * @RequestParam(name="content", nullable=false, strict=true, description="Article Content.")
     *
     * @return View
     */
    public function postArticleAction(ParamFetcher $paramFetcher)
    {

        $em = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitle($paramFetcher->get('title'));
        $article->setContent($paramFetcher->get('content'));

        $em->persist($article);
        $em->flush();

        $view = View::create();
        $view->setData($article)->setStatusCode(200);

        return $view;

    }

}