<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'generate:sitemap';
    protected $description = 'Generate sitemap.xml for the site';

    public function handle(): void
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/kehilangan'))
            ->add(Url::create('/penemuan'))
            ->add(Url::create('/profile'))
            ->add(Url::create('/login'))
            ->add(Url::create('/register'));

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');
    }
}
