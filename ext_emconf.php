<?php

########################################################################
# Extension Manager/Repository config file for ext: "pt_jqueryui"
#
# Auto generated 26-10-2009 12:28
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'jQuery User Interface',
	'description' => 'User Interface Library for jQuery',
	'category' => 'plugin',
	'author' => 'Joachim Mathes, Michael Knoll',
	'author_email' => 'mathes@punkt.de',
	'shy' => '',
	'dependencies' => 'pt_tools',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => 'punkt.de GmbH',
	'version' => '0.0.2dev',
	'constraints' => array(
		'depends' => array(
			'pt_tools' => '0.4.2',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:80:{s:9:"ChangeLog";s:4:"0bdb";s:10:"README.txt";s:4:"d545";s:12:"ext_icon.gif";s:4:"4546";s:17:"ext_localconf.php";s:4:"0094";s:14:"ext_tables.php";s:4:"10ac";s:20:"typoscript/setup.txt";s:4:"c93e";s:14:"doc/DevDoc.txt";s:4:"f838";s:14:"doc/manual.sxw";s:4:"d5d9";s:27:"versions/1.7.2/jquery-ui.js";s:4:"70fe";s:31:"versions/1.7.2/jquery-ui.min.js";s:4:"6d9a";s:24:"versions/1.7.2/jquery.js";s:4:"e4af";s:28:"versions/1.7.2/jquery.min.js";s:4:"bb38";s:42:"versions/1.7.2/components/effects/blind.js";s:4:"7565";s:43:"versions/1.7.2/components/effects/bounce.js";s:4:"80de";s:41:"versions/1.7.2/components/effects/clip.js";s:4:"677b";s:41:"versions/1.7.2/components/effects/core.js";s:4:"1752";s:41:"versions/1.7.2/components/effects/drop.js";s:4:"11b1";s:44:"versions/1.7.2/components/effects/explode.js";s:4:"802c";s:41:"versions/1.7.2/components/effects/fold.js";s:4:"8ef9";s:46:"versions/1.7.2/components/effects/highlight.js";s:4:"af7a";s:44:"versions/1.7.2/components/effects/pulsate.js";s:4:"e59b";s:42:"versions/1.7.2/components/effects/scale.js";s:4:"692f";s:42:"versions/1.7.2/components/effects/shake.js";s:4:"79a9";s:42:"versions/1.7.2/components/effects/slide.js";s:4:"fedd";s:45:"versions/1.7.2/components/effects/transfer.js";s:4:"e0cb";s:51:"versions/1.7.2/components/interactions/draggable.js";s:4:"7340";s:51:"versions/1.7.2/components/interactions/droppable.js";s:4:"dd0d";s:51:"versions/1.7.2/components/interactions/resizable.js";s:4:"138c";s:52:"versions/1.7.2/components/interactions/selectable.js";s:4:"39c4";s:50:"versions/1.7.2/components/interactions/sortable.js";s:4:"7535";s:46:"versions/1.7.2/components/widgets/accordion.js";s:4:"ad3a";s:47:"versions/1.7.2/components/widgets/datepicker.js";s:4:"687d";s:43:"versions/1.7.2/components/widgets/dialog.js";s:4:"32e5";s:48:"versions/1.7.2/components/widgets/progressbar.js";s:4:"44f6";s:43:"versions/1.7.2/components/widgets/slider.js";s:4:"daab";s:41:"versions/1.7.2/components/widgets/tabs.js";s:4:"f07e";s:38:"versions/1.7.2/components/core/core.js";s:4:"2221";s:30:"versions/1.7.2/languages/ar.js";s:4:"7388";s:30:"versions/1.7.2/languages/bg.js";s:4:"1a88";s:30:"versions/1.7.2/languages/ca.js";s:4:"30ce";s:30:"versions/1.7.2/languages/cs.js";s:4:"aca9";s:30:"versions/1.7.2/languages/da.js";s:4:"4841";s:30:"versions/1.7.2/languages/de.js";s:4:"4de3";s:30:"versions/1.7.2/languages/el.js";s:4:"b799";s:30:"versions/1.7.2/languages/eo.js";s:4:"686a";s:30:"versions/1.7.2/languages/es.js";s:4:"07ab";s:30:"versions/1.7.2/languages/fa.js";s:4:"c81e";s:30:"versions/1.7.2/languages/fi.js";s:4:"105a";s:30:"versions/1.7.2/languages/fr.js";s:4:"74a0";s:30:"versions/1.7.2/languages/he.js";s:4:"c3f1";s:30:"versions/1.7.2/languages/hr.js";s:4:"8ea1";s:30:"versions/1.7.2/languages/hu.js";s:4:"804c";s:30:"versions/1.7.2/languages/hy.js";s:4:"b5f2";s:32:"versions/1.7.2/languages/i18n.js";s:4:"6d6f";s:30:"versions/1.7.2/languages/id.js";s:4:"4daf";s:30:"versions/1.7.2/languages/is.js";s:4:"c325";s:30:"versions/1.7.2/languages/it.js";s:4:"c325";s:30:"versions/1.7.2/languages/ja.js";s:4:"33c9";s:30:"versions/1.7.2/languages/ko.js";s:4:"6a15";s:30:"versions/1.7.2/languages/lt.js";s:4:"90a5";s:30:"versions/1.7.2/languages/lv.js";s:4:"9b63";s:30:"versions/1.7.2/languages/ms.js";s:4:"5b84";s:30:"versions/1.7.2/languages/nl.js";s:4:"0421";s:30:"versions/1.7.2/languages/no.js";s:4:"706d";s:30:"versions/1.7.2/languages/pl.js";s:4:"9335";s:33:"versions/1.7.2/languages/pt-BR.js";s:4:"8322";s:30:"versions/1.7.2/languages/ro.js";s:4:"91af";s:30:"versions/1.7.2/languages/ru.js";s:4:"6876";s:30:"versions/1.7.2/languages/sk.js";s:4:"9a73";s:30:"versions/1.7.2/languages/sl.js";s:4:"9c95";s:30:"versions/1.7.2/languages/sq.js";s:4:"c01f";s:33:"versions/1.7.2/languages/sr-SR.js";s:4:"b933";s:30:"versions/1.7.2/languages/sr.js";s:4:"acdd";s:30:"versions/1.7.2/languages/sv.js";s:4:"e1d7";s:30:"versions/1.7.2/languages/th.js";s:4:"4941";s:30:"versions/1.7.2/languages/tr.js";s:4:"f80d";s:30:"versions/1.7.2/languages/uk.js";s:4:"6f97";s:33:"versions/1.7.2/languages/zh-CN.js";s:4:"6529";s:33:"versions/1.7.2/languages/zh-TW.js";s:4:"7122";s:35:"res/class.tx_ptjqueryui_manager.php";s:4:"3cf4";}',
	'suggests' => array(
	),
);

?>