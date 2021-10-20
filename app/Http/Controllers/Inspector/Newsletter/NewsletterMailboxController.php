<?php

namespace App\Http\Controllers\Inspector\Newsletter;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class NewsletterMailboxController extends ApiController
{
    public function __construct()
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.newsletter.mailbox.index', [
            'title' => __('inspector.newsletter.mailbox.title')
        ]);
    }
}
