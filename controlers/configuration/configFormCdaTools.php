<?php
/*
 * This file is part of MedShakeEHR.
 *
 * Copyright (c) 2018
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
 * Config : outils pour la paramétrage CDA lié à un form
 *
 * @author Bertrand Boutillier <b.boutillier@gmail.com>
 */


 function treatDataType(&$t) {
   global $formc;
   if($t['formType'] == 'select') {
         $t['formValues']=Spyc::YAMLLoad($t['formValues']);
         $t['formValues']=array_filter($t['formValues']);
         $t['keyValues']=array_keys($t['formValues']);
       } elseif($t['formType'] == 'number') {
         $padat=$formc->getDataTypeFormParams($t['name']);
         if(isset($padat['min'],$padat['max'],$padat['step'])) {
           for($i=$padat['min'];$i<=$padat['max'];$i=$i+$padat['step']) {
             $tab[$i]=$i;
           }
           $t['formValues']=(array)$tab;
         }
         $t['formValues']=array_filter($t['formValues']);
         $t['keyValues']=array_keys($t['formValues']);
       }
   }

 //admin uniquement
 if (!msUser::checkUserIsAdmin()) {
     $template="forbidden";
 } else {
     $debug='';
     $template="configFormCdaTools";
     $p['page']['formID']=$match['params']['form'];
     if (!is_numeric($p['page']['formID'])) {
         die();
     }


    //sortie du formulaire et préparation
    if ($formData=msSQL::sqlUnique("select * from forms where id='".$p['page']['formID']."' limit 1")) {

      $formc= new msForm;
      $formc->setFormID($p['page']['formID']);

      $formData['cda']=Spyc::YAMLLoad($formData['cda']);

      if(isset($formData['cda']['actesPossibles'],$formData['cda']['clinicalDocument']['documentationOf']['serviceEvent']['paramConditionServiceEvent'])) {

        // associations déjà en place
        $p['page']['deja']=$formData['cda']['clinicalDocument']['documentationOf']['serviceEvent']['code'];

        // actes possibles définis
        $p['page']['actesPossibles']=$formData['cda']['actesPossibles'];

        // paramètres concernés
        $p['page']['paramsPossibles']=(array)$formData['cda']['clinicalDocument']['documentationOf']['serviceEvent']['paramConditionServiceEvent'];

        // sortie data de chaque param
        $data = new msData;
        foreach($p['page']['paramsPossibles'] as $k=>$pa) {
          if(is_string($pa)) {
            $p['page']['paramsPossiblesData'][$k]=$data->getDataTypeByName($pa);
            treatDataType($p['page']['paramsPossiblesData'][$k]);
            $nbPo[$k]=count($p['page']['paramsPossiblesData'][$k]['formValues']);
          } elseif (is_array($pa)) {
            foreach($pa as $sk=>$spa) {
              $p['page']['paramsPossiblesData'][$k][$sk]=$data->getDataTypeByName($spa);
              treatDataType($p['page']['paramsPossiblesData'][$k][$sk]);
              if(isset($nbPo[$k])) {
                $nbPo[$k]=$nbPo[$k]+count($p['page']['paramsPossiblesData'][$k][$sk]['formValues']);
              } else {
                $nbPo[$k]=count($p['page']['paramsPossiblesData'][$k][$sk]['formValues']);
              }
            }
          }
        }

        // nombre de possibilités
        $nbPo=array_filter($nbPo);
        $nbPo=array_product($nbPo);

        // on regroupe
        foreach($p['page']['paramsPossiblesData'] as $k=>$v) {
            if(isset($v['label'])) {
              foreach($v['keyValues'] as $kv) {
                $tab[$k]['asso'][$v['name'].'@'.$kv]=$v['formValues'][$kv];
              }
            } else {
              foreach($v as $k2=>$v2)
                foreach($v2['keyValues'] as $kv2) {
                  $tab[$k]['asso'][$v2['name'].'@'.$kv2]=$v2['formValues'][$kv2];
              }
            }
            $tab[$k]['clefs']=array_keys($tab[$k]['asso']);
            $tab[$k]['values']=array_values($tab[$k]['asso']);
        }

        // on génère le tableau final pour exploitation par twig
        foreach($tab as $k=>$v) {
          for($i=0;$i<$nbPo;$i++) {
            $nblocal=count($v['clefs']);
            if(!isset($tabr[$i])) {
              $tabr[$i]['clef']=$v['clefs'][($i%$nblocal)];
            } else {
              $tabr[$i]['clef'].='|'.$v['clefs'][($i%$nblocal)];
            }
            $tabr[$i]['values'][$k]=$v['values'][($i%$nblocal)];
          }
        }

        sort($tabr);
        $p['page']['dataTab']=$tabr;
      }


      // jeux de valeurs
      $p['page']['jdvClinicalDocumentCode']=msExternalData::getJdvDataFromXml('JDV_J07-XdsTypeCode_CI-SIS.xml');

    }
 }
