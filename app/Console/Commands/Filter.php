<?php

namespace App\Console\Commands;

use App\Http\Traits\NameSpaceFixer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Filter extends Command
{
    use NameSpaceFixer;

    protected $basePath = 'App\Http\Searches\Filters';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter {filter : The name of the migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make filter';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filter = $this->argument('filter');

        if (! File::exists($this->getBaseDirectory($filter))) {
            File::makeDirectory($this->getBaseDirectory($filter), 0755, true);
        }

        $title = title($filter);
        $baseName = $this->getBaseFileName($filter);

        $filterPath = 'app/Http/Searches/Filters/'.$title;
        $filePath = $filterPath.'.php';
        $filterNameSpacePath = $this->getNameSpacePath($this->getNameSpace($filterPath));

        if (! File::exists($filePath)) {
            $fileContent = "<?php\nnamespace ".$filterNameSpacePath.";\n\nuse Closure;\nuse Illuminate\Database\Eloquent\Builder;\nuse App\Http\Searches\Contracts\FilterContract;\n\nclass ".$baseName." implements FilterContract\n{\n\t/** @var string|null */\n\tprotected \$".Str::camel($baseName).";\n\n\t/**\n\t * @param string|null \$".Str::camel($baseName)."\n\t * @return void\n\t */\n\tpublic function __construct(\$".Str::camel($baseName).")\n\t{\n\t\t\$this->".Str::camel($baseName).' = $'.Str::camel($baseName).";\n\t}\n\n\t/**\n\t * @return mixed\n\t */\n\tpublic function handle(Builder \$query, Closure \$next)\n\t{\n\t\tif (!\$this->keyword()) {\n\t\t\treturn \$next(\$query);\n\t\t}\n\t\t\$query->where('".Str::snake($baseName)."', 'LIKE', '%' . \$this->".Str::camel($baseName)." . '%');\n\n\t\treturn \$next(\$query);\n\t}\n\n\t/**\n\t * Get ".Str::camel($baseName)." keyword.\n\t *\n\t * @return mixed\n\t */\n\tprotected function keyword()\n\t{\n\t\tif (\$this->".Str::camel($baseName).") {\n\t\t\treturn \$this->".Str::camel($baseName).";\n\t}\n\n\t\t\$this->".Str::camel($baseName)." = request('".Str::snake($baseName)."', null);\n\n\t\treturn request('".Str::snake($baseName)."');\n\t}\n}";

            File::put($filePath, $fileContent);

            $this->info('Filter Files Created Successfully.');
        } else {
            $this->error('Filter Files Already Exists.');
        }
    }
}
