<?php

namespace App\Controller;

use Stripe\Stripe;
use App\Entity\Purchase;
use Stripe\Checkout\Session;
use App\Repository\ThemesRepository;
use App\Repository\CursusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    private EntityManagerInterface $em;
    private ThemesRepository $themeRepo;

    public function __construct(EntityManagerInterface $em, ThemesRepository $themeRepo)
    {
        $this->em=$em;  
        $this->themeRepo=$themeRepo;      
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(): Response
    {       
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    #[Route('/checkout', name: 'app_checkout', methods: 'POST')]
    public function checkout(SessionInterface $session): Response
    {
        Stripe::setApiKey($this->getParameter('stripe_secret_key'));

        $items = $session->get('cart', []);
        $lineItems = [];
       
        foreach($items as $item){          
            if($item['lesson']){
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item['lesson']->getNameLesson(),
                        ],
                        'unit_amount' => $item['lesson']->getPrice() * 100,
                    ],
                    'quantity' => 1,
                ]; 
            }elseif($item['cursus']){
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item['cursus']->getNameCursus(),
                        ],
                        'unit_amount' => $item['cursus']->getPrice() * 100,
                    ],
                    'quantity' => 1,
                ];
            }
        }

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => $this->generateUrl('payment_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('payment_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        // Store the checkout session URL in the Symfony session
        $session->set('checkout_url', $checkout_session->url);
        // Redirection to intermediate route
        return $this->redirectToRoute('checkout_redirect');
    }

    #[Route('/checkout/redirect', name: 'checkout_redirect')]
    public function checkoutRedirect(SessionInterface $session): Response
    {
        // Retrieve the session URL
        $checkoutUrl = $session->get('checkout_url');

        // Return the template with the JavaScript redirection
        return $this->render('redirect.html.twig', [
            'checkout_url' => $checkoutUrl,
        ]);
    }

    #[Route('/payment/success', name: 'app_success')]
    public function success(SessionInterface $session, CursusRepository $cursusRepository): Response
    {
        ///
        $user = $this->getUser();
        if(!$user){
            throw $this->createAccessDeniedException('Vous devez être connecté pour effectuer un achat.');
        }

        try {
            $this->em->beginTransaction();       

            $items = $session->get('cart', []);
            $date = new \DateTime();

            foreach($items as $item){
               
                if(isset($item['cursus'])){                    
                    
                    /*if (!$this->em->contains($item['cursus'])) {
                        $this->em->persist($item['cursus']);
                    } */   
                         
                    $purchase = new Purchase();
                    $purchase->setUser($user);
                    $cursus=$cursusRepository->find($item['cursus']->getId());
                    if (!$this->em->contains($cursus)) {
                        $this->em->persist($cursus);
                    }
                    //dd($cursus);
                    /*if(!$this->em->contains()){

                    }*/
                    //$theme=$this->themeRepo->findOneBy(['id'=> $item['cursus']->getTheme()]);
                    //$item['cursus']->setTheme($theme);
                    $purchase->setCursus($cursus);
                    $purchase->setPurchaseDate($date);  
                         
                    //dd($purchase);             
                    $this->em->persist($purchase);       
                }                
            }
            
            $this->em->flush();
            $this->em->commit();


            ////

            //empty the basket
            $session->remove('cart');
            return $this->render("payment/success.html.twig");
            } catch (\Exception $e) {
                $this->em->rollback();
                throw $e;
            }
    }

    #[Route('/payment/cancel', name: 'cancel')]
    public function cancel()
    {
        return $this->render("payment/cancel.html.twig");
    }
}
