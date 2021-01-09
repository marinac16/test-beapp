<?php

namespace App\Controller;

use App\Services\DatasExt;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**@var DatasExt */
    private $datasExt;

    public function __construct(DatasExt $datasExt)
    {
        $this->datasExt = $datasExt;
    }

    /**
     * @Route("/", name="app")
     */
    public function index(): Response
    {

        $datas = $this->datasExt->getDatas("https://api.jcdecaux.com/vls/v1/stations?contract=nantes&apiKey=eac86f2a1287f417645f574439af24278441bd8a");

        return $this->render('app/index.html.twig', [
            'datas' => $datas,
        ]);
    }
}
