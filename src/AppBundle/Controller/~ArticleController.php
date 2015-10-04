<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;

class ArticleController extends Controller
{
    /**
     * @return array
     * @Get("/articles", defaults={ "_format" = "json" })
     */
    public function getArticlesAction()
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();

        return array(
            'articles' => $articles
        );
    }

    /**
     * @return array
     * @Post("/articles/add", defaults={ "_format" = "json" })
     */
    public function getUsers(Request $request) {



        $article = new Article();

        $form = $this->createForm(new ArticleType(), $article);
        $form->submit($request->request->get($form->getName()));

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($article);
            $em->flush();

            return array (
                'result' => true
            );

//            $view = $this->routeRedirectView('serie_index');
//            return $this->handleView($view);
        }



        return array(
            'form' => $form,
        );

    }

}
