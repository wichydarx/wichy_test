<?php

namespace App\Controller;

use App\Form\ReductionType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ReductionController extends AbstractController
{
    #[Route('/reduction', name: 'app_reduction')]
    public function index(Request $request): Response
    {
        $formulaire = $this->createForm(ReductionType::class);
        $formulaire->handleRequest($request);
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $data = $formulaire->getData();
            $calc = $data['prixInitial'] * $data['pourcentageReduction'] / 100;
            return $this->render('reduction/reduction.html.twig', [
                "data" => $data,
                "calc" => $calc
            ]);
        }
        $formulaire = $this->createForm(ReductionType::class);
        return $this->renderForm('reduction/index.html.twig', [
            'controller_name' => 'ReductionController',
            'formulaire' => $formulaire,
        ]);
    }
}
