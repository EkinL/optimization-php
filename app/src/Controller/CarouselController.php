<?php
namespace App\Controller;

use App\Repository\GalaxyRepository;
use App\Repository\ModelesRepository;
use App\Repository\ModelesFilesRepository;
use App\Repository\DirectusFilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarouselController extends AbstractController
{
    #[Route('/carousel', name: 'app_carousel')]
    public function index(
        GalaxyRepository $galaxyRepository,
        ModelesRepository $modelesRepository,
        ModelesFilesRepository $modelesFilesRepository,
        DirectusFilesRepository $directusFilesRepository
    ): Response {
        // Récupération optimisée des galaxies
        $galaxies = $galaxyRepository->findAllWithModeles();
        // dump($galaxies);
        // die();
        $carousel = [];

        // Stocker les IDs des fichiers à récupérer
        $fileIds = [];

        return $this->render('carousel/index.html.twig', [
            'carousel' => $galaxies,
        ]);
    }
}