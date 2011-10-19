<?php

/**
 *
 * ZPanel - A Cross-Platform Open-Source Web Hosting Control panel.
 * 
 * @package ZPanel
 * @version $Id$
 * @author Bobby Allen - ballen@zpanelcp.com
 * @copyright (c) 2008-2011 ZPanel Group - http://www.zpanelcp.com/
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public License v3
 *
 * This program (ZPanel) is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
 
class module_controller {

	static $hasupdated;

	static function getModules (){
	global $zdbh;
	$line = "";
		$sql = "SELECT COUNT(*) FROM x_module_admin";
		if ($numrows = $zdbh->query($sql)) {
 			if ($numrows->fetchColumn() <> 0) {	
				$sql = $zdbh->prepare("SELECT * FROM x_module_admin");
	 			$sql->execute();
				
				while ($row = $sql->fetch()) {
					$line .= "<tr><td><a href=\"/etc/modules/".$row['ma_folder_vc']."/module.zpm\">".$row['ma_name_vc']."</a></td></tr>";	
				}
			}
		}	
	return $line;
	}
	
	
	static function getResult() {
        if (!fs_director::CheckForEmptyValue(self::$hasupdated)){
            return ui_sysmessage::shout("Changes to the System options have been saved successfully!");
		}else{
			return ui_module::GetModuleDescription();
		}
        return;
    }
	
	
	static function getModuleName() {
		$module_name = ui_module::GetModuleName();
        return $module_name;
    }

	static function getModuleIcon() {
		global $controller;
		$module_icon = "/etc/modules/" . $controller->GetControllerRequest('URL', 'module') . "/assets/icon.png";
        return $module_icon;
    }
	
}

?>