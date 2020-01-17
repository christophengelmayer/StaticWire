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

    protected function iteratePagetree($page, $callback)
    {
        if (is_callable($callback)) {
            call_user_func($callback, $page);
        }
        foreach ($page->children as $child) {
            $this->iteratePagetree($child, $callback);
        }
    }

    protected function makeStatic($page)
    {
        $path = $this->rootPath . $page->url;
        if(!is_dir($path)) mkdir($path, 0700);
        file_put_contents($path."index.html", $page->render());
    }

    public function build($selector = '/', $debug = false)
    {
        $this->iteratePagetree($this->wire('pages')->get($selector), function ($page) use ($debug) {
            $path = $this->getBuildPath() . $page->url;
            if(!is_dir($path)){
                mkdir($path, 0700, true);
            } else {
            }
            file_put_contents($path."index.html", $page->render());
            if($debug) echo $page->url . "\n";
        });
    }

    public function getBuildPath()
    {
        return $this->config->paths->root . $this->rootPath;
    }
}