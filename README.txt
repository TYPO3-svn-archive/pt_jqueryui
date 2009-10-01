1. jQuery dependencies
-----------------------

- By default the complete `jQuery UI library' is included. If any single
  component is included, the `jQuery UI library' is discarded and the
  `jQuery UI core' is included instead.
- Any inserted component requires the `jQuery UI core' which is then
  included automatically.
- Any inserted effect requires the `Effects core' which is then included
  automatically.
- Languages are independent components. By default the complete language
  library `i18n' is included. If any single language is included, `i18n'
  is discarded.


2. Directory structure and file names
-------------------------------------

I decided to restructure the default jQuery UI directory tree in
favor of a better consistency and a uniform extension API to copy
with it.
Of course the disadvantage is a slight overhead in integrating new
versions, but it keeps you independent of any directory structure
rearrangements in future jQuery UI releases. 

The structure of the `versions' directory which contains the jQuery
source files differs from the original structure:

versions
  |
  +- 1.3.2
  |    +- languages
  |    +- modules 
  |         |
  |         +- effects
  |         +- widgets
  |         +- interactions
  |         +- core
  |
  +- themes
  
3. File names
-------------

All jQuery UI library names are cropped to their very base name, which
describes their functionality since the respective category is
represented in the directory structure.
 
4. TypoScript
--------------

plugin {
  tx_ptjqueryui {
    # By default the complete jQuery UI library is included.
    # If any single component is included the jQuery UI monolith is
    # discarded and the jQuery core is included automatically.
    version = 1.3.2
    variant = compressed
    position = head
    
    # Any inserted component requires the `jQuery UI core'
    # which is then included automatically.
    components {
      effects {
	# Any inserted effect requires the `Effects core'
	# which is then included automatically.
	1 = blind
	2 = bounce
	3 = clip
	4 = drop
	5 = explode
	6 = fold
	7 = highlight
	8 = pulsate
	9 = scale
	10 = shake
	11 = slide
	12 = transfer
      }
      interactions {
	1 = draggable
	2 = droppable
	3 = resizable
	4 = selectable
	5 = sortable
      }
      widgets {
	1 = accordion
	2 = datepicker
	3 = dialog
	4 = progressbar
	5 = slider
	6 = tabs
      }
    }
    
    # Languages are independent components
    languages {
      1 = ar.js
      2 = bg.js
      3 = ca.js
      4 = cs.js
      5 = da.js
      6 = de.js
      7 = el.js
      8 = eo.js
      9 = es.js
      10 = fa.js
      11 = fi.js
      12 = fr.js
      13 = he.js
      14 = hr.js
      15 = hu.js
      16 = hy.js
      17 = i18n.js
      18 = id.js
      19 = is.js
      20 = it.js
      21 = ja.js
      22 = ko.js
      23 = lt.js
      24 = lv.js
      25 = ms.js
      26 = nl.js
      27 = no.js
      28 = pl.js
      29 = pt-BR.js
      30 = ro.js
      31 = ru.js
      32 = sk.js
      33 = sl.js
      34 = sq.js
      35 = sr.js
      36 = sr-SR.js
      37 = sv.js
      38 = th.js
      39 = tr.js
      40 = uk.js
      41 = zh-CN.js
      42 = zh-TW.js
    }
  }
}
