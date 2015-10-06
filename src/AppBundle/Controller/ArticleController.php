<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;

use Symfony\Component\Validator\ConstraintViolationList;

use AppBundle\Entity\Answer;
use AppBundle\Entity\Article;
use AppBundle\Entity\Rate;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ArticleController extends FOSRestController
{

    /**
     * return \Acme\DemoBundle\NoteManager
     */
    public function getNoteManager()
    {
        return $this->get('acme.demo.note_manager');
    }

    /**
     * Return the all articles list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Articles List",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the article is not found"
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

    /**
     * Add an answer from the submitted data by article ID.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Add an answer from the submitted data by article ID.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="id", nullable=false, strict=true, description="Article id.")
     * @RequestParam(name="content", nullable=false, strict=true, description="Answer Content.")
     *
     * @return View
     */
    public function postAnswerAction(ParamFetcher $paramFetcher)
    {

        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('AppBundle:Article')->find($paramFetcher->get('id'));
        if (!$article) {
            throw $this->createNotFoundException('Data not found.');
        }

        $answer = new Answer();
        $answer->setArticle($article);
        $answer->setContent($paramFetcher->get('content'));

        $em->persist($answer);
        $em->flush();

        $view = View::create();
        $view->setData($answer)->setStatusCode(200);

        return $view;

    }

    /**
     * Rate an article
     * @ApiDoc(
     *   resource = true,
     *   description = "Add an answer from the submitted data by article ID.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="id", nullable=false, strict=true, description="Article id.")
     * @RequestParam(name="value",  requirements="[0+5]+", nullable=false, strict=true, description="Rate Value.")
     *
     * @return View
     */
    public function postRateAction(ParamFetcher $paramFetcher)
    {

        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('AppBundle:Article')->find($paramFetcher->get('id'));

        $answer = new Rate();
        $answer->setArticle($article);
        $answer->setValue($paramFetcher->get('value'));

        $em->persist($answer);
        $em->flush();

        $view = View::create();
        $view->setData($answer)->setStatusCode(200);

        return $view;

    }



}