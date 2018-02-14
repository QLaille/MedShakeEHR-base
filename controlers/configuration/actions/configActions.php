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
 * Config : les actions avec reload de page
 *
 * @author Bertrand Boutillier <b.boutillier@gmail.com>
 */


header('Content-Type: application/json');

$m=$match['params']['m'];

$acceptedModes=array(
    'configFormEdit', // Edition du formulaire
    'configUserCreate', //Créer un user
    'configCronJobs', //Configurer les crons
    'configDefaultUsersParams', //Enregistrer la config par défaut des utilisateurs
    'configSpecificUserParam', //Attribuer une config spécifique à un utilisateur
    'configApplyUpdates', // Appliquer les updates
    'configAgendaSave', // sauvegarder config agenda
    'configTemplatePDFSave' // sauvegarder un template PDF
);

if (!in_array($m, $acceptedModes)) {
    die;
}


// Edition du formulaire
if ($m=='configFormEdit') {
    include('inc-action-configFormEdit.php');
}
// Attribuer un password à un user
elseif ($m=='configUserCreate') {
    include('inc-action-configUserCreate.php');
}
// Configurer les crons
elseif ($m=='configCronJobs') {
    include('inc-action-configCronJobs.php');
}
// Enregistrer la config par défaut des utilisateurs
elseif ($m=='configDefaultUsersParams') {
    include('inc-action-configDefaultUsersParams.php');
}
// Attribuer une config spécifique à un utilisateur
elseif ($m=='configSpecificUserParam') {
    include('inc-action-configSpecificUserParam.php');
}
// appliquer les updates
elseif ($m=='configApplyUpdates') {
    include('inc-action-configApplyUpdates.php');
}
// sauvegarder config agenda
elseif ($m=='configAgendaSave') {
    include('inc-action-configAgendaSave.php');
}
// sauvegarder un template PDF
elseif ($m=='configTemplatePDFSave') {
    include('inc-action-configTemplatePDFSave.php');
}
