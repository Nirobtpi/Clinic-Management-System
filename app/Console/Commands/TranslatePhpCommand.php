<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TranslatePhpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:php {from=en} {to=bn}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate PHP language file to another language';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fromLang = $this->argument('from');
        $toLang = $this->argument('to');

        $sourcePath = base_path("lang/{$fromLang}/messages.php");
        $targetPath = base_path("lang/{$toLang}/messages.php");

        if (!file_exists($sourcePath)) {
            $this->error("Source file {$fromLang}/messages.php not found.");
            return;
        }

        $source = include $sourcePath;
        $translated = [];

        $tr = new \Stichoza\GoogleTranslate\GoogleTranslate($toLang);
        $tr->setSource($fromLang);

        $this->info("Translating from {$fromLang} to {$toLang}...");

        foreach ($source as $key => $value) {

            try {
                $translated[$key] = $tr->translate($value);
                $this->line("Translated: {$value} → {$translated[$key]}");
                sleep(2);
            } catch (\Exception $e) {
                $this->error("Failed to translate: {$value} ({$e->getMessage()})");
                $translated[$key] = $value;
            }
        }

        file_put_contents($targetPath, "<?php\n return " . var_export($translated, true) . ";\n");
        $this->info("Translation completed. File saved to: {$targetPath}");
    }
}
