<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'app_contact')]

    public function index(Request $request): Response
    {
        $formulaire = $this->createForm(ContactType::class);
        $formulaire->handleRequest($request);
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $data = $formulaire->getData();
            return $this->render('contact/contact.html.twig', [
                "data" => $data
            ]);
        }
        $niveau_eleve = "Ca va sympa tranquille la misere";
        return $this->renderForm(
            'contact/index.html.twig',
            [
                'nom_formateur' => 'Melki',
                'prenom' => 'Yoel',
                'Niveau_formateur' => 'Excellent !',
                'niveau_eleve' => $niveau_eleve,
                'formulaire' => $formulaire
            ]
        );
    }
}