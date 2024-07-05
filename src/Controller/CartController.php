<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CartController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;        
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

        $items = $session->get('cursus', []);
        $lineItems = [];

        foreach($items as $item){
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item->getNameCursus(),
                    ],
                    'unit_amount' => $item->getPrice() * 100,
                ],
                'quantity' => 1,
            ];
        }
        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => $this->generateUrl('payment_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('payment_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        //dd($checkout_session);
        //dd($checkout_session->url);        
        return new RedirectResponse($checkout_session->url,303);
 

    }

    #[Route('/payment/success', name: 'app_success')]
    public function success()
    {
        return $this->render("payment/success.html.twig");
    }

    #[Route('/payment/cancel', name: 'cancel')]
    public function cancel()
    {
        return $this->render("payment/cancel.html.twig");
    }
}
