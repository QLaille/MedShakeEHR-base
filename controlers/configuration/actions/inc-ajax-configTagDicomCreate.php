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
 * Config > ajax : associer un tag Dicom à un typeName
 *
 * @author Bertrand Boutillier <b.boutillier@gmail.com>
 */

if (!msUser::checkUserIsAdmin()) {die("Erreur: vous n'êtes pas administrateur");}

//check & validate datas
$gump=new GUMP();
unset($_POST['groupe']);
$_POST = $gump->sanitize($_POST);

if (isset($_POST['id'])) {
    $gump->validation_rules(array(
            'id'=> 'required|numeric',
            'dicomTag'=> 'required',
            'typeName'=> 'required',
            'returnValue' => 'required',
            'roundDecimal' => 'required|numeric'
        ));
} else {
    $gump->validation_rules(array(
            'dicomTag'=> 'required',
            'typeName'=> 'required',
            'returnValue' => 'required',
            'roundDecimal' => 'required|numeric'
        ));
}

$validated_data = $gump->run($_POST);

if ($validated_data === false) {
    $return['status']='failed';
    $return['msg']=$gump->get_errors_array();
} else {
    if (msSQL::sqlInsert('dicomTags', $validated_data) > 0) {
        $return['status']='ok';
    } else {
        $return['status']='failed';
        $return['msg']=mysqli_error($mysqli);
    }
}
echo json_encode($return);
