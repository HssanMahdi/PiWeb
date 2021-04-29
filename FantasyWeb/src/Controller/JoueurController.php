<?php

namespace App\Controller;
use App\Entity\Joueur;
use App\Entity\Rating;
use App\Form\JoueurType;
use App\Form\RatingType;
use App\Repository\EquipeRepository;
use App\Repository\JoueurRepository;
use App\Repository\MatcheventRepository;
use App\Repository\RatingRepository;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class JoueurController extends AbstractController
{
    /**
     * @Route("/joueur", name="joueur")
     */
    public function index(): Response
    {
        return $this->render('joueur/index.html.twig', [
            'controller_name' => 'JoueurController',
        ]);
    }

    /**
     * @param JoueurRepository $repo
     * @return Response
     * @Route ("/DisplayPlayers", name="DisplayPlayers")
     */
    public function DisplayPlayers(JoueurRepository $repo,RatingRepository $repo1,FlashyNotifier $flashy,MatcheventRepository $repo3)
    {

        $matchevent=$repo3->findAll();
        $jzz=0;
        foreach ($matchevent as $e) {
            $obj = new \DateTime();
            $dmy = $obj->format('Y-m-d');
            $timestamp1 = strtotime($e->getDatematch());
            $timestamp2 = strtotime($dmy);
            if ($timestamp1 == $timestamp2) {
                $jzz++;
            }
            if($jzz>0){
                $flashy->error("$jzz Match(s) sera joué aujourd hui");
            }

        }
        $joueur=$repo->findAll();
        $ar=array(new Joueur());
        $i=-1;
        foreach ($joueur as $j){
            $i++;
            $moy=$repo1->av($j->getIdJoueur());
                $j->setRating($moy);
                $ar[$i]=$j;

        }
        return $this->render('joueur/DisplayPlayers.html.twig',
            ['joueur'=>$ar]);
    }

    /**
     * @param JoueurRepository $repo
     * @return Response
     * @Route ("/DisplayPlayerForManager", name="DisplayPlayerForManager")
     */
    public function DisplayPlayerForAdmin(JoueurRepository $repo)
    {

        $joueur=$repo->findAll();
        return $this->render('joueur/DisplayPlayerForManager.html.twig',
            ['joueur'=>$joueur]);
    }

    /**
     * @param JoueurRepository $repo
     * @Route ("/DeletePlayer/{id}", name="DeletePlayer")
     */
    public function DeleteJoueur($id,JoueurRepository $repo)
    {
        $player=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($player);
        $em->flush();
        return $this->redirectToRoute('DisplayPlayerForManager');
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddPlayer", name="AddPlayer")
     */
    public function AddPlayer(Request $request)
    {
        $Joueur=new Joueur();
        $form=$this->createForm(JoueurType::class,$Joueur);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $Equipe = $form['idEquipe']->getData();
            $Joueur->setIdEquipe($Equipe);
            $em=$this->getDoctrine()->getManager();
            $image1File = $form->get('logoJoueur')->getData();
            /** @var UploadedFile $image1File */

            if ($image1File) {
                $originalFilename = pathinfo($image1File->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $image1File->guessExtension();
                $image1File->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $Joueur->setLogoJoueur($newFilename);
            }
            $em->persist($Joueur);
            $em->flush();
            return $this->redirectToRoute('DisplayPlayerForManager');
        }
        return $this->render('joueur/AddPlayers.html.twig',
            ['form'=>$form->createView()]);
    }

    /**
     *@param Request $request
     * @return Response
     * @Route ("/UpdatePlayer/{id}", name="UpdatePlayer")
     */
    public function UpdateJoueur(JoueurRepository $repo,$id,Request $request)
    {
        $player=$repo->find($id);
        $form=$this->createForm(JoueurType::class,$player);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $image1File = $form->get('logoJoueur')->getData();
            /** @var UploadedFile $image1File */

            if ($image1File) {
                $originalFilename = pathinfo($image1File->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $image1File->guessExtension();
                $image1File->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $player->setLogoJoueur($newFilename);
            }
            $em->flush();
            return $this->redirectToRoute('DisplayPlayerForManager');
        }
        return $this->render('joueur/UpdatePlayers.html.twig',
            ['form'=>$form->createView()]);
    }
    /**
     * @param JoueurRepository $repo
     * @return Response
     * @Route ("/DisplayPlayersForEquipe/{id}", name="DisplayPlayersForEquipe")
     */
    public function DisplayPlayersForEquipe(JoueurRepository $repo,$id)
    {

        $joueur=$repo->findBy(array('idEquipe' => $id));
        return $this->render('joueur/DisplayPlayers.html.twig',
            ['joueur'=>$joueur]);
    }

    /**
     * @param JoueurRepository $repo
     * @return Response
     * @Route ("/DisplayPlayersByid/{id}", name="DisplayPlayersByid")
     */
    public function DisplayPlayersByid(JoueurRepository $repo,$id)
    {

        $joueur=$repo->findBy(array('idEquipe' => $id));
        return $this->render('joueur/DisplayPlayerTeamMng.html.twig',
            ['joueur'=>$joueur]);
    }

    /**
     * @Route("/DisplayRating/{id}", name="DisplayRating")
     */
    public function DisplayRating($id)
    {
        return $this->render('rating/index.html.twig',
             ['idJoueurRating'=>$id]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddRates/{id}", name="AddRates")
     */
    public function AddRates(Request $request,RatingRepository $repo,$id)
    {
        $Rating=new Rating();
        $form=$this->createForm(RatingType::class,$Rating);
        $form->handleRequest($request);
        $Rating->setIdUser(7);
        if($form->isSubmitted()&&$form->isValid()){
            $res=$repo->testExist($Rating->getIdUser(),$id);
            if($res){
                $rat=$repo->findOneBy(array('idJoueur' => $id));
                $em=$this->getDoctrine()->getManager();
                $em->remove($rat);
                $em->flush();
            }
            $Rating->setIdJoueur($id);
            $em=$this->getDoctrine()->getManager();
            $em->persist($Rating);
            $em->flush();
            return $this->redirectToRoute('DisplayPlayers');

        }
        return $this->render('rating/index.html.twig',
            ['form'=>$form->createView()]);
    }

    /**
     * @param JoueurRepository $repo
     * @return Response
     * @Route ("/DisplayListe", name="DisplayListe")
     */
    public function DisplayListe(JoueurRepository $repo)
    {            $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', true);
        $pdfOptions->set('isRemoteEnabled', TRUE);
        $pdfOptions->set('debugKeepTemp', TRUE);
        $pdfOptions->set('isHtml5ParserEnabled', true);

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $joueur=$repo->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('joueur/List.html.twig',
            ['joueur'=>$joueur]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);


        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("JoueurDetails.pdf", [
            "Attachment" => true
        ]);


    }


    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }


    private function getData(): array
    {
        /**
         * @var $user Joueur[]
         */
        $list = [];
        $users = $this->entityManager->getRepository(Joueur::class)->findAll();

        foreach ($users as $user) {
            $list[] = [
                $user->getNomJoueur(),
                $user->getPrenomJoueur(),
                $user->getPosition(),
                $user->getScoreJoueur(),
                $user->getPrixJoueur()


            ];
        }
        return $list;
    }

    /**
     * @Route("/testexcel", name="testexcel")
     */
    public function createe()
    {
        $spreadsheet = new Spreadsheet();

        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getCell('A1')->setValue('Nom ');
        $sheet->getCell('B1')->setValue('Prenom ');
        $sheet->getCell('C1')->setValue('Position');
        $sheet->getCell('D1')->setValue('Score');
        $sheet->getCell('E1')->setValue('Prix');
        $sheet->setTitle("My First Worksheet");


        $sheet->fromArray($this->getData(),null, 'A2', true);

        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);

        // Create a Temporary file in the system
        $fileName = 'JoueurDetails.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);

        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);

    }

    /**
     * @Route("/testWord", name="testWord")
     */
    public function testWord(Request $request,JoueurRepository $repo,KernelInterface $kernelInterface)
    {
        // Create a new Word document
        $phpWord = new PhpWord();


        /* Note: any element you append to a document must reside inside of a Section. */
        $imagesFolder = $kernelInterface->getProjectDir().'\public\images\\' ;
        $_local_image_path = $imagesFolder.'cp.PNG';

        // Adding an empty Section to the document...
        $section = $phpWord->addSection();

        $header = $section->addHeader();
        $header->addImage(
            $_local_image_path,
            array(
                'width'            => Converter::cmToPixel(20),
                'height'           => Converter::cmToPixel(1.5),
                'positioning'      => Image::POSITION_ABSOLUTE,
                'posHorizontal'    => Image::POSITION_HORIZONTAL_CENTER,
                'posHorizontalRel' => Image::POSITION_RELATIVE_TO_PAGE,
                'posVerticalRel'   => Image::POSITION_RELATIVE_TO_PAGE,
                'marginLeft'       => Converter::cmToPixel(15.5),
                'marginTop'        => Converter::cmToPixel(1.55),
            )
        );
        $footer = $section->addFooter();
        $footer->addText('Challenge it!');
        // Adding Text element to the Section having font styled by default...
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setColor("de042f");
        $fontStyle->setSize(16);
        $fontStyle->setBold(true);
        $fontStyle->setItalic(true);
        $fontStyle->setPosition('center');
        $fontStyle->setPosition(20);

        $myTextElement =  $section->addText('Liste Des Joueurs', ['size' => 18, 'bold' => true]);
        $myTextElement ->setFontStyle($fontStyle);
        $section->addTextBreak(2);


        $table = $section->addTable();
        $section->addText(" 
        ");

        $table->addRow();
        $table->addCell(1750)->addText("Nom", ['size' => 10, 'bold' => true]);
        $table->addCell(1750)->addText("Prenom",['size' => 10, 'bold' => true]);
        $table->addCell(1750)->addText("Position",['size' => 10, 'bold' => true]);
        $table->addCell(1750)->addText("Prix",['size' => 10, 'bold' => true]);
        $table->addCell(1750)->addText("Score",['size' => 10, 'bold' => true]);
        $joueur=$repo->findAll();

        foreach ($joueur as $j){
            $table->addRow();
            $table->addCell(1750)->addText($j->getNomJoueur());
            $table->addCell(1750)->addText($j->getPrenomJoueur());
            $table->addCell(1750)->addText($j->getScoreJoueur());
            $table->addCell(1750)->addText($j->getPrixJoueur());
            $table->addCell(1750)->addText($j->getPosition());
        }


        // Saving the document as OOXML file...
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        // Create a temporal file in the system
        $fileName = 'JoueurDetalis.docx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Write in the temporal filepath
        $objWriter->save($temp_file);

        // Send the temporal file as response (as an attachment)
        $response = new BinaryFileResponse($temp_file);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $fileName
        );

        return $response;
    }

}
