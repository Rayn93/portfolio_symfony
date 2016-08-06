<?php

namespace PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use PortfolioBundle\Form\Type\ContactFormType;


class PortfolioController extends Controller
{
    /**
     * @Route(
     *      "/",
     *      name="portfolio_main"
     * )
     * @Template()
     */
    public function indexAction(Request $request){

        //Rendering project with homePage = true
        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');

        $qb = $ProjectRepo->getQueryBuilder(array(
            'home' => 'home',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC'
        ));

        $query = $qb->getQuery();
        $projects = $query->getResult();

        //Rendering a contact form

        $contactForm = $this->createForm(ContactFormType::class);

        if ($request->isMethod('POST')) {
            $contactForm->handleRequest($request);

            if ($contactForm->isValid()) {

//                $message = \Swift_Message::newInstance()
//                    ->setSubject('Wiadomość z robertsaternus.pl | Robert Saternus Portfolio web-developer-a')
//                    ->setFrom($contactForm->getData()['email'])
//                    ->setTo('robert.saternus@gmail.com')
//                    ->setBody('Message goes here');
//                        $this->renderView(
//                            'PortfolioBundle:Mail:contactFormMail.html.twig',
//                            array(
//                                'name' => $contactForm->getData()['name'],
//                                'message' => $contactForm->getData()['message']
//                            )
//                        )
//                    );

//                $this->get('mailer')->send($message);
//
//                $this->get('session')->getFlashBag()->add('success', 'Dziękuję! Twoja wiadomość została wysłana. Odpiszę tak szybko jak to tylko możliwe');
//
//                return $this->redirect($this->generateUrl('portfolio_main').'#kontakt');

                $name = $contactForm->getData()['name'];

               if($this->sendMail($name)){
                   $this->get('session')->getFlashBag()->add('success', 'Dziękuję! Twoja wiadomość została wysłana. Odpiszę tak szybko jak to tylko możliwe');
                   dump('Udało się wysłać');
               }




            }
            else{
                $this->get('session')->getFlashBag()->add('fail', 'Nie udało się wysłać wiadomości. Sprawdź wszystkie pola formularza. Wszystkie pola są wymagane');

                return $this->redirect($this->generateUrl('portfolio_main').'#kontakt');

            }
        }


        return array(
            'projects' => $projects,
            'contactForm' => $contactForm->createView()
        );
    }

    private function sendMail($body)
    {
        $mail = \Swift_Message::newInstance()
            ->setSubject('test mail')
            ->setFrom('someone@somewhere.com')
            ->setTo('3n1r4r+6wphw4wogrfs0@sharklasers.com')
            ->setBody('message body goes here ' . $body)
        ;

        $this->get('mailer')->send($mail);
    }

    /**
     * @Route(
     *      "/projekty/",
     *       name="portfolio_projects"
     * )
     * @Template("PortfolioBundle:Portfolio:projects_list.html.twig")
     */
    public function projectsAction()
    {
        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');

        $qb = $ProjectRepo->getQueryBuilder(array(
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC'
        ));

        $query = $qb->getQuery();
        $projects = $query->getResult();

        $CategoryRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Category');
        $AllCategory = $CategoryRepo->findAll();


        return array(
            'projects' => $projects,
            'title' => 'Projekty i realizacje',
            'all_projects' => 'WSZYSTKIE',
            'category_search' => true,
            'all_category' => $AllCategory
        );
    }

    /**
     * @Route(
     *      "/tag/{slug}",
     *      name="portfolio_projects_tags"
     * )
     * @Template("PortfolioBundle:Portfolio:projects_list.html.twig")
     */
    public function tagsAction($slug)
    {
        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');

        $qb = $ProjectRepo->getQueryBuilder(array(
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC',
            'tag' => $slug
        ));

        $query = $qb->getQuery();
        $projects = $query->getResult();

        $TagsRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Tags');
        $Tag = $TagsRepo->findOneBy(array('slug' => $slug));
        $TagsCloud = $TagsRepo->findAll();


        return array(
            'projects' => $projects,
            'tag_cloud' => $TagsCloud,
            'title' => sprintf("Projekty z tagiem: <span class=\"highlight\">%s</span>", $Tag->getName())
        );
    }

    /**
     * @Route(
     *      "/kategoria/{slug}",
     *       name="portfolio_projects_categories"
     * )
     * @Template("PortfolioBundle:Portfolio:projects_list.html.twig")
     */
    public function categoryAction($slug)
    {
        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');

        $qb = $ProjectRepo->getQueryBuilder(array(
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC',
            'category' => $slug
        ));

        $query = $qb->getQuery();
        $projects = $query->getResult();

        $CategoryRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Category');
        $CurrentCategory = $CategoryRepo->findOneBy(array('slug'=>$slug));
        $AllCategory = $CategoryRepo->findAll();


        return array(
            'projects' => $projects,
            'title' => sprintf("Projekty z kategorii: <span class=\"highlight\">%s</span>", $CurrentCategory->getName()),
            'current_category' => $CurrentCategory,
            'category_search' => true,
            'all_category' => $AllCategory
        );
    }

}
