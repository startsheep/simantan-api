<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Http\Traits\Helpers;
use App\Http\Traits\NameSpaceFixer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Search extends Command
{
    use NameSpaceFixer;

    protected $basePath = 'App\Http\Searches';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:search {search : The name of the migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Search';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $search = $this->argument('search');

        if (!File::exists($this->getBaseDirectory($search))) {
            File::makeDirectory($this->getBaseDirectory($search), 0755, true);
        }

        $title = title($search);
        $baseName = $this->getBaseFileName($search);

        $searchPath = 'app/Http/Searches/' . $title;
        $filePath = $searchPath . '.php';
        $searchNameSpacePath = $this->getNameSpacePath($this->getNameSpace($searchPath));

        if (!File::exists($filePath)) {
            $fileContent = "<?php\n\nnamespace " . $searchNameSpacePath . ";\n\nuse Illuminate\\Database\\Eloquent\\Model;\n\nclass " . $baseName . " extends HttpSearch\n{\n\n \tprotected function passable()\n\t{\n\t\treturn Model::query();\n\t}\n\n\tprotected function filters(): array\n\t{\n\t\treturn [\n \n\t\t];\n\t}\n\n\tprotected function thenReturn(\$" . Str::camel($baseName) . ")\n\t{\n\t\treturn \$" . Str::camel($baseName) . ";\n\t}\n}";

            File::put($filePath, $fileContent);

            $this->info('Search Files Created Successfully.');
        } else {
            $this->error('Search Files Already Exists.');
        }
    }
}
