<?php
namespace ProcessWire;

use ProcessWire\ModuleConfig;

class StaticWireConfig extends ModuleConfig {

	public function __construct() {
		$this->add([
			[	
				'name' => 'rootPath',
				'type' => 'text',
				'label' => $this->_('Static file path'),
				'description' => $this->_('Directory to generate the HTML files in.'), 
				'notes' => $this->_('Path relative to website\'s root directory.'), 
				'required' => true, 
				'value' => 'static',
			],
		]); 
	}

}
