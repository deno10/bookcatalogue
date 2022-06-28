<?php

namespace App\Controller;

use App\Service\CoverProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Routing\Annotation\Route;

Class CoverController extends AbstractController {

    /**
     * @Route("/uploads/covers/{id}", methods={"GET"})
     */
    public function show(string $id, CoverProcessor $coverProcessor): ?BinaryFileResponse
    {
        return $coverProcessor->getImage($id);
    }
}