/**
 * Javascripts specific for this theme
 *
 *
 *
 * Please do not edit this file. This file is part of the CyberChimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

/**
 * Makes header clear the static menu bar
 */


(function ($) {

	var setHeight = function (h) {

		// 5px removes the top border of the first element that appears below the header
		height = h-5;

		$("#cc_spacer").css("height", height + "px");
		}

	$(window).resize(function(){
		setHeight($("#navigation_menu").height());
	})

	$(window).ready(function(){
		setHeight($("#navigation_menu").height());
	})
})(jQuery, window);