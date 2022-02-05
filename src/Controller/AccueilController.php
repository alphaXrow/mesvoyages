<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Description of AccueilController
 *
 * @author alpha
 */
class AccueilController extends AbstractController {
    
    /**
     *
     * @var Environment
     */
    private $twig;
    
    /**
     * 
     * @param Environment $twig
     */
    function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="accueil")
     * @return Response
     */
    public function index(): Response{
        return $this->render("pages/accueil.html.twig");
    }
    
}
