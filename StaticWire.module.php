<?php 
namespace StaticWire;

use ProcessWire\Process;

class StaticWire extends Process {

    public function ___execute()
    {
        $form = $this->modules->get('InputfieldForm');
		$f = $this->modules->get('InputfieldButton'); 
		$f->value = $this->_('Generate');
		$f->icon = 'code';
        $f->href = "./generate/"; 
		$f->description = $this->_('Path: ') . $this->getBuildPath();
        $f->notes = $this->_('or run "php site/modules/StaticWire/cli.php" in your ProcessWire root directory');
        $form->add($f);

		return $form->render();
    }	

    public function ___executeGenerate()
    {
        $this->build();
        $this->message('HTML files generated in '. $this->getBuildPath()); 
        $this->session->redirect('../'); 
    }

    protected function iteratePagetree($page)
    {
        $this->convertToHtml($page);
        foreach ($page->children as $child) {
            $this->convertToHtml($child);
        }
    }

    protected function convertToHtml($page)
    {
        $path = $this->getBuildPath() . $page->url;
        if(!is_dir($path)) mkdir($path, 0700, true);
        file_put_contents($path."index.html", $page->render());
        if($this->config->cli) echo $page->url . "\n";
    }

    public function build($selector = '/')
    {
        $this->iteratePagetree($this->wire('pages')->get($selector));
    }

    public function getBuildPath()
    {
        return $this->config->paths->root . $this->rootPath;
    }
}