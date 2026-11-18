<?php
/**
 * Copyright (C) 2014-2025 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
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
 * Attribution: This code is part of the All-in-One WP Migration plugin, developed by
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Kangaroos cannot jump here' );
}

/**
 * Get retention.json absolute path
 *
 * @param  array  $params Request parameters
 * @return string
 */
function ai1wmue_retention_path( $params ) {
	return ai1wm_storage_path( $params ) . DIRECTORY_SEPARATOR . AI1WMUE_RETENTION_NAME;
}

/**
 * Check whether export/import is running
 *
 * @return boolean
 */
function ai1wmue_is_running() {
	if ( isset( $_GET['file'] ) || isset( $_POST['file'] ) ) {
		return true;
	}

	return false;
}

/**
 * Check if the base plugin is installed
 *
 * @return boolean
 */
function ai1wmue_is_base_plugin_installed() {
	return file_exists( WP_PLUGIN_DIR . '/all-in-one-wp-migration/all-in-one-wp-migration.php' );
}

/**
 * Check if the base plugin is activated
 *
 * @return boolean
 */
function ai1wmue_is_base_plugin_active() {
	return is_plugin_active( 'all-in-one-wp-migration/all-in-one-wp-migration.php' );
}

/**
 * Install the base plugin
 *
 * @return boolean|WP_Error
 */
function ai1wmue_install_base_plugin() {
	return new WP_Error( "not_installed", __( "Please install and activate the All-in-One WP Migration (v7.111) base plugin first.", AI1WMUE_PLUGIN_NAME ) );
}
