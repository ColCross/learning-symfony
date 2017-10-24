<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Posts;
use \DateTime;

class PostController extends Controller {

    /**
     * @Route("/post", name="post_new")
     */
    public function createPost(Request $request) {

        $data = [];
        $data['form'] = [];
        $data['mode'] = 'post_new';
        $form = $this ->createFormBuilder()
                        ->add('title')
                        ->add('content')
                        ->getForm()
                ;
        $form->handleRequest( $request );

        if( $form->isSubmitted() ) {
            $form_data = $form->getData();
            $data['form'] = [];
            $data['form'] = $form_data;

            $em = $this->getDoctrine()->getManager();
            $post = new Posts();
            $now = new DateTime();
            $post->setTitle($form_data['title']);
            $post->setDate($now);
            $post->setContent($form_data['content']);

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('home');
        } else {
            return $this->render('post.html.twig', $data);
        }
    }

    /**
     * @Route("/post/edit/{post_id}", name="post_edit")
     */
    public function editPost(Request $request, $post_id) {
        $data = [];
        $post_repo = $this->getDoctrine()->getRepository('AppBundle:Posts');
        $data['mode'] = 'post_edit';
        $data['form'] = [];

        $form = $this->createFormBuilder()
                        ->add('title')
                        ->add('content')
                        ->getForm()
        ;
        $form->handleRequest($request);

        if( $form->isSubmitted() ) {
            $form_data = $form->getData();
            $data['form'] = [];
            $data['form'] = $form_data;
            $post = $post_repo->find($post_id);

            $post->setTitle($form_data['title']);
            $post->setContent($form_data['content']);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('home');
        } else {
            $post = $post_repo->find($post_id);

            $post_data['title'] = $post->getTitle();
            $post_data['content'] = $post->getContent();

            $data['form'] = $post_data;

            return $this->render('post.html.twig', $data);
        }
    }

    /**
     * @Route("/post/delete/{post_id}", name="post_delete")
     */
    public function removePost(Request $request, $post_id) {
        $post_repo = $this->getDoctrine()->getRepository('AppBundle:Posts');
        $post = $post_repo->find($post_id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}