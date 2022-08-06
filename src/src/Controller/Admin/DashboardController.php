<?php

namespace App\Controller\Admin;

use App\Entity\Attraction;
use App\Entity\Event;
use App\Entity\Form;
use App\Entity\Glasses;
use App\Entity\GlassesStore;
use App\Entity\Hotel;
use App\Entity\Location;
use App\Entity\Message;
use App\Entity\Order;
use App\Entity\Room;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Glasses Market Place');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('User'),
            MenuItem::linkToCrud('Users', 'fa fa-list', User::class),

            MenuItem::section('Product'),
            MenuItem::linkToCrud('Glasses', 'fa fa-list', Glasses::class),

            MenuItem::section('Store'),
            MenuItem::linkToCrud('GlassesStores', 'fa fa-list', GlassesStore::class),

            MenuItem::section('Message'),
            MenuItem::linkToCrud('Messages', 'fa fa-list', Message::class),

            MenuItem::section('Order'),
            MenuItem::linkToCrud('Orders', 'fa fa-list', Order::class),
        ];
    }
}
