<?php

namespace App\Enums;

class PagesPathsEnums
{
    # default currency.
    const staticPages = [
        # about page.
        'about-us' => [
            'controller' => 'Modules\Page\Controllers\Web\PageController',
            'action' => 'about',
        ],

        # Contact us page.
        'contact-us' => [
            'controller' => 'Modules\Page\Controllers\Web\PageController',
            'action' => 'contact',
        ],

        # Career page.
        'careers' => [
            'controller' => 'Modules\Job\Controllers\Web\JobController',
            'action' => 'index',
        ],

        # Blogs page.
        'blogs' => [
            'controller' => 'Modules\Blog\Controllers\Web\BlogController',
            'action' => 'index',
        ],

        # Services page.
        'services' => [
            'controller' => 'Modules\Service\Controllers\Web\ServiceController',
            'action' => 'index',
        ],

        # Services page.
        'book-an-appointment' => [
            'controller' => 'Modules\Booking\Controllers\Web\BookingController',
            'action' => 'index',
        ],
    ];
}
