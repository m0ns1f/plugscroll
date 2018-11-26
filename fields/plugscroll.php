<?php
/**
 * @package		LinkedIn Companupdates
 * @subpackage	mod_linkedin
 * @copyright	Copyright (C) 2018 M0ns1f. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @website		https://www.M0ns1f.com/joomla/extensions
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JFormFieldPlugScrollCall extends JFormField {


	function getInput() {
		$doc = JFactory::getDocument();
		$script = '
			(function($){
			$(document).ready(function() {
				$($($(".modules_to_exlude")[0].parentElement)[0].parentElement).addClass("exe_mod");
				$("input[name=select_exlucde_modules]").on("click",function(){
				var selected = $(this).val();
				var currentSelect = $(".hiddenModulesInput").val();
				if(currentSelect.indexOf("[" + selected + "]") == -1){
					var currentval = ($(".hiddenModulesInput").val()) ? $(".hiddenModulesInput").val() : "";
					$(".hiddenModulesInput").val( currentval + "[" + selected + "]" );
				}else {
					var currentval = $(".hiddenModulesInput").val();
					var realVal = currentval.replace("[" + selected + "]","");
					$(".hiddenModulesInput").val(realVal); 
				}
				console.log($(".hiddenModulesInput").val()	);
				});
			});
		})(jQuery);';
		$doc->addScriptDeclaration($script);
		$style = '
				.modules_to_exlude .check {
				    display: none
				}

				.modules_to_exlude .btn {
				    position: absolute;
				    right: 20px;
				    top: 11%;
				    background: #11223e;
				    display: inline-block;
				    height: 25px;
				    width: 70px;
				    border-radius: 50px;
				}

				.modules_to_exlude .btn::after {
				    content: "NO";
				    font-weight: bold;
				    color: red;
				    position: absolute;
				    height: 23px;
				    width: 23px;
				    text-align: center;
				    top: 25%;
				    left: 5%;
				    background: none;
				    font-size: 8px;
				    transition: left 500ms ease;
				}

				.modules_to_exlude .btn::before {
				    content: "";
				    position: absolute;
				    height: 23px;
				    width: 23px;
				    top: 13.5%;
				    left: 6%;
				    background: #ebebeb;
				    border-radius: 50%;
				    transition: left 500ms ease;
				}

				.modules_to_exlude .check:checked + .btn::before {
				    left: 70.5%;
				}
				.modules_to_exlude li {
					position: relative;
				    display: block;
				    height:45px;
				    width:100%;
				    float:left;
				    border-bottom:1px solid #11223e;
				}
				.modules_to_exlude .check:checked + .btn::after {
				    left: 70.5%;
				    content: "YES";
				    color: green;
				}
				.control-group.exe_mod .control-label {
				    width: 100%;
				    text-align: center;
				    padding: 10px 0;
				    margin: 20px 0;
				    text-align: center;
				}

				.control-group.exe_mod .controls {
				    width: 100%;
				    margin: 0;
				    float: left;
				}

				.modules_to_exlude li label {
				    float: left;
				    line-height: 45px;
				    margin: 0;
				}
				ul.modules_to_exlude {
				    margin: 0;
				    padding: 0;
				    width: 100%;
				    float: left;
					max-height: 30vh;
				    overflow-y: scroll;
				}

				.modules_to_exlude .check:checked + .btn {
				    background-color: #46a446;
				    transition: background-color 0.2s cubic-bezier(0.05, 0.4, 0.26, 0.76);
				}
				';
		$doc->addStyleDeclaration($style);
		$db = JFactory::getDBO();
		$query = 'SELECT *
		          FROM #__modules AS m
		          WHERE m.published = 1';
		$db->setQuery( $query );
		$items = $db->loadObjectList();
		$html = "<ul class='modules_to_exlude'>";
		foreach ( $items as $item ) {

			$html .= "<li>";
			$html .= '<label for="jform_params_plugscrollcall_' 
						. $item->id . 
							'">' . $item->title;
			$html .= '<input type="checkbox" class="check" id="jform_params_plugscrollcall_' 
						. $item->id . 
							'" name="select_exlucde_modules" value="' 
							. $item->id . 
								'" />';
			$html .= '<span class="btn"></span>';
			$html .= '</label>';
			$html .= '</li>';
		}	
		$html .= '</ul>';
		$html .= '<input type="hidden" name="jform[params][plugscrollcall]" class="hiddenModulesInput" id="jform[params][plugscrollcall]" />';	 
		return $html;
	}
}