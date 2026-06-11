<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

class MigratePagesToDb extends Command
{
    protected $signature = 'pages:migrate-to-db';
    protected $description = 'Migrate static HTML from blade files into the pages database table';

    public function handle()
    {
        $directory = resource_path('views/frontend/pages');
        $files = \File::files($directory);

        foreach ($files as $file) {
            $filename = $file->getFilename();
            // Skip dynamic.blade.php or other non-content pages
            if ($filename === 'dynamic.blade.php' || $filename === 'home.blade.php') {
                continue;
            }

            $slug = str_replace('.blade.php', '', $filename);
            $slug = str_replace('_', '-', $slug);

            $content = file_get_contents($file->getPathname());

            // Extract content between @section('content') and @endsection
            preg_match("/@section\('content'\)(.*?)@endsection/s", $content, $matches);

            if (isset($matches[1])) {
                $html = trim($matches[1]);
                $title = ucwords(str_replace('-', ' ', $slug));

                \App\Models\Page::updateOrCreate(
                    ['slug' => $slug],
                    ['title' => $title, 'content' => $html]
                );
                $this->info("Migrated: {$slug}");
            }
        }
        $this->info("All pages migrated successfully.");
    }
}
