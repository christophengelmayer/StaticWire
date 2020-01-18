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
		$f->description = $this->_('Path: ') . $this->getOutputPath();
        $f->notes = $this->_('or run "php site/modules/StaticWire/cli.php" in your ProcessWire root directory');
        $form->add($f);

		return $form->render();
    }	

    public function ___executeGenerate()
    {
        $currentUser = $this->users->getCurrentUser();
        $this->users->setCurrentUser($this->users->getGuestUser());

        $this->export();

        $this->users->setCurrentUser($currentUser);

        $this->message('HTML files generated in '. $this->getOutputPath()); 
        $this->session->redirect('../'); 
    }

    public function test()
    {
        $currentUser = $this->users->getCurrentUser();
        $this->users->setCurrentUser($this->users->getGuestUser());
        $pages = $this->pages->find('include=hidden');
        foreach($pages as $page) {
            $this->message($page->url); 
        }
        $this->users->setCurrentUser($currentUser);
    }

    public function cliCommand()
    {
        echo "Exporting static site to: " . $this->getOutputPath() . "\n";
        $this->export();
    }

    protected function export(string $selector = 'include=hidden')
    {
        $exporter = new HtmlExporter($selector, $this->getOutputPath());
        $exporter->run();
    }

    protected function getOutputPath()
    {
        return $this->config->paths->root . $this->rootPath;
    }
}
