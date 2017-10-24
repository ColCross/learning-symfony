<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
    /**
     * @Route("/", name="home")
     */
    public function showPosts(Request $request) {
        $data = [];
        $posts = $this->getDoctrine()->getRepository('AppBundle:Posts')->findBy([], ['date' => 'DESC']);
        $data['posts'] = $posts;

        return $this->render('index.html.twig', $data);
    }
}