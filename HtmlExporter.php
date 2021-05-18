<?php 

use ProcessWire\Wire;
use ProcessWire\PageArray;

class HtmlExporter extends Wire {

    protected $selector;
    protected $outputPath;

    public function __construct(string $selector, string $outputPath) {
        $this->selector = $selector;
        $this->outputPath = $outputPath;
    }

    public function run()
    {
        if($this->languages !== Null) {
            foreach ($this->languages as $language) {
                $this->languages->setLanguage($language);
                $this->convertPages($this->pages->find($this->selector));
            }
        } else {
            $this->convertPages($this->pages->find($this->selector));
        }
    }

    protected function convertPages(PageArray $pages)
    {
        foreach($pages as $page) {
            $this->convertPage($page);
        }
    }

    protected function convertPage($page)
    {
        if($page->template->filenameExists()){
            $path = $this->outputPath . $page->url;
            if(!is_dir($path)) mkdir($path, 0700, true);
            file_put_contents($path."index.html", $page->render());
            if($this->config->cli) echo $page->url . "\n";
        }
    }

}
