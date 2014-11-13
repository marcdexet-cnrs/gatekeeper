<?php
/**
 * ownCloud - 
 *
 * @author Marc DeXeT
 * @copyright 2014 DSI CNRS https://www.dsi.cnrs.fr
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\GateKeeper\Lib;

class DenyLoggerFactory {

	public function __construct($appConfig) {
		$this->useLogger = $appConfig->getValue('gatekeeper', 'deny.logger','owncloud') ;
	}

	public function getInstance() {
		$type = strtolower($this->useLogger);
		if ( $type === 'owncloud' )   {
			return new OwncloudDenyLogger();
		} else if ( $type === 'syslog') {
			return new SyslogDenyLogger();
		} else if ( $type === 'none') {
			return new MuteDenyLogger();
		} else {
			throw new \Exception("Error Processing Request in DenyLoggerFactory, type is not allowed {$type}", 1);
		}
	}

}