<?php

if (!defined('TL_ROOT'))
	die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @see InterfaceGeneralData
 * @copyright  MEN AT WORK 2012
 * @package    generalDriver
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * This class is a holder for all const vars. 
 */
class DCGE
{
	// Language ------------------------------------------------------------

	/**
	 * Single language
	 */
	const LANGUAGE_SL = 1;

	/**
	 * Multi language
	 */
	const LANGUAGE_ML = 2;

	// DataProvider Modis --------------------------------------------------
	
	/**
	 * Use the default search mode
	 */
	const DP_MODE_DEFAULT = 0;
	
	/**
	 * Use a search like the mysql "like"
	 */
	const DP_MODE_LIKE = 1;
	
	/**
	 * Use a regex/pattern search
	 */
	const DP_MODE_REGEX = 2;


	// Modes ---------------------------------------------------------------
	
	const MODE_NON_SORTING = 0;
	const MODE_FIXED_FIELD = 1;
	const MODE_VARIABLE_FIELD = 2;
	const MODE_PARENT_VIEW = 3;
	// SH: CS: mode 4 missing, no idear for a good name :(
	const MODE_SIMPLE_TREEVIEW = 5;
	const MODE_PARENT_TREEVIEW = 6;

	// Meta Tags -----------------------------------------------------------

	/**
	 * Title of an item in a tree view.
	 */
	const TREE_VIEW_TITLE = 'dc_gen_tv_title';

	/**
	 * The current level in a tree view.
	 */
	const TREE_VIEW_LEVEL = 'dc_gen_tv_level';

	/**
	 * Is the tree item open.
	 */
	const TREE_VIEW_IS_OPEN = 'dc_gen_tv_open';

	/**
	 * Child Collection
	 */
	const TREE_VIEW_CHILD_COLLECTION = 'dc_gen_children_collection';

	/**
	 * State if we have childs
	 */
	const TREE_VIEW_HAS_CHILDS = 'dc_gen_tv_children';
	
	const MODEL_BUTTONS = '%buttons%';
	const MODEL_LABEL_ARGS = '%args%';
	const MODEL_LABEL_VALUE = '%content%';
	const MODEL_GROUP_HEADER = '%header%';
	const MODEL_GROUP_VALUE = '%group%';
	const MODEL_CLASS = '%class%';

	//todo: merge with MODEL_CLASS?
	const MODEL_EVEN_ODD_CLASS = '%rowClass%';

	/**
	 * parents id value.
	 */
	const MODEL_PID = 'pid';

	/**
	 * parents provider name.
	 */
	const MODEL_PTABLE = 'ptable';

}