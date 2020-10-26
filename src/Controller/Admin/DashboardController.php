<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
  /**
   * @Route("/admin")
   * @return Response
   */
  public function index(): Response
  {
//    return parent::index();
    $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

    return $this->redirect($routeBuilder->setController(ProductCrudController::class)->generateUrl());
  }

  public function configureDashboard(): Dashboard
  {
    return Dashboard::new()
        // the name visible to end users
        ->setTitle('ACME Corp.')
        // you can include HTML contents too (e.g. to link to an image)
        ->setTitle('<img src="..."> ACME <span class="text-small">Corp.</span>')

        // the path defined in this method is passed to the Twig asset() function
        ->setFaviconPath('favicon.svg')

        // the domain used by default is 'messages'
        ->setTranslationDomain('my-custom-domain')

        // there's no need to define the "text direction" explicitly because
        // its default value is inferred dynamically from the user locale
        ->setTextDirection('ltr')
        ;
  }

  public function configureMenuItems(): iterable
  {
    yield MenuItem::section('Important');
    yield MenuItem::linkToCrud('Products', 'fab fa-product-hunt', Product::class);
    yield MenuItem::linkToCrud('Offers', 'fab fa-buffer', Offer::class);
  }
}