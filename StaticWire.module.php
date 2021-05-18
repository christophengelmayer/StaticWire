<?php 

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

    public function cliCommand()
    {
        echo "Exporting static site to: " . $this->getOutputPath() . "\n";
        $this->export();
    }

    protected function export(string $selector = 'include=hidden')
    {
        require_once(__DIR__.'/HtmlExporter.php');
        $exporter = new HtmlExporter($selector, $this->getOutputPath());

        // Replace $session->redirect() in templates
        $redirectHook = $this->wire->addHookBefore('Session::redirect', function ($event) {
            $event->replace = true;
        });

        $exporter->run();

        $this->wire->removeHook($redirectHook);
    }

    protected function getOutputPath()
    {
        return $this->config->paths->root . $this->rootPath;
    }

}
