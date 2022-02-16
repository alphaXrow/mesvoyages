<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AccueilController
 *
 * @author alpha
 */
class ContactController extends AbstractController {

    /**
     * @Route("/contact", name="contact")
     * @return Response
     */
    public function index(Request $request, MailerInterface $mailer): Response{
        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);
        
        if($formContact->isSubmitted() && $formContact->isValid()) {
            //envoi du mail
            $this->envoiMail($mailer, $contact);
            $this->addFlash('succes', 'Message envoyé');
            return $this->redirectToRoute('contact');
        }
        return $this->render("pages/contact.html.twig", [
            'contact' => $contact,
            'formcontact' => $formContact->createView()
        ]);
    }
    
    /**
     * 
     * @param \Swift_Mailer $mailer
     * @param Contact $contact
     */
     public function envoiMail(MailerInterface $mailer, Contact $contact): Response
    {
        $message = (new Email())
            ->from($contact->getEmail())
            ->to('contact@mesvoyages.fr')
            ->subject('Beau voyage')
            ->html(
                $this->renderView(
                    'pages/_email.html.twig', [
                        'contact' => $contact
                    ]
                ),
        )
        ;
        $mailer->send($message);
        return $this->redirectToRoute('contact');
    }
}
