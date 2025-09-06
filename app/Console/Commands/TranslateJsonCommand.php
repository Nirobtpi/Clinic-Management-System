<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\File;

class TranslateJsonCommand extends Command
{
    protected $signature = 'translate:json {from=en} {to=bn}';
    protected $description = 'Translate JSON language file to another language';

    public function handle()
    {
        $fromLang = $this->argument('from');
        $toLang = $this->argument('to');

        $sourcePath = resource_path("lang/{$fromLang}.json");
        $targetPath = resource_path("lang/{$toLang}.json");

        if (!File::exists($sourcePath)) {
            $this->error("Source file {$fromLang}.json not found.");
            return;
        }

        $source = json_decode(File::get($sourcePath), true);
        $translated = [];
        // $translated = File::exists($targetPath)
        //     ? json_decode(File::get($targetPath), true)
        //     : [];

        $tr = new GoogleTranslate($toLang);
        $tr->setSource($fromLang);

        $this->info("Translating from {$fromLang} to {$toLang}...");

        foreach ($source as $key => $value) {

            if (isset($translated[$key]) && !empty($translated[$key])) {
                $this->line("Skipped (already translated): {$value}");
                continue;
            }

            try {
                $translated[$key] = $tr->translate($value);
                $this->line("Translated: {$value} → {$translated[$key]}");
                sleep(1);
            } catch (\Exception $e) {
                $this->error("Failed to translate: {$value} ({$e->getMessage()})");
                $translated[$key] = $value;
            }
        }

        File::put($targetPath, json_encode($translated, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $this->info("Translation completed. File saved to: {$targetPath}");
    }
}
