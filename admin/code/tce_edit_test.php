<?php
//============================================================+
// File name   : tce_edit_test.php
// Begin       : 2004-04-27
// Last Update : 2009-03-24
//  
// Description : Edit Tests
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com S.r.l.
//               Via della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//
// License: 
//    Copyright (C) 2004-2009  Nicola Asuni - Tecnick.com S.r.l.
//    
//    This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//    
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//    
//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.
//     
//    Additionally, you can't remove the original TCExam logo, copyrights statements
//    and links to Tecnick.com and TCExam websites.
//    
//    See LICENSE.TXT file for more information.
//============================================================+

/**
 * Edit test.
 * @package com.tecnick.tcexam.admin
 * @author Nicola Asuni
 * @copyright Copyright &copy; 2004-2009, Nicola Asuni - Tecnick.com S.r.l. - ITALY - www.tecnick.com - info@tecnick.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link www.tecnick.com
 * @since 2004-04-27
 */

/**
 */

require_once('../config/tce_config.php');

$pagelevel = K_AUTH_ADMIN_TESTS;
require_once('../../shared/code/tce_authorization.php');

$thispage_title = $l['t_tests_editor'];
$enable_calendar = true;
require_once('../code/tce_page_header.php');
require_once('../../shared/code/tce_functions_form.php');
require_once('../../shared/code/tce_functions_tcecode.php');
require_once('../code/tce_functions_tcecode_editor.php');
require_once('../code/tce_functions_auth_sql.php');

// set default values
if(!isset($test_results_to_users) OR (empty($test_results_to_users))) {
	$test_results_to_users = 0;
} else {
	$test_results_to_users = intval($test_results_to_users);
}
if(!isset($test_report_to_users) OR (empty($test_report_to_users))) {
	$test_report_to_users = 0;
} else {
	$test_report_to_users = intval($test_report_to_users);
}
if(!isset($subject_id) OR (empty($subject_id))) {
	$subject_id = Array();
}
if(!isset($tsubset_type) OR (empty($tsubset_type))) {
	$tsubset_type = 1;
} else {
	$tsubset_type = intval($tsubset_type);
}
if(!isset($tsubset_difficulty) OR (empty($tsubset_difficulty))) {
	$tsubset_difficulty = 1;
} else {
	$tsubset_difficulty = intval($tsubset_difficulty);
}
if(!isset($tsubset_quantity) OR (empty($tsubset_quantity))) {
	$tsubset_quantity = 1;
} else {
	$tsubset_quantity = intval($tsubset_quantity);
}
if(!isset($tsubset_answers) OR (empty($tsubset_answers))) {
	$tsubset_answers = 3;
} else {
	$tsubset_answers = intval($tsubset_answers);
}
if (isset($tsubset_id)) {
	$tsubset_id = intval($tsubset_id);
}

if (isset($test_duration_time)) {
	$test_duration_time = intval($test_duration_time);
}
if (isset($group_id)) {
	$group_id = intval($group_id);
}
if(!isset($test_score_right) OR (empty($test_score_right))) {
	$test_score_right = 0;
} else {
	$test_score_right = floatval($test_score_right);
}
if(!isset($test_score_wrong) OR (empty($test_score_wrong))) {
	$test_score_wrong = 0;
} else {
	$test_score_wrong = floatval($test_score_wrong);
}
if(!isset($test_score_unanswered) OR (empty($test_score_unanswered))) {
	$test_score_unanswered = 0;
} else {
	$test_score_unanswered = floatval($test_score_unanswered);
}
if(!isset($test_score_threshold) OR (empty($test_score_threshold))) {
	$test_score_threshold = 0;
} else {
	$test_score_threshold = floatval($test_score_threshold);
}
if(!isset($test_random_questions_select) OR (empty($test_random_questions_select))) {
	$test_random_questions_select = 0;
} else {
	$test_random_questions_select = intval($test_random_questions_select);
}
if(!isset($test_random_questions_order) OR (empty($test_random_questions_order))) {
	$test_random_questions_order = 0;
} else {
	$test_random_questions_order = intval($test_random_questions_order);
}
if(!isset($test_random_answers_select) OR (empty($test_random_answers_select))) {
	$test_random_answers_select = 0;
} else {
	$test_random_answers_select = intval($test_random_answers_select);
}
if(!isset($test_random_answers_order) OR (empty($test_random_answers_order))) {
	$test_random_answers_order = 0;
} else {
	$test_random_answers_order = intval($test_random_answers_order);
}
if(!isset($test_comment_enabled) OR (empty($test_comment_enabled))) {
	$test_comment_enabled = 0;
} else {
	$test_comment_enabled = intval($test_comment_enabled);
}
if(!isset($test_menu_enabled) OR (empty($test_menu_enabled))) {
	$test_menu_enabled = 0;
} else {
	$test_menu_enabled = intval($test_menu_enabled);
}
if(!isset($test_noanswer_enabled) OR (empty($test_noanswer_enabled))) {
	$test_noanswer_enabled = 0;
} else {
	$test_noanswer_enabled = intval($test_noanswer_enabled);
}
if(!isset($test_mcma_radio) OR (empty($test_mcma_radio))) {
	$test_mcma_radio = 0;
} else {
	$test_mcma_radio = intval($test_mcma_radio);
}
if(!isset($test_repeatable) OR (empty($test_repeatable))) {
	$test_repeatable = 0;
} else {
	$test_repeatable = intval($test_repeatable);
}
if(!isset($test_max_score)) {
	$test_max_score = 0;
}

$test_max_score_new = 0; // test max score
$qtype = array('S', 'M', 'T', 'O'); // question types

$test_fieldset_name = '';

if (isset($_REQUEST['test_id']) AND ($_REQUEST['test_id'] > 0)) {
	$test_id = intval($_REQUEST['test_id']);
	// check user's authorization
	if (!F_isAuthorizedUser(K_TABLE_TESTS, 'test_id', $test_id, 'test_user_id')) {
		F_print_error('ERROR', $l['m_authorization_denied']);
		exit;
	}
}

switch($menu_mode) {

	case 'deletesubject':{ // delete subject
		// check referential integrity (NOTE: mysql do not support "ON UPDATE" constraint)
		if(!F_check_unique(K_TABLE_TEST_USER, 'testuser_test_id='.$test_id.'')) {
			F_print_error('WARNING', $l['m_update_restrict']);
			F_stripslashes_formfields();
			break;
		}
		$sql = 'DELETE FROM '.K_TABLE_TEST_SUBJSET.' WHERE tsubset_id='.$tsubset_id.'';
		if(!$r = F_db_query($sql, $db)) {
			F_display_db_error(false);
		} else {
			F_print_error('MESSAGE', $l['m_deleted']);
		}
		break;
	}

	case 'addquestion':{ // Add question type
		// check referential integrity (NOTE: mysql do not support "ON UPDATE" constraint)
		if(!F_check_unique(K_TABLE_TEST_USER, 'testuser_test_id='.$test_id.'')) {
			F_print_error('WARNING', $l['m_update_restrict']);
			$formstatus = FALSE; 
			F_stripslashes_formfields();
			break;
		}
		if($formstatus = F_check_form_fields()) {
			if ((isset($subject_id)) AND (!empty($subject_id)) AND (isset($tsubset_quantity)) AND (isset($tsubset_answers))) {
				
				if ($tsubset_type == 3) {
					// free-text questions do not have alternative answers to display
					$tsubset_answers = 0;
				} elseif (($tsubset_answers < 2) AND ($tsubset_difficulty > 0)) {
					// questions must have at least 2 alternative answers
					$tsubset_answers = 2;
				}
				// create a comma separated list of subjects IDs
				$subjids = '';
				foreach ($subject_id as $subid) {
					if ($subid{0} == '#') {
						// module ID
						$modid = intval(substr($subid, 1));
						$sqlsm = F_select_subjects_sql('subject_module_id='.$modid.'');
						if($rsm = F_db_query($sqlsm, $db)) {
							while($msm = F_db_fetch_array($rsm)) {
								$subjids .= $msm['subject_id'].',';
							}
						} else {
							F_display_db_error();
						}
					} else {
						$subjids .= intval($subid).',';
					}
				}
				$subjids = substr($subjids, 0, -1);
				$subject_id = explode(',', $subjids);
				$subjids = '('.$subjids.')';
				
				// check here if the selected number of questions are available for the current set
				// NOTE: if the same subject is used in multiple sets this control may fail.
				$sqlq = 'SELECT COUNT(*) AS numquestions
					FROM '.K_TABLE_QUESTIONS.'';
				$sqlq .= ' WHERE question_subject_id IN '.$subjids.' 
						AND question_type='.$tsubset_type.' 
						AND question_difficulty='.$tsubset_difficulty.' 
						AND question_enabled=\'1\'';
				if ($tsubset_type == 1) {
					// single question (MCSA)
					// check if the selected question has enough answers
					$sqlq .= '  
						AND question_id IN (
							SELECT answer_question_id
							FROM '.K_TABLE_ANSWERS.'
							WHERE answer_enabled=\'1\' 
								AND answer_isright=\'1\'';
					if (F_getBoolean($test_random_answers_order)) {
						$sqlq .= ' AND answer_position>0';
					}
					$sqlq .= ' GROUP BY answer_question_id
							HAVING (COUNT(answer_id)>0)
						)';
					$sqlq .= '  
						AND question_id IN (
							SELECT answer_question_id
							FROM '.K_TABLE_ANSWERS.'
							WHERE answer_enabled=\'1\' 
								AND answer_isright=\'0\'';
					if (F_getBoolean($test_random_answers_order)) {
						$sqlq .= ' AND answer_position>0';
					}
					$sqlq .= ' GROUP BY answer_question_id
							HAVING (COUNT(answer_id)>='.($tsubset_answers-1).')
						)';
				} elseif ($tsubset_type == 2) {
					// multiple question (MCMA)
					// check if the selected question has enough answers
					$sqlq .= '  
						AND question_id IN (
							SELECT answer_question_id
							FROM '.K_TABLE_ANSWERS.'
							WHERE answer_enabled=\'1\'';
					if (F_getBoolean($test_random_answers_order)) {
						$sqlq .= ' AND answer_position>0';
					}
					$sqlq .= ' GROUP BY answer_question_id
							HAVING (COUNT(answer_id)>='.$tsubset_answers.')
						)';
				} elseif ($tsubset_type == 4) {
					// ordering question
					// check if the selected question has enough answers
					$sqlq .= '  
						AND question_id IN (
							SELECT answer_question_id
							FROM '.K_TABLE_ANSWERS.'
							WHERE answer_enabled=\'1\'
							AND answer_position>0
							GROUP BY answer_question_id
							HAVING (COUNT(answer_id)>1)
					)';
				}
				if (F_getBoolean($test_random_questions_order)) {
					$sqlq .= ' AND question_position>0';
				}
				$sqlq .= ' LIMIT '.$tsubset_quantity.'';
				
				$numofrows = 0;
				if($rq = F_db_query($sqlq, $db)) {
					if($mq = F_db_fetch_array($rq)) {
						$numofrows = $mq['numquestions'];
					} 
				} else {
					F_display_db_error();
				}
				if ($numofrows < $tsubset_quantity) {
					F_print_error('WARNING', $l['m_unavailable_questions']);
					break;
				}
				
				if (!empty($subject_id)) {
					// insert new subject
					$sql = 'INSERT INTO '.K_TABLE_TEST_SUBJSET.' ( 
						tsubset_test_id,
						tsubset_type,
						tsubset_difficulty,
						tsubset_quantity,
						tsubset_answers
						) VALUES (
						\''.$test_id.'\',
						\''.$tsubset_type.'\',
						\''.$tsubset_difficulty.'\',
						\''.$tsubset_quantity.'\',
						\''.$tsubset_answers.'\'
						)';
					if(!$r = F_db_query($sql, $db)) {
						F_display_db_error(false);
					} else {
						$tsubset_id = F_db_insert_id($db, K_TABLE_TEST_SUBJSET, 'tsubset_id');
						// add selected subject_id
						foreach ($subject_id as $subid) {
							$sql = 'INSERT INTO '.K_TABLE_SUBJECT_SET.' (
								subjset_tsubset_id,
								subjset_subject_id
								) VALUES (
								\''.$tsubset_id.'\', 
								\''.$subid.'\'
								)';
							if(!$r = F_db_query($sql, $db)) {
								F_display_db_error(false);
							}
						}
					}
				}
			}
		}
		break;
	}

	case 'delete':{
		F_stripslashes_formfields(); 
		// ask confirmation
		F_print_error('WARNING', $l['m_delete_confirm_test']);
		?>
		<div class="confirmbox">
		<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data" id="form_delete">
		<div>
		
		<input type="hidden" name="test_id" id="test_id" value="<?php echo $test_id; ?>" />
		<input type="hidden" name="test_name" id="test_name" value="<?php echo $test_name; ?>" />
		<?php 
		F_submit_button('forcedelete', $l['w_delete'], $l['h_delete']);
		F_submit_button('cancel', $l['w_cancel'], $l['h_cancel']);
		?>
		</div>
		</form>
		</div>
		<?php
		break;
	}

	case 'forcedelete':{
		F_stripslashes_formfields(); // Delete
		if($forcedelete == $l['w_delete']) { //check if delete button has been pushed (redundant check)
			// delete test
			$sql = 'DELETE FROM '.K_TABLE_TESTS.' WHERE test_id='.$test_id.'';
			if(!$r = F_db_query($sql, $db)) {
				F_display_db_error(false);
			} else {
				$test_id = false;
				F_print_error('MESSAGE', $test_name.': '.$l['m_deleted']);
			}
		}
		break;
	}

	case 'update':{ // Update
		if($formstatus = F_check_form_fields()) {
			// check referential integrity (NOTE: mysql do not support "ON UPDATE" constraint)
			if(!F_check_unique(K_TABLE_TEST_USER, 'testuser_test_id='.$test_id.'')) {
				F_print_error('WARNING', $l['m_update_restrict']);
				$formstatus = FALSE; 
				F_stripslashes_formfields();
				break;
			}
			// check if name is unique
			if(!F_check_unique(K_TABLE_TESTS, 'test_name=\''.$test_name.'\'', 'test_id', $test_id)) {
				F_print_error('WARNING', $l['m_duplicate_name']);
				$formstatus = FALSE; 
				F_stripslashes_formfields();
				break;
			}
			
			if ($test_score_threshold > $test_max_score) {
				$test_score_threshold = 0.6 * $test_max_score;
			}
			$sql = 'UPDATE '.K_TABLE_TESTS.' SET 
				test_name=\''.F_escape_sql($test_name).'\',
				test_description=\''.F_escape_sql($test_description).'\',
				test_begin_time='.F_empty_to_null(F_escape_sql($test_begin_time)).',
				test_end_time='.F_empty_to_null(F_escape_sql($test_end_time)).',
				test_duration_time=\''.$test_duration_time.'\',
				test_ip_range=\''.F_escape_sql($test_ip_range).'\',
				test_results_to_users=\''.$test_results_to_users.'\',
				test_report_to_users=\''.$test_report_to_users.'\',
				test_score_right=\''.$test_score_right.'\', 
				test_score_wrong=\''.$test_score_wrong.'\', 
				test_score_unanswered=\''.$test_score_unanswered.'\',
				test_max_score=\''.$test_max_score.'\',
				test_score_threshold=\''.$test_score_threshold.'\',
				test_random_questions_select=\''.$test_random_questions_select.'\',
				test_random_questions_order=\''.$test_random_questions_order.'\',
				test_random_answers_select=\''.$test_random_answers_select.'\',
				test_random_answers_order=\''.$test_random_answers_order.'\',
				test_comment_enabled=\''.$test_comment_enabled.'\',
				test_menu_enabled=\''.$test_menu_enabled.'\',
				test_noanswer_enabled=\''.$test_noanswer_enabled.'\',
				test_mcma_radio=\''.$test_mcma_radio.'\',
				test_repeatable=\''.$test_repeatable.'\'
				WHERE test_id='.$test_id.'';
			if(!$r = F_db_query($sql, $db)) {
				F_display_db_error(false);
			} else {
				F_print_error('MESSAGE', $l['m_updated']);
			}
			
			// delete previous groups
			$sql = 'DELETE FROM '.K_TABLE_TEST_GROUPS.' 
				WHERE tstgrp_test_id='.$test_id.'';
			if(!$r = F_db_query($sql, $db)) {
				F_display_db_error(false);
			}
			// update authorized groups
			if (!empty($user_groups)) {
				foreach ($user_groups as $group_id) {
					$sql = 'INSERT INTO '.K_TABLE_TEST_GROUPS.' (
						tstgrp_test_id,
						tstgrp_group_id
						) VALUES (
						\''.$test_id.'\', 
						\''.$group_id.'\'
						)';
					if(!$r = F_db_query($sql, $db)) {
						F_display_db_error(false);
					}
				}
			}
		}
		break;
	}

	case 'add':{ // Add
		if($formstatus = F_check_form_fields()) {
			// check if name is unique
			if(!F_check_unique(K_TABLE_TESTS, 'test_name=\''.F_escape_sql($test_name).'\'')) {
				F_print_error('WARNING', $l['m_duplicate_name']);
				$formstatus = FALSE; 
				F_stripslashes_formfields();
				break;
			}
			if (isset($test_id) AND ($test_id > 0)) {
				// save previous test_id.
				$old_test_id = $test_id;
			}
			$sql = 'INSERT INTO '.K_TABLE_TESTS.' ( 
				test_name,
				test_description,
				test_begin_time,
				test_end_time,
				test_duration_time,
				test_ip_range,
				test_results_to_users,
				test_report_to_users,
				test_score_right, 
				test_score_wrong,
				test_score_unanswered,
				test_max_score,
				test_user_id,
				test_score_threshold,
				test_random_questions_select,
				test_random_questions_order,
				test_random_answers_select,
				test_random_answers_order,
				test_comment_enabled,
				test_menu_enabled,
				test_noanswer_enabled,
				test_mcma_radio,
				test_repeatable
				) VALUES (
				\''.F_escape_sql($test_name).'\',
				\''.F_escape_sql($test_description).'\',
				'.F_empty_to_null(F_escape_sql($test_begin_time)).',
				'.F_empty_to_null(F_escape_sql($test_end_time)).',
				\''.$test_duration_time.'\',
				\''.F_escape_sql($test_ip_range).'\',
				\''.$test_results_to_users.'\',
				\''.$test_report_to_users.'\',
				\''.$test_score_right.'\',
				\''.$test_score_wrong.'\',
				\''.$test_score_unanswered.'\',
				\''.$test_max_score.'\',
				\''.intval($_SESSION['session_user_id']).'\',
				\''.$test_score_threshold.'\',
				\''.$test_random_questions_select.'\',
				\''.$test_random_questions_order.'\',
				\''.$test_random_answers_select.'\',
				\''.$test_random_answers_order.'\',
				\''.$test_comment_enabled.'\',
				\''.$test_menu_enabled.'\',
				\''.$test_noanswer_enabled.'\',
				\''.$test_mcma_radio.'\',
				\''.$test_repeatable.'\'
				)';
			if(!$r = F_db_query($sql, $db)) {
				F_display_db_error(false);
			} else {
				$test_id = F_db_insert_id($db, K_TABLE_TESTS, 'test_id');
			}
			// add authorized user's groups
			if (!empty($user_groups)) {
				foreach ($user_groups as $group_id) {
					$sql = 'INSERT INTO '.K_TABLE_TEST_GROUPS.' (
						tstgrp_test_id,
						tstgrp_group_id
						) VALUES (
						\''.$test_id.'\', 
						\''.$group_id.'\'
						)';
					if(!$r = F_db_query($sql, $db)) {
						F_display_db_error(false);
					}
				}
			}
			
			if (isset($old_test_id) AND ($old_test_id > 0)) {
				// copy here previous selected questions to this new test
				$sql = 'SELECT * 
					FROM '.K_TABLE_TEST_SUBJSET.'
					WHERE tsubset_test_id=\''.$old_test_id.'\'';
				if($r = F_db_query($sql, $db)) {
					while($m = F_db_fetch_array($r)) {
						// insert new subject
						$sqlu = 'INSERT INTO '.K_TABLE_TEST_SUBJSET.' ( 
							tsubset_test_id,
							tsubset_type,
							tsubset_difficulty,
							tsubset_quantity,
							tsubset_answers
							) VALUES (
							\''.$test_id.'\',
							\''.$m['tsubset_type'].'\',
							\''.$m['tsubset_difficulty'].'\',
							\''.$m['tsubset_quantity'].'\',
							\''.$m['tsubset_answers'].'\'
							)';
						if(!$ru = F_db_query($sqlu, $db)) {
							F_display_db_error();
						} else {
							$tsubset_id = F_db_insert_id($db, K_TABLE_TEST_SUBJSET, 'tsubset_id');
							$sqls = 'SELECT *
								FROM '.K_TABLE_SUBJECT_SET.'
								WHERE subjset_tsubset_id=\''.$m['tsubset_id'].'\'';
							if($rs = F_db_query($sqls, $db)) {
								while($ms = F_db_fetch_array($rs)) {
									$sqlp = 'INSERT INTO '.K_TABLE_SUBJECT_SET.' (
										subjset_tsubset_id,
										subjset_subject_id
										) VALUES (
										\''.$tsubset_id.'\', 
										\''.$ms['subjset_subject_id'].'\'
										)';
									if(!$rp = F_db_query($sqlp, $db)) {
										F_display_db_error();
									}
								}
							} else {
								F_display_db_error();
							}
						}
					}
				} else {
					F_display_db_error();
				}
			}
		}
		break;
	}

	case 'clear':{ // Clear form fields
		$test_name = '';
		$test_description = '';
		$test_begin_time = date(K_TIMESTAMP_FORMAT);
		$test_end_time = date(K_TIMESTAMP_FORMAT, time() + K_SECONDS_IN_DAY);
		$test_duration_time = 60;
		$test_ip_range = '*.*.*.*';
		$test_results_to_users = false;
		$test_report_to_users = false;
		$test_score_right = 1;
		$test_score_wrong = 0;
		$test_score_unanswered = 0;
		$test_score_threshold = 0;
		$test_random_questions_select = true;
		$test_random_questions_order = true;
		$test_random_answers_select = true;
		$test_random_answers_order = true;
		$test_comment_enabled = true;
		$test_menu_enabled = true;
		$test_noanswer_enabled = true;
		$test_mcma_radio = true;
		$test_repeatable = false;
		break;
	}

	default :{ 
		break;
	}

} //end of switch

// --- Initialize variables

if (!isset($test_num) OR (!empty($test_num))) {
	$test_num = 1; // default number of PDF tests to generate
}

if($formstatus) {
	if ($menu_mode != 'clear') {
		if(!isset($test_id) OR empty($test_id)) {
			$sql = F_select_tests_sql().' LIMIT 1';
		} else {
			$sql = 'SELECT * 
				FROM '.K_TABLE_TESTS.' 
				WHERE test_id='.$test_id.' 
				LIMIT 1';
		}
		if($r = F_db_query($sql, $db)) {
			if($m = F_db_fetch_array($r)) {
				$test_id = $m['test_id'];
				$test_name = $m['test_name'];
				$test_description = $m['test_description'];
				$test_begin_time = $m['test_begin_time'];
				$test_end_time = $m['test_end_time'];
				$test_duration_time = $m['test_duration_time'];
				$test_ip_range = $m['test_ip_range'];
				$test_results_to_users = F_getBoolean($m['test_results_to_users']);
				$test_report_to_users = F_getBoolean($m['test_report_to_users']);
				$test_score_right = $m['test_score_right'];
				$test_score_wrong = $m['test_score_wrong'];
				$test_score_unanswered = $m['test_score_unanswered'];
				$test_max_score = $m['test_max_score'];
				$test_score_threshold = $m['test_score_threshold'];
				$test_random_questions_select = F_getBoolean($m['test_random_questions_select']);
				$test_random_questions_order = F_getBoolean($m['test_random_questions_order']);
				$test_random_answers_select = F_getBoolean($m['test_random_answers_select']);
				$test_random_answers_order = F_getBoolean($m['test_random_answers_order']);
				$test_comment_enabled = F_getBoolean($m['test_comment_enabled']);
				$test_menu_enabled = F_getBoolean($m['test_menu_enabled']);
				$test_noanswer_enabled = F_getBoolean($m['test_noanswer_enabled']);
				$test_mcma_radio = F_getBoolean($m['test_mcma_radio']);
				$test_repeatable = F_getBoolean($m['test_repeatable']);
			} else {
				$test_name = '';
				$test_description = '';
				$test_begin_time = date(K_TIMESTAMP_FORMAT);
				$test_end_time = date(K_TIMESTAMP_FORMAT, time() + K_SECONDS_IN_DAY);
				$test_duration_time = 60;
				$test_ip_range = '*.*.*.*';
				$test_results_to_users = false;
				$test_report_to_users = false;
				$test_score_right = 1;
				$test_score_wrong = 0;
				$test_score_unanswered = 0;
				$test_max_score = 0;
				$test_score_threshold = 0;
				$test_random_questions_select = true;
				$test_random_questions_order = true;
				$test_random_answers_select = true;
				$test_random_answers_order = true;
				$test_comment_enabled = true;
				$test_menu_enabled = true;
				$test_noanswer_enabled = true;
				$test_mcma_radio = true;
				$test_repeatable = false;
			}
		} else {
			F_display_db_error();
		}
	}
}
?>

<div class="container">

<div class="tceformbox">
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data" id="form_testeditor">

<div class="row">
<span class="label">
<label for="test_id"><?php echo $l['w_test']; ?></label>
</span>
<span class="formw">
<select name="test_id" id="test_id" size="0" onchange="document.getElementById('form_testeditor').submit()" title="<?php echo $l['h_test']; ?>">
<?php
$sql = F_select_tests_sql();
if($r = F_db_query($sql, $db)) {
	$countitem = 1;
	while($m = F_db_fetch_array($r)) {
		echo '<option value="'.$m['test_id'].'"';
		if($m['test_id'] == $test_id) {
			echo ' selected="selected"';
			$test_fieldset_name = ''.substr($m['test_begin_time'], 0, 10).' '.htmlspecialchars($m['test_name'], ENT_NOQUOTES, $l['a_meta_charset']).'';
		}
		echo '>'.$countitem.'. '.substr($m['test_begin_time'], 0, 10).' '.htmlspecialchars($m['test_name'], ENT_NOQUOTES, $l['a_meta_charset']).'</option>'.K_NEWLINE;
		$countitem++;
	}
}
else {
	echo '</select></span></div>'.K_NEWLINE;
	F_display_db_error();
}
?>
</select>
</span>
<br /><br />
</div>

<noscript>
<div class="row">
<span class="label">&nbsp;</span>
<span class="formw">
<input type="submit" name="selectrecord" id="selectrecord" value="<?php echo $l['w_select']; ?>" />
</span>
</div>
</noscript>

<fieldset>
<legend><?php echo $l['w_test']; ?></legend>

<div class="row">
<span class="label">
<label for="test_name"><?php echo $l['w_name']; ?></label>
</span>
<span class="formw">
<input type="text" name="test_name" id="test_name" value="<?php echo htmlspecialchars($test_name, ENT_COMPAT, $l['a_meta_charset']); ?>" size="30" maxlength="255" title="<?php echo $l['h_test_name']; ?>" />
</span>
</div>

<div class="row">
<span class="label">
<label for="test_description"><?php echo $l['w_description']; ?></label>
</span>
<span class="formw">
<textarea cols="30" rows="5" name="test_description" id="test_description" title="<?php echo $l['h_test_description']; ?>"><?php echo htmlspecialchars($test_description, ENT_NOQUOTES, $l['a_meta_charset']); ?></textarea>
</span>
</div>

<div class="row">
<span class="label">
<label for="test_begin_time"><?php echo $l['w_time_begin'].' '.$l['w_datetime_format']; ?></label>
</span>
<span class="formw">
<input type="text" name="test_begin_time" id="test_begin_time" value="<?php echo $test_begin_time; ?>" size="20" maxlength="20" title="<?php echo $l['h_time_begin']; ?>" />
<button name="test_begin_time_trigger" id="test_begin_time_trigger" title="<?php echo $l['w_calendar']; ?>">...</button>
<input type="hidden" name="x_test_begin_time" id="x_test_begin_time" value="^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})$" />
<input type="hidden" name="xl_test_begin_time" id="xl_test_begin_time" value="<?php echo $l['w_time_begin']; ?>" />
</span>
</div>

<div class="row">
<span class="label">
<label for="test_end_time"><?php echo $l['w_time_end'].' '.$l['w_datetime_format']; ?></label>
</span>
<span class="formw">
<input type="text" name="test_end_time" id="test_end_time" value="<?php echo $test_end_time; ?>" size="20" maxlength="20" title="<?php echo $l['h_time_end']; ?>" />
<button name="test_end_time_trigger" id="test_end_time_trigger" title="<?php echo $l['w_calendar']; ?>">...</button>
<input type="hidden" name="x_test_end_time" id="x_test_end_time" value="^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})$" />
<input type="hidden" name="xl_test_end_time" id="xl_test_end_time" value="<?php echo $l['w_time_end']; ?>" />
</span>
</div>

<div class="row">
<span class="label">
<label for="test_duration_time"><?php echo $l['w_test_time']." [".$l['w_minutes']."]"; ?></label>
</span>
<span class="formw">
<input type="text" name="test_duration_time" id="test_duration_time" value="<?php echo $test_duration_time; ?>" size="10" maxlength="20" title="<?php echo $l['h_test_time']; ?>" />
<input type="hidden" name="x_test_duration_time" id="x_test_duration_time" value="^([0-9]*)$" />
<input type="hidden" name="xl_test_duration_time" id="xl_test_duration_time" value="<?php echo $l['w_test_time']; ?>" />
</span>
</div>

<div class="row">
<span class="label">
<label for="test_ip_range"><?php echo $l['w_ip_range']; ?></label>
</span>
<span class="formw">
<input type="text" name="test_ip_range" id="test_ip_range" value="<?php echo $test_ip_range; ?>" size="30" maxlength="255" title="<?php echo $l['h_ip_range']; ?>" />
<input type="hidden" name="x_test_ip_range" id="x_test_ip_range" value="^([0-9a-fA-F,\:\.\*-]*)$" />
<input type="hidden" name="xl_test_ip_range" id="xl_test_ip_range" value="<?php echo $l['w_ip_range']; ?>" />
</span>
</div>

<div class="row">
<span class="label">
<label for="user_groups"><?php echo $l['w_groups']; ?></label>
</span>
<span class="formw">
<select name="user_groups[]" id="user_groups" size="5" multiple="multiple">
<?php
$sql = 'SELECT *
	FROM '.K_TABLE_GROUPS.'
	ORDER BY group_name';
if($r = F_db_query($sql, $db)) {
	while($m = F_db_fetch_array($r)) {
		echo '<option value="'.$m['group_id'].'"';
		if (isset($test_id) AND ($test_id > 0) AND (F_count_rows(K_TABLE_TEST_GROUPS, 'WHERE tstgrp_test_id='.$test_id.' AND tstgrp_group_id='.$m['group_id'].'') > 0)) {
			echo ' selected="selected"';
		}
		echo '>'.htmlspecialchars($m['group_name'], ENT_NOQUOTES, $l['a_meta_charset']).'</option>'.K_NEWLINE;
	}
}
else {
	echo '</select></span></div>'.K_NEWLINE;
	F_display_db_error();
}
?>
</select>
</span>
</div>

<div class="row">
<span class="label">
<label for="test_score_right"><?php echo $l['w_score_right']; ?></label>
</span>
<span class="formw">
<input type="text" name="test_score_right" id="test_score_right" value="<?php echo $test_score_right; ?>" size="7" maxlength="20" title="<?php echo $l['h_score_right']; ?>" />
<input type="hidden" name="x_test_score_right" id="x_test_score_right" value="^([0-9\+\-]*)([\.]?)([0-9]*)$" />
<input type="hidden" name="xl_test_score_right" id="xl_test_score_right" value="<?php echo $l['w_score_right']; ?>" />
</span>
</div>

<div class="row">
<span class="label">
<label for="test_score_wrong"><?php echo $l['w_score_wrong']; ?></label>
</span>
<span class="formw">
<input type="text" name="test_score_wrong" id="test_score_wrong" value="<?php echo $test_score_wrong; ?>" size="7" maxlength="20" title="<?php echo $l['h_score_wrong']; ?>" />
<input type="hidden" name="x_test_score_wrong" id="x_test_score_wrong" value="^([0-9\+\-]*)([\.]?)([0-9]*)$" />
<input type="hidden" name="xl_test_score_wrong" id="xl_test_score_wrong" value="<?php echo $l['w_score_wrong']; ?>" />
</span>
</div>

<div class="row">
<span class="label">
<label for="test_score_unanswered"><?php echo $l['w_score_unanswered']; ?></label>
</span>
<span class="formw">
<input type="text" name="test_score_unanswered" id="test_score_unanswered" value="<?php echo $test_score_unanswered; ?>" size="7" maxlength="20" title="<?php echo $l['h_score_unanswered']; ?>" />
<input type="hidden" name="x_test_score_unanswered" id="x_test_score_unanswered" value="^([0-9\+\-]*)([\.]?)([0-9]*)$" />
<input type="hidden" name="xl_test_score_unanswered" id="xl_test_score_unanswered" value="<?php echo $l['w_score_unanswered']; ?>" />
</span>
</div>

<div class="row">
<span class="label">
<label for="test_score_threshold"><?php echo $l['w_test_score_threshold']; ?></label>
</span>
<span class="formw">
<input type="text" name="test_score_threshold" id="test_score_threshold" value="<?php echo $test_score_threshold; ?>" size="7" maxlength="20" title="<?php echo $l['h_test_score_threshold']; ?>" />
<input type="hidden" name="x_test_score_threshold" id="x_test_score_threshold" value="^([0-9\+\-]*)([\.]?)([0-9]*)$" />
<input type="hidden" name="xl_test_score_threshold" id="xl_test_score_threshold" value="<?php echo $l['w_test_score_threshold']; ?>" />
</span>
</div>

<div class="row">
<span class="label">
<label for="test_random_questions_select"><?php echo $l['w_random_questions']; ?>:</label>
</span>
<span class="formw">
<?php
echo '<input type="checkbox" name="test_random_questions_select" id="test_random_questions_select" value="1"';
if($test_random_questions_select) {echo ' checked="checked"';}
echo ' onclick="JF_check_random_boxes()"';
echo ' title="'.$l['h_random_questions'].'" />';
echo ' <label for="test_random_questions_select">'.$l['w_select'].'</label>'.K_NEWLINE;

echo ' <input type="checkbox" name="test_random_questions_order" id="test_random_questions_order" value="1"';
if($test_random_questions_order) {echo ' checked="checked"';}
echo ' onclick="JF_check_random_boxes()"';
echo ' title="'.$l['w_order'].'" />';
echo ' <label for="test_random_questions_order">'.$l['w_order'].'</label>'.K_NEWLINE;
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="test_random_answers_select"><?php echo $l['w_random_answers']; ?>:</label>
</span>
<span class="formw">
<?php
echo '<input type="checkbox" name="test_random_answers_select" id="test_random_answers_select" value="1"';
if($test_random_answers_select) {echo ' checked="checked"';}
echo ' onclick="JF_check_random_boxes()"';
echo ' title="'.$l['h_random_answers'].'" />';
echo ' <label for="test_random_answers_select">'.$l['w_select'].'</label>'.K_NEWLINE;

echo ' <input type="checkbox" name="test_random_answers_order" id="test_random_answers_order" value="1"';
if($test_random_answers_order) {echo ' checked="checked"';}
echo ' onclick="JF_check_random_boxes()"';
echo ' title="'.$l['w_order'].'" />';
echo ' <label for="test_random_answers_order">'.$l['w_order'].'</label>'.K_NEWLINE;
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="test_mcma_radio"><?php echo $l['w_mcma_radio']; ?></label>
</span>
<span class="formw">
<?php
echo '<input type="checkbox" name="test_mcma_radio" id="test_mcma_radio" value="1"';
if($test_mcma_radio) {echo ' checked="checked"';}
echo ' title="'.$l['h_mcma_radio'].'" />';
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="test_noanswer_enabled"><?php echo $l['w_enable_noanswer']; ?></label>
</span>
<span class="formw">
<?php
echo '<input type="checkbox" name="test_noanswer_enabled" id="test_noanswer_enabled" value="1"';
if($test_noanswer_enabled) {echo ' checked="checked"';}
echo ' title="'.$l['h_enable_noanswer'].'" />';
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="test_menu_enabled"><?php echo $l['w_enable_menu']; ?></label>
</span>
<span class="formw">
<?php
echo '<input type="checkbox" name="test_menu_enabled" id="test_menu_enabled" value="1"';
if($test_menu_enabled) {echo ' checked="checked"';}
echo ' title="'.$l['h_enable_menu'].'" />';
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="test_comment_enabled"><?php echo $l['w_enable_comment']; ?></label>
</span>
<span class="formw">
<?php
echo '<input type="checkbox" name="test_comment_enabled" id="test_comment_enabled" value="1"';
if($test_comment_enabled) {echo ' checked="checked"';}
echo ' title="'.$l['h_enable_comment'].'" />';
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="test_results_to_users"><?php echo $l['w_results_to_users']; ?></label>
</span>
<span class="formw">
<?php
echo '<input type="checkbox" name="test_results_to_users" id="test_results_to_users" value="1"';
if($test_results_to_users) {echo ' checked="checked"';}
echo ' title="'.$l['h_results_to_users'].'" />';
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="test_report_to_users"><?php echo $l['w_report_to_users']; ?></label>
</span>
<span class="formw">
<?php
echo '<input type="checkbox" name="test_report_to_users" id="test_report_to_users" value="1"';
if($test_report_to_users) {echo ' checked="checked"';}
echo ' title="'.$l['h_report_to_users'].'" />';
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="test_repeatable"><?php echo $l['w_repeatable']; ?></label>
</span>
<span class="formw">
<?php
echo '<input type="checkbox" name="test_repeatable" id="test_repeatable" value="1"';
if($test_repeatable) {echo ' checked="checked"';}
echo ' title="'.$l['h_repeatable_test'].'" />';
?>
</span>
</div>

<div class="row">
<br />
<?php
// show buttons by case
if (isset($test_id) AND ($test_id > 0)) {
	F_submit_button('update', $l['w_update'], $l['h_update']);
	F_submit_button('delete', $l['w_delete'], $l['h_delete']);
}
F_submit_button('add', $l['w_add'], $l['h_add']);
F_submit_button('clear', $l['w_clear'], $l['h_clear']);
?>
<!-- comma separated list of required fields -->
<input type="hidden" name="ff_required" id="ff_required" value="test_name,test_description,test_ip_range,test_duration_time,test_score_right" />
<input type="hidden" name="ff_required_labels" id="ff_required_labels" value="<?php echo htmlspecialchars($l['w_name'].",".$l['w_description'].",".$l['w_ip_range'].",".$l['w_test_time'].",".$l['w_score_right'], ENT_COMPAT, $l['a_meta_charset']); ?>" />

<br /><br />
</div>

</fieldset>

<?php
// display a list of selected subject_id (topics)
if (isset($test_id) AND ($test_id > 0)) {
?>

<div class="row"><br /></div>

<fieldset>
<legend><?php echo $l['w_questions'].''; ?></legend>

<div class="row">
<span class="label">
&nbsp;
</span>
<span class="formw">
<?php echo $test_fieldset_name; ?>
</span>
</div>

<div class="row">
<span class="label">
<label for="subject_id"><?php echo $l['w_subjects']; ?></label>
</span>
<span class="formw">
<select name="subject_id[]" id="subject_id" size="10" multiple="multiple" title="<?php echo $l['h_subjects']; ?>">
<?php
// select subject_id
$sql = F_select_module_subjects_sql('module_enabled=\'1\' AND subject_enabled=\'1\'');
if($r = F_db_query($sql, $db)) {
	$prev_module_id = 0;
	while($m = F_db_fetch_array($r)) {
		if ($m['module_id'] != $prev_module_id) {
			$prev_module_id = $m['module_id'];
			echo '<option value="#'.$m['module_id'].'" style="background-color:#DDEEFF;font-weight:bold">* '.htmlspecialchars($m['module_name'], ENT_NOQUOTES, $l['a_meta_charset']).'</option>'.K_NEWLINE;
		}
		echo '<option value="'.$m['subject_id'].'"';
		if(in_array($m['subject_id'],$subject_id)) {
			echo ' selected="selected"';
		}
		echo '>&nbsp;&nbsp;&nbsp;'.htmlspecialchars($m['subject_name'], ENT_NOQUOTES, $l['a_meta_charset']).'</option>'.K_NEWLINE;
		
	}
} else {
	echo '</select></span></div>'.K_NEWLINE;
	F_display_db_error();
}
?>
</select>
</span>
</div>

<div class="row">
<span class="label">
<label for="tsubset_quantity"><?php echo $l['w_num_questions']; ?></label>
</span>
<span class="formw">
<?php
echo '<input type="text" name="tsubset_quantity" id="tsubset_quantity" value="'.$tsubset_quantity.'" size="5" maxlength="20" title="'.$l['h_num_questions'].'" />'.K_NEWLINE;
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="tsubset_type"><?php echo $l['w_type']; ?></label>
</span>
<span class="formw">
<?php
echo '<select name="tsubset_type" id="tsubset_type" size="0" title="'.$l['h_question_type'].'">'.K_NEWLINE;
echo '<option value="1"';
if($tsubset_type == 1) {
	echo ' selected="selected"';
}
echo '>'.$l['w_single_answer'].'</option>'.K_NEWLINE;
echo '<option value="2"';
if($tsubset_type == 2) {
	echo ' selected="selected"';
}
echo '>'.$l['w_multiple_answers'].'</option>'.K_NEWLINE;
echo '<option value="3"';
if($tsubset_type == 3) {
	echo ' selected="selected"';
}
echo '>'.$l['w_free_answer'].'</option>'.K_NEWLINE;
echo '<option value="4"';
if($tsubset_type == 4) {
	echo ' selected="selected"';
}
echo '>'.$l['w_ordering_answer'].'</option>'.K_NEWLINE;
echo '</select>'.K_NEWLINE;
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="tsubset_type"><?php echo $l['w_question_difficulty']; ?></label>
</span>
<span class="formw">
<?php
echo '<select name="tsubset_difficulty" id="tsubset_difficulty" size="0" title="'.$l['h_question_difficulty'].'">'.K_NEWLINE;
for ($i = 1; $i <= K_QUESTION_DIFFICULTY_LEVELS; $i++) {
	echo '<option value="'.$i.'"';
	if($i == $tsubset_difficulty) {
		echo ' selected="selected"';
	}
	echo '>'.$i.'</option>'.K_NEWLINE;
}
echo '</select>'.K_NEWLINE;
?>
</span>
</div>

<div class="row">
<span class="label">
<label for="tsubset_answers"><?php echo $l['w_num_answers']; ?></label>
</span>
<span class="formw">
<?php
echo '<input type="text" name="tsubset_answers" id="tsubset_answers" value="'.$tsubset_answers.'" size="5" maxlength="20" title="'.$l['h_num_answers'].'" />'.K_NEWLINE;
?>
</span>
</div>


<div class="row">
<span class="label">
&nbsp;
</span>
<span class="formw">
<?php
F_submit_button("addquestion", $l['w_add_questions'], $l['h_add_questions']);
?>
</span>
</div>

<div class="rowl" title="<?php echo $l['h_subjects']; ?>">
<br />
<div class="preview">
<?php
$subjlist = '';
$sql = 'SELECT * 
	FROM '.K_TABLE_TEST_SUBJSET.'
	WHERE tsubset_test_id=\''.$test_id.'\'
	ORDER BY tsubset_id';
if($r = F_db_query($sql, $db)) {
	while($m = F_db_fetch_array($r)) {
		$subjlist .= '<li>';
		$subjects_list = '';
		$sqls = 'SELECT subject_id,subject_name
			FROM '.K_TABLE_SUBJECTS.', '.K_TABLE_SUBJECT_SET.'
			WHERE subject_id=subjset_subject_id
				AND subjset_tsubset_id=\''.$m['tsubset_id'].'\'
			ORDER BY subject_name';
		if($rs = F_db_query($sqls, $db)) {
			while($ms = F_db_fetch_array($rs)) {
				$subjects_list .= '<a href="tce_edit_subject.php?subject_id='.$ms['subject_id'].'" title="'.$l['t_subjects_editor'].'">'.htmlspecialchars($ms['subject_name'], ENT_NOQUOTES, $l['a_meta_charset']).'</a>, ';
			}
		} else {
			F_display_db_error();
		}
		// remove last comma + space
		$subjlist .= substr($subjects_list,0,-2);
		$subjlist .= '<br />'.K_NEWLINE;
		$subjlist .= '<acronym class="offbox" title="'.$l['h_num_questions'].'">'.$m['tsubset_quantity'].'</acronym> ';
		$subjlist .= '<acronym class="offbox" title="'.$l['h_question_type'].'">'.$qtype[($m['tsubset_type']-1)].'</acronym> ';
		$subjlist .= '<acronym class="offbox" title="'.$l['h_question_difficulty'].'">'.$m['tsubset_difficulty'].'</acronym> ';
		$subjlist .= '<acronym class="offbox" title="'.$l['h_num_answers'].'">'.$m['tsubset_answers'].'</acronym> ';
		$subjlist .= ' <a href="'.$_SERVER['SCRIPT_NAME'].'?menu_mode=deletesubject&amp;test_id='.$test_id.'&amp;tsubset_id='.$m['tsubset_id'].'" title="'.$l['h_delete'].'" class="deletebutton">'.$l['w_delete'].'</a>';
		$subjlist .= '</li>'.K_NEWLINE;
		
		// update test_max_score
		$test_max_score_new += $test_score_right * $m['tsubset_difficulty'] * $m['tsubset_quantity'];
		if (isset($test_max_score) AND ($test_max_score_new != $test_max_score)) {
			$test_max_score = $test_max_score_new;
			// update max score on test table
			$sqlup = 'UPDATE '.K_TABLE_TESTS.' SET 
				test_max_score='.$test_max_score.'
				WHERE test_id='.$test_id.'';
			if(!$rup = F_db_query($sqlup, $db)) {
				F_display_db_error(false);
			}
		}
	}
	if (strlen($subjlist) > 0) {
		echo '<ul>'.K_NEWLINE.$subjlist.'</ul>'.K_NEWLINE;
	}
} else {
	F_display_db_error();
}
?>
&nbsp;
<?php
echo $l['w_max_score'].': '.$test_max_score_new;
echo '<input type="hidden" name="test_max_score" id="test_max_score" value="'.$test_max_score_new.'" />';
?>
</div>
<br /><br />
</div>

</fieldset>

<div class="row"><br /></div>

<?php
	if (isset($test_max_score_new) and ($test_max_score_new > 0)) {
?>
<div class="row">
<span class="label">
<label for="test_num"><?php echo $l['w_pdf_offline_test']; ?></label>
</span>
<span class="formw">
<input type="text" name="test_num" id="test_num" value="<?php echo $test_num; ?>" size="4" maxlength="10" title="<?php echo $l['h_pdf_offline_test']; ?>" />
<?php
echo '<a href="tce_pdf_testgen.php?testid='.$test_id.'&amp;num='.$test_num.'" title="'.$l['h_pdf_offline_test'].'" class="xmlbutton" onclick="pdfWindow=window.open(\'tce_pdf_testgen.php?testid='.$test_id.'&amp;num=\' + document.getElementById(\'form_testeditor\').test_num.value + \'\',\'pdfWindow\',\'dependent,menubar=yes,resizable=yes,scrollbars=yes,status=yes,toolbar=yes\'); return false;">'.$l['w_generate'].'</a>';
?>
</span>
&nbsp;
</div>

<?php
	}
}
?>
</form>

</div>
<?php
echo '<div class="pagehelp">'.$l['hp_edit_test'].'</div>'.K_NEWLINE;
echo '</div>'.K_NEWLINE;

// calendar
echo '<script type="text/javascript">'.K_NEWLINE;
echo '//<![CDATA['.K_NEWLINE;
echo 'Calendar.setup({inputField: "test_begin_time", ifFormat: "%Y-%m-%d %H:%M:%S", showsTime: "true", button: "test_begin_time_trigger"});'.K_NEWLINE;
echo 'Calendar.setup({inputField: "test_end_time", ifFormat: "%Y-%m-%d %H:%M:%S", showsTime: "true", button: "test_end_time_trigger"});'.K_NEWLINE;
echo 'function JF_check_random_boxes() {'.K_NEWLINE;
echo ' if(document.getElementById(\'test_random_questions_select\').checked==true){document.getElementById(\'test_random_questions_order\').checked=true;}'.K_NEWLINE;
echo ' if((document.getElementById(\'test_random_questions_order\').checked==false)&&(document.getElementById(\'test_random_questions_select\').checked==true)){document.getElementById(\'test_random_questions_order\').checked=true;}'.K_NEWLINE;
echo ' if(document.getElementById(\'test_random_answers_select\').checked==true){document.getElementById(\'test_random_answers_order\').checked=true;}'.K_NEWLINE;
echo ' if((document.getElementById(\'test_random_answers_order\').checked==false)&&(document.getElementById(\'test_random_answers_select\').checked==true)){document.getElementById(\'test_random_answers_order\').checked=true;}'.K_NEWLINE;
echo '}'.K_NEWLINE;
echo '//]]>'.K_NEWLINE;
echo '</script>'.K_NEWLINE;

require_once('../code/tce_page_footer.php');

//============================================================+
// END OF FILE                                                 
//============================================================+
?>