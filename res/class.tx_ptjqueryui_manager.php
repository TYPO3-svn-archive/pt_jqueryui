<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Joachim Mathes <mathes@punkt.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/



/**
 * Class definition file for jquery extension main class
 * @author Joachim Mathes <mathes@punkt.de>, Michael Knoll <knoll@punkt.de>
 * @since 2009-10-01
 * @version $Id:$
 */



/**
 * Inclusion of external ressources
 */
require_once(PATH_tslib.'class.tslib_pibase.php');
require_once(t3lib_extMgm::extPath('pt_tools') . 'res/staticlib/class.tx_pttools_assert.php');


/**
 * Plugin 'jQuery UI' for the 'pt_jqueryui' extension.
 *
 * @author        Joachim Mathes <mathes@punkt.de>
 * @since         2009-07-23
 * @package       Typo3
 * @subpackage    pt_jqueryui
 */
class tx_ptjqueryui_manager extends tslib_pibase {
	
	
	
	/*****************************************************************************
     * Properties
     *****************************************************************************/

    public $prefixId      = 'tx_ptjqueryui';           // Same as class name
    public $scriptRelPath = 'class.tx_ptjqueryui.php'; // Path to this script relative to the extension dir.
    public $extKey        = 'pt_jqueryui';             // The extension key.
    public $pi_checkCHash = true;

    
    
    /**
     * Holds the JavaScript tags to insert into the page header.
     *
     * @var array    $JSTags
     */
    protected $JSTags = array();

    
    
    /**
     * Holds the components configuration.
     *
     * The minimized versions of jQuery [UI] are inserted by default.
     *
     * @var array    $JQueryUIconfiguration
     */
    protected $JQueryUIConfiguration = array(
					     'version'    => '',
					     'jq'     => '',
					     'jqui'   => '',
					     'position'   => '',
					     'components' => array(
								   'effects'      => array(),
								   'interactions' => array(),
								   'widgets'      => array()
								   ),
					     'languages'  => array()
					     );


					     
					     
    /*****************************************************************************
     * Main method (returns script tags or adds headers)
     *****************************************************************************/

    /**
     * The main method of the PlugIn
     *
     * @param     string    Content passed from TYPO3
     * @param     array     TypoScript configuration passed from TYPO3
     * @return    string    The content that is displayed on the website
     * @author    Joachim Mathes <mathes@punkt.de>
     * @since     2009-07-23
     */
    public function main($content, $conf) {
	
		$this->conf = $conf;
		
		$this->getConfiguration();
		$this->getData();
		$content .= $this->generateIncludes();
	
		return $content;
		
    }
    
    
    
    /*****************************************************************************
     * Processing TS configuration
     *****************************************************************************/

    /**
     * Processes and saves the TypoScript configuration of jQuery UI.
     *
     * @return    array    The array of file names which shall be included 
     * @author    Joachim Mathes <mathes@punkt.de>
     * @since     2009-07-23
     */
    protected function getConfiguration() {
	
		// Check where JavaScript tags shall be positioned:
		//  - head (default)
		//  - body
		if (array_key_exists('position', $this->conf) &&
		    strcasecmp($this->conf['position'], 'body') == 0) {
	
		    $this->JQueryUIConfiguration['position'] = $this->conf['position'];
		} 
	
        // Check which version shall be included.
        // Default: latest version.
        $availableVersions = $this->getJQueryUIVersions();
		$this->JQueryUIConfiguration['version'] = $availableVersions[count($availableVersions) - 1];
		
		if (array_key_exists('version', $this->conf)) {
	
		    if (strcasecmp($this->conf['version'], 'max') == 0) {
			$this->JQueryUIConfiguration['version'] = $availableVersions[count($availableVersions) - 1];
		    } else {
			
			if (in_array($this->conf['version'], $availableVersions)) {
			    $this->JQueryUIConfiguration['version'] = $this->conf['version'];
			} else {
			    $this->JQueryUIConfiguration['version'] = $availableVersions[count($availableVersions) - 1];
			}
	
		    }
		}
		
		// Check which JQuery ==>UI<== variant shall be used.
		// Fallback: 1. normal
		//           2. minimized
		$possibleVariants = array('normal', 'minimized');
		$availableVariants = $this->getJQueryUIVariants($this->JQueryUIConfiguration['version']);
		$variant = '';
	
		if (array_key_exists('variant', $this->conf)) {
	
		    if (array_key_exists($this->conf['variant'], $availableVariants)) {
				$variant = $this->conf['variant'];
				$this->JQeryUIConfiguration['jqui'] = $availableVariants[$this->conf['variant']];
		    }
	
		}
	
		if ($variant == '') {
	
		    foreach ($possibleVariants as $variant) {
				if (array_key_exists($variant, $availableVariants)) {
				    $this->JQeryUIConfiguration['jqui'] = $availableVariants[$variant];
				    break;
				} 
		    }
	
		}
	
	
		// Check which JQuery variant shall be used.
		// Fallback: 1. normal
		//           2. minimized
		$possibleVariants = array('normal', 'minimized');
		$availableVariants = $this->getJQueryVariants($this->JQueryUIConfiguration['version']);
		$variant = '';
	
		if (array_key_exists('variant', $this->conf)) {
	
		    if (array_key_exists($this->conf['variant'], $availableVariants)) {
				$variant = $this->conf['variant'];
				$this->JQueryUIConfiguration['jq'] = $availableVariants[$this->conf['variant']];
				
		    }
	
		}
	
		if ($variant == '') {
	
		    foreach ($possibleVariants as $variant) {
				if (array_key_exists($variant, $availableVariants)) {
				    $this->JQueryUIConfiguration['jq'] = $variant;
				    break;
				} 
		    }
	
		}
	
		// Check which components shall be included.
		// Check for:
		//  - Effects
		//  - Interactions
		//  - Widgets
		if (array_key_exists('components.', $this->conf)) {
			
		    // Effects
		    if (array_key_exists('effects.', $this->conf['components.']) && 
			is_array($this->conf['components.']['effects.'])) {
	            
				foreach ($this->conf['components.']['effects.'] as $number => $value){
				    $this->JQueryUIConfiguration['components']['effects'][] = $this->conf['components.']['effects.'][$number];
				}
		    }
	
		    // Interactions
		    if (array_key_exists('interactions.', $this->conf['components.']) && 
			is_array($this->conf['components.']['interactions.'])) {
		            
				foreach ($this->conf['components.']['interactions.'] as $number => $value){
				    $this->JQueryUIConfiguration['components']['interactions'][] = $this->conf['components.']['interactions.'][$number];
				}
		    }
	
		    // Widgets
		    if (array_key_exists('widgets.', $this->conf['components.']) && 
			is_array($this->conf['components.']['widgets.'])) {
		            
				foreach ($this->conf['components.']['widgets.'] as $number => $value){
				    $this->JQueryUIConfiguration['components']['widgets'][] = $this->conf['components.']['widgets.'][$number];
				}
		    }
	
	        
		    // Check which languages shall be included.
		    if (array_key_exists('languages.', $this->conf) &&
	 		is_array($this->conf['languages.'])) {
		            
				foreach ($this->conf['languages.'] as $number => $value){
				    $this->JQueryUIConfiguration['components']['languages'][] = $this->conf['languages.'][$number];
				}
		    }
		}
	
	
		// Check which languages shall be included.
	    $availableLanguages = $this->getJQueryUILanguages($this->JQueryUIConfiguration['version']);
	
		if (array_key_exists('languages.', $this->conf)) {
	
		    foreach ($this->conf['languages.'] as $language){
				if (array_key_exists($language, $availableLanguages)) {
				    $this->JQueryUIConfiguration['languages'][] = $availableLanguages[$language];
				}
		    }
		}
    }


    
    /*****************************************************************************
     * Helper methods
     *****************************************************************************/
    
    /**
     * Creates JavaScript HTML tags.
     * 
     * Furthermore file dependencies in the jQuery UI configuration are checked.
     *
     * The algorithm of including and excluding components works as follows:
     *  1. The monolithic jQuery UI package is included by default.
     *  2. The monolithic language package, which consists of all languages is
     *     included by default.
     *  3. If any effect, interaction, widget or the core is included explicitly
     *     by a TypoScript configuration, pt_jqueryui discards the monolithic
     *     packages and includes the jQuery UI core instead.
     *  4. If any language is included explicitly by a TypoScript configuration,
     *     the monolithic language package is discarded.
     *
     * @param     void
     * @return    void
     * @author    Joachim Mathes <mathes@punkt.de>
     * @since     2009-07-27
     */
    protected function getData() {
	
		$data = array();
	    
		// Include jQuery library
		$data[] = '<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath('pt_jqueryui') . 'versions/' . $this->JQueryUIConfiguration['version'] . '/' . $this->JQueryUIConfiguration['jq'] . '"></script>' . "\n";
		
		// Check components
		if (empty($this->JQueryUIConfiguration['components']['effects']) &&
		    empty($this->JQueryUIConfiguration['components']['interactions']) &&
		    empty($this->JQueryUIConfiguration['components']['widgets'])) {
	
		    // Include monolithic jQuery and jQuery UI library.
		    $data[] = '<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath('pt_jqueryui') . 'versions/' . $this->JQueryUIConfiguration['version'] . '/' . $this->JQueryUIConfiguration['jqui'] . '"></script>' . "\n";
		}
		else {

			#print_r($this->JQueryUIConfiguration);
            #die();
	
		    // Include jQuery components
		    foreach ($this->JQueryUIConfiguration['components'] as $key => $value) {
		
				if (!empty($value)) {
		
				    foreach ($value as $component) {
					    $data[] = '<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath('pt_jqueryui') . 'versions/' . $this->JQueryUIConfiguration['version'] . '/' . $key . '/' . $component . '.js' . '"></script>' . "\n";
				    } 
				}
		    }
		}
	
		// Check languages
		if (empty($this->JQueryUIConfiguration['languages'])) {
		    
		    // Include monolithic jQuery language library.
		    $data[] = '<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath('pt_jqueryui') . 'versions/' . $this->JQueryUIConfiguration['version'] . '/languages/i18n.js"></script>' . "\n";
		}
		else {
	
		    // Include individual jQuery files
		    foreach ($this->JQueryUIConfiguration['languages'] as $language) {
			    $data[] = '<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath('pt_jqueryui') . 'versions/' . $this->JQueryUIConfiguration['version'] . '/languages/' . $this->JQueryUIConfiguration['languages'][$language] . '"></script>' . "\n";
		    } 
	
		}
	
		$this->data = $data;
    }


    
    /**
     * Includes JavaScript tags into TYPO3 page.
     *
     * TODO: This method should register all included JavaScript files in a
     *       framework, which takes care of not including conflicting
     *       JavaScripts. The framework could be based on the TYPO3 extension
     *       `jsmanager' by Joerg Schoppet.
     *
     * @param     void
     * @return    string    content
     * @author    Joachim Mathes <mathes@punkt.de>
     * @since     2009-07-24
     */
    protected function generateIncludes() {

		$content = '';
	
        switch($this->position) {
	        case 'head':
	            $GLOBALS['TSFE']->additionalJavaScript[$this->extKey] = implode("\n", $this->data);
	            break;
			case 'body':
			    $content = implode("\n", $this->data);
			    break;
			default:
			    $GLOBALS['TSFE']->additionalJavaScript[$this->extKey] = implode("\n", $this->data);
        }
		
		return $content;
		
    }


    
    /**
     * Returns available versions of jQuery UI.
     * 
     * To achieve this, it iterates over the versions-directory. It expects the directories
     * to be named like
     * <directory> ::= <number>(.<number>)*
     *
     * @return    array    versions
     * @author    Joachim Mathes <mathes@punkt.de>
     * @since     2009-07-23
     */
    protected function getJQueryUIVersions() {

		$versions = array();
		$files = new DirectoryIterator(t3lib_extMgm::extPath('pt_jqueryui', 'versions'));
	
		foreach ($files as $file) {
			// directory mustn't be '.', '..' or hidden directory
		    if ($file->isDir() && !$file->isDot() && !preg_match('/^\..+/',$file->getFileName())) {
			    $versions[] = $file->getFilename();
		    }
		}
	
		sort($versions);
	
		return $versions;
		
    }




    /**
     * Returns available variants of jQuery UI, i.e. normal or minimized.
     *
     * @param     string    Defines the version directory in which to search.
     * @return    array     variants
     * @author    Joachim Mathes <mathes@punkt.de>
     * @since     2009-07-23
     */
    protected function getJQueryUIVariants($version) {
    	
    	tx_pttools_assert::isNotEmptyString($version);

		$variants = array();
		$files = new DirectoryIterator(t3lib_extMgm::extPath('pt_jqueryui', 'versions/' . $version . '/'));
		
        foreach ($files as $file) {
            if ($file->isFile()) {
		        if ($file->getFileName() == 'jquery-ui.js') {
		        	$variants['normal'] = $file->getFileName();
		        }
		        if ($file->getFileName() == 'jquery-ui.min.js') {
		        	$variants['minimized'] = $file->getFileName();
		        }
		    }
        }
	
		return $variants;
		
    }



    /**
     * Returns available variants of jQuery, i.e. normal or minimized.
     *
     * @param     string    Defines the version directory in which to search.
     * @return    array     variants
     * @author    Joachim Mathes <mathes@punkt.de>
     * @since     2009-07-27
     */
    protected function getJQueryVariants($version) {

		$variants = array();
		$files = new DirectoryIterator(t3lib_extMgm::extPath('pt_jqueryui', 'versions/' . $version));
		
        foreach ($files as $file) {
            if ($file->isFile()) {
                if ($file->getFileName() == 'jquery.js') {
                    $variants['normal'] = $file->getFileName();
                }
                if ($file->getFileName() == 'jquery.min.js') {
                    $variants['minimized'] = $file->getFileName();
                }
            }
        }
	
		return $variants;
		
    }



    /**
     * Returns available languages of jQuery UI.
     *
     * To achieve this, it iterates over the respective version's language
     * directory.
     *
     * @param     string    Defines the version directory in which to search.
     * @return    array     languages
     * @author    Joachim Mathes <mathes@punkt.de>
     * @since     2009-07-24
     */
    protected function getJQueryUILanguages($version) {

		$languages = array();
		$files = new DirectoryIterator(t3lib_extMgm::extPath('pt_jqueryui', 'versions/' . $version . '/languages'));
		
        foreach ($files as $file) {
            if ($file->isFile()) {
				$fileName = $file->getFilename();
				$fileName = str_replace('.js', '', $fileName);
				$languages[$filename] = $file->getFilename();
            }
        }
	
		return $languages;
		
    }

}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pt_jqueryui/class.tx_ptjqueryui.php']) {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pt_jqueryui/class.tx_ptjqueryui.php']);
}

?>