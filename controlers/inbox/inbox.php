<?php
/*
 * This file is part of MedShakeEHR.
 *
 * Copyright (c) 2017
 * Bertrand Boutillier <b.boutillier@gmail.com>
 * http://www.medshake.net
 *
 * MedShakeEHR is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * MedShakeEHR is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MedShakeEHR.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Inbox : la page inbox
 *
 * @author Bertrand Boutillier <b.boutillier@gmail.com>
 */

$debug='';
$template="inbox";

if(!empty($p['config']['apicryptInboxMailForUserID'])) {
  $apicryptInboxMailForUserID=explode(',', $p['config']['apicryptInboxMailForUserID']);
  $apicryptInboxMailForUserID[]=$p['user']['id'];
  $apicryptInboxMailForUserID=implode("','", $apicryptInboxMailForUserID);
} else {
  $apicryptInboxMailForUserID=$p['user']['id'];
}

if ($mails=msSQL::sql2tab("select id, txtFileName, DATE_FORMAT(txtDatetime, '%d/%m/%y') as day, hprimIdentite, hprimExpediteur, pjNombre, archived
from inbox
where archived!='y' and mailForUserID in ('".$apicryptInboxMailForUserID."')
order by txtDatetime desc, txtNumOrdre desc")) {
    foreach ($mails as $mail) {
        $p['page']['inbox']['mails'][$mail['day']][]=$mail;
    }
}
