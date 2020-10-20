<?php

namespace App\Controller;

use App\Form\UploadType;
use App\Entity\Upload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="upload")
     */
    public function new(Request $request, SluggerInterface $slugger)
    {
        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $upload = $form->get('file')->getData();

            $originalFilename = pathinfo($upload->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $uniqid = uniqid();
            $newFilename = $safeFilename . '-' . $uniqid . '.' . $upload->guessExtension();
            $pdfFilename = $safeFilename . '-' . $uniqid . '.pdf';

            // Move the file to the directory where files are stored
            try {
                $upload->move(
                    $this->getParameter('uploads_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            //Convert to pdf
            shell_exec('libreoffice --convert-to pdf ' . $this->getParameter('uploads_directory') . $newFilename . ' --outdir pdf/');

            return $this->render('home/view.html.twig', [
                'pdf' => 'pdf/' . $pdfFilename,
            ]);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
