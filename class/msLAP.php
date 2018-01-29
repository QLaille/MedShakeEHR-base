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
 *
 * LAP
 *
 * @author Bertrand Boutillier <b.boutillier@gmail.com>
 */

class msLAP
{

 /**
  * @var int $_toID ID de l'individus concerné
  */
     private $_toID;
  /**
  * @var array $_patientAdminData données administratives du patient
  */
     private $_patientAdminData;
 /**
  * @var int $_fromID ID de l'utilisteur enregistrant la donnée
  */
     private $_fromID;
  /**
   * @var object $_the Instance Thériaque
   */
     private $_the;


 /**
  * Définir l'individu concerné
  * @param int $v ID de l'individu concerné
  * @return int toID
  */
     public function setToID($v)
     {
         if (is_numeric($v)) {

             $patient= new msPeople;
             $patient->setToID($v);
             $this->_patientAdminData=$patient->getSimpleAdminDatasByName();
             $this->_patientAdminData['age'] = DateTime::createFromFormat('d/m/Y', $this->_patientAdminData['birthdate'])->diff(new DateTime('now'))->y;
             return $this->_toID = $v;

         } else {
             throw new Exception('ToID is not numeric');
         }
     }

 /**
  * Définir l'utilisateur qui enregsitre la donnée
  * @param int $v ID de l'utilisateur
  * @return int fromID
  */
     public function setFromID($v)
     {
         if (is_numeric($v)) {
             return $this->_fromID = $v;
         } else {
             throw new Exception('FromID is not numeric');
         }
     }

 /**
  * Effectuer tous les tests de controle patients
  * @return array tableau de résultats des tests
  */
     public function getPatientAdminData()
     {
       return $this->_patientAdminData;
     }


/**
 * Effectuer tous les tests de controle patients
 * @return array tableau de résultats des tests
 */
    public function getPatientBasicPhysioDataControle()
    {
        if (!isset($this->_toID)) {
            throw new Exception('ToID is not numeric');
        } else {
            $data['poids']=$this->_checkPoids();
            $data['taillePatient']=$this->_checkTaillePatient();
            $data['clairanceCreatinine']=$this->_checkClairanceCreatinine();
            $data['allaitement']=$this->_checkAllaitement();
            $data['grossesse']=$this->_checkGrossesse();

            return $data;
        }
    }

/**
 * Obtenir des médicaments en recherchant en DC
 * @param  string $txt mot clé de recherche
 * @return array      tableau de retour
 */
    public function getMedicInDC($txt) {
      if(strlen($txt)>=3) {
        if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
        $rd=[];

        if($data=$the->get_the_denomination_commune(3, $txt.'%', 0)) {
          // 1 résultat
          if(isset($data->item->code)) {
            $rd[0]=(array)$data->item;
          }
          // plusieurs
          elseif (isset($data->item)) {
            foreach($data->item as $k=>$v) {
              $rd[$k]=(array)$v;
            }
          }
          if(!empty($rd)) $this->attacherPrixMedic($rd,'code');
          return $rd;
        }
      }
    }

/**
 * Obtenir les présentation d'une spécialité
 * @param  array $rd      tableau des médicaments
 * @param  string $colCode colonne du tableau où trouver le code theriaque
 * @param  string $typCode type du code passé (0 code thériaque cf doc)
 * @return array          tableau d'entrée modifié
 */
public function getPresentations(&$rd, $colCode, $typCode) {
  foreach($rd as $k=>$v) {
      $rd[$k]['presentations']=$this->_get_the_presentation($v[$colCode], $typCode);
      foreach($rd[$k]['presentations'] as $presK=>$presV) {
        $rd[$k]['presentations'][$presK]['rbtVille']=$this->_get_the_pre_rbt_ville($presV['pre_ean_ref'],2);
      }
  }
}

/**
 * Obtenir les présentations
 * @param  string $codesTheriaque    code thériaque
 * @param  string $typCode             type du code 0 : theriaque ... (cf doc Theriaque)
 * @return array                      tableau
 */
private function _get_the_presentation($codeTheriaque, $typCode) {
  if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
  $rd=[];
  if($data=$the->get_the_presentation_v2($codeTheriaque, $typCode)) {
    $rd=$this->_prepareData($data);
    return $rd;
  }
}

private function _get_the_pre_rbt_ville($code, $typCode) {
  if(empty($code)) return false;
  if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
  $rd=[];
  if($data=$the->get_the_pre_rbt($code,$typCode)) {
    if($data=msTools::objectToArray($data)) {
      if(isset($data['item'])) {
        $data=$data['item'];
        $ou=array_column($data,'type');
        if(isset($data[array_search('1',$ou)]['info_1'])) return $data[array_search('1',$ou)]['info_1'];
      }
    }
    return false;
  }
}

/**
 * Obtenir des substances
 * @param  string $txt mot clé de recherche
 * @return array      tableau de retour
 */
    public function getSubstances($txt,$type) {
      if(strlen($txt)>=3) {
        if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
        $rd=[];
        if($data=$the->get_the_sub_txt($txt,$type)) {
          // 1 résultat
          if(isset($data->item->code_sq_pk)) {
            $rd[0]=(array)$data->item;
          }
          // plusieurs
          elseif (isset($data->item)) {
            foreach($data->item as $k=>$v) {
              $rd[$k]=(array)$v;
            }
          }
          if(!empty($rd)) {
            return $rd;
          }
        }
      }
    }

/**
 * Obtenir des médicaments via substance
 * @param  string $txt mot clé de recherche
 * @param  string $type 1 : sa / 2 : excipient / 0 : sa + excipient
 * @param  string $monovir type de recherche 0 : spé / 1 : dci / 3 : tout
 * @return array      tableau de retour
 */
    public function getMedicBySub($txt,$type, $monovir) {
      if(strlen($txt)>=3) {
        if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
        if($subsTab=$this->getSubstances($txt,$type)) {
          $subs=implode(",", array_column($subsTab, 'code_sq_pk'));
          if($data=$the->get_the_specialite_multi_codeid( $subs, 7, $monovir)) {
            // 1 résultat
            if(isset($data->item->sp_code_sq_pk)) {
              $rd[0]=(array)$data->item;
            }
            // plusieurs
            elseif (isset($data->item)) {
              foreach($data->item as $k=>$v) {
                $rd[$k]=(array)$v;
              }
            }
            if(!empty($rd)) {
              $this->getPresentations($rd,'sp_code_sq_pk', 1);
              $this->attacherPrixMedic($rd,'sp_code_sq_pk');
            }
            $rd['substances']=$subsTab;
            return $rd;
          }
        }
      }
    }

/**
 * Obtenir des médicaments par recherche texte sur le nom
 * @param  string $txt mot clé de recherche
 * @param  string $monovir type de recherche 0 : spé / 1 : dci / 3 : tout
 * @return array      tableau de retour
 */
    public function getMedicByName($txt,$monovir) {
      if(strlen($txt)>=3) {
        if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
        $rd=[];
        if($data=$the->get_the_spe_txt($txt,$monovir)) {
          $rd=$this->_prepareData($data);
          if(!empty($rd)) {
            $this->getPresentations($rd,'sp_code_sq_pk', 1);
            $this->attacherPrixMedic($rd,'sp_code_sq_pk');
          }
          return $rd;
        }
      }
    }

/**
 * Obtenir des médicaments via classe atc
 * @param  string $classe classe de recherche
 * @param  string $monovir type de recherche 0 : spé / 1 : dci / 3 : tout
 * @return array      tableau de retour
 */
    public function getMedicByATC($classe,$monovir) {
      if(strlen($classe)>=1) {
        if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
        $rd=[];
        if($data=$the->get_the_specialite_multi_codeid($classe.'%',10,$monovir)) {
          // 1 résultat
          if(isset($data->item->sp_code_sq_pk)) {
            $rd[0]=(array)$data->item;
          }
          // plusieurs
          elseif (isset($data->item)) {
            foreach($data->item as $k=>$v) {
              $rd[$k]=(array)$v;
            }
          }

          if(!empty($rd)) {
            $this->getPresentations($rd,'sp_code_sq_pk', 1,0);
            $this->attacherPrixMedic($rd,'sp_code_sq_pk');
          }
          return $rd;
        }
      }
    }

/**
 * Attacher le prix par UCD de chaque médic à son tableau
 * @param  array $tabMedic   tableau des médic
 * @param  string $col       colonne du tableau d'entrée qui contient le code thériaque du medoc
 * @return array            array d'entrée avec prixEstim
 */
public function attacherPrixMedic(&$tabMedic, $col) {
  if(is_array($tabMedic) ) {
    $codesTheriaque=array_column($tabMedic, $col);
    if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
    $codesTheriaqueListe=implode(',',$codesTheriaque);

    if($data=$this->_get_the_prix_unit_est($codesTheriaqueListe, 0)) {
      $prixParUcd=array_column((array)$data, 'prix', 'code');
      foreach($tabMedic as $k=>$v) {
        if(isset($prixParUcd[$v[$col]])) $tabMedic[$k]['prixEstim']=$prixParUcd[$v[$col]];
      }
    }
  }
}

/**
 * Obtenir le prix unitaire estimatif
 * @param  string $codesTheriaqueListe liste des codes séparé par virgule
 * @param  string $typCode             type du code 0 : theriaque / 1 : UCD7 / 2 : UCD 13
 * @return array                      tableau
 */
private function _get_the_prix_unit_est($codesTheriaqueListe, $typCode) {
  if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
  $rd=[];
  if($data=$the->get_the_prix_unit_est($codesTheriaqueListe, $typCode)) {
    $rd=$this->_prepareData($data);
    return $rd;
  }
}

/**
 * Attacher le remboursement Sésu de chaque médic à son tableau
 * @param  array $tabMedic   tableau des médic
 * @param  string $col       colonne du tableau d'entrée qui contient le code thériaque du medoc
 * @return array            array d'entrée avec codePrestaSecu
 */
public function attacherPrestaSecuMedic(&$tabMedic, $col) {
  if(is_array($tabMedic) ) {
    $codesTheriaque=array_column($tabMedic, $col);
    if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
    $codesTheriaqueListe=implode(',',$codesTheriaque);

    if($data=$this->_get_the_prix_unit_est($codesTheriaqueListe, 0)) {
      $prixParUcd=array_column((array)$data, 'cpss', 'cip13');
      foreach($tabMedic as $k=>$v) {
        if(isset($prixParUcd[$v[$col]])) $tabMedic[$k]['codePrestaSecu']=$prixParUcd[$v[$col]];
      }
    }
  }
}

/**
 * Obtenir le code prestation sécu
 * @param  string $codesTheriaqueListe liste des codes séparé par virgule
 * @param  string $typCode             type du code 0 : theriaque ... (cf doc Theriaque)
 * @return array                      tableau
 */
private function _get_the_prestation($codesTheriaqueListe, $typCode) {
  if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
  $rd=[];
  if($data=$the->get_the_prestation($codesTheriaqueListe, $typCode)) {
    $rd=$this->_prepareData($data);
    return $rd;
  }
}

/**
 * Recherche de code / libelle CIM 10 par mot clé
 * @param  string $txt mot clé
 * @return array      résultats de recherche
 */
    public function getCIM10fromKeywords($txt) {
      if(strlen($txt)>=3) {
        if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
        $rd=[];
        if($data=$the->get_the_cim_10(3,$txt)) {
          $data=$this->_prepareData($data);
          // 1 résultat
          if(isset($data['item']['code'])) {
            $rd[(string)$data['item']['code']]=(string)$data['item']['libelle_long'];
            return $rd;
          }
          // plusieurs
          elseif(isset($data[0])) {
            foreach($data as $k=>$d) {
              if(isset($d['code'],$d['libelle_long'])) {
                $rd[$d['code']]=$d['libelle_long'];
              }
            }
          }
        }
        return $rd;
      }
    }

/**
 * Obtenir le libelle long CIM 10 via son code
 * @param  string $code code CIM 10
 * @return string       libelle CIM 10
 */
    public function getCIM10LabelFromCode($code) {
      if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
      if($data=$the->get_the_cim_10(2,$code)) {
        if(isset($data->item)) {
          return (string)$data->item->libelle_long;
        }
      }
      return false;
    }

/**
 * Recherche de code / libelle Allergie par mot clé
 * @param  string $txt mot clé
 * @return array      résultats de recherche
 */
    public function getAllergieFromKeywords($txt) {
      if(strlen($txt)>=3) {
        if(isset($this->_the)) $the=$this->_the; else $this->_the=$the=new msTheriaquePG;
        $rd=[];
        if($data=$the->get_the_allergie(3,$txt)) {
          $data=$this->_prepareData($data);

          // 1 résultat
          if(isset($data['item']['code'])) {
            $rd[(string)$data['item']['code']]=(string)$data['item']['libelle'];
            return $rd;
          }
          // plusieurs
          elseif(isset($data[0])) {
            foreach($data as $k=>$d) {
              if(isset($d['code'],$d['libelle'])) {
                $rd[$d['code']]=$d['libelle'];
              }
            }
          }
        }

        return $rd;
      }
    }

/**
 * Sortir et vérifier poids patient
 * @return array array sur infos poids patient
 */
 private function _checkPoids()
 {
     $data=new msObjet;
     $data->setToID($this->_toID);

     if ($data=$data->getLastObjetByTypeName('poids')) {
         $now = new DateTime();
         $now->setTime(0, 0, 0);
         $datePoids = DateTime::createFromFormat('Y-m-d H:i:s', $data['updateDate']);
         $datePoids->setTime(0, 0, 0);
         $interval = $now->diff($datePoids);
         $nbjours=(integer)$interval->format('%a');

         if (is_numeric($data['value']) and $data['value']>30) {
             $statut='ok';
         } elseif (is_numeric($data['value']) and $data['value']>0 and $data['value']<=30 and $nbjours==0) {
             $statut='ok';
         } elseif (is_numeric($data['value']) and $data['value']>0 and $data['value']<=30 and $nbjours!=0) {
             $statut='oldValue';
         } else {
             $statut='incorectValue';
         }

         $rd=array(
          'statut'=>$statut,
          'date'=>$data['updateDate'],
          'from'=>$data['prenom'].' '.$data['nom'],
          'fromID'=>$data['fromID'],
          'value'=>$data['value']
        );

         return $rd;
     } else {
         return $rd=array('statut'=>'missingValue');
     }
 }

 /**
  * Sortir et vérifier taille patient
  * @return array array sur infos taille patient
  */
  private function _checkTaillePatient()
  {
      $data=new msObjet;
      $data->setToID($this->_toID);

      if ($data=$data->getLastObjetByTypeName('taillePatient')) {
          if (is_numeric($data['value']) and $data['value']>20 and $data['value']<=250) {
              $statut='ok';
          } else {
              $statut='incorectValue';
          }

          $rd=array(
         'statut'=>$statut,
         'date'=>$data['updateDate'],
         'from'=>$data['prenom'].' '.$data['nom'],
         'fromID'=>$data['fromID'],
         'value'=>$data['value']
       );

          return $rd;
      } else {
          return $rd=array('statut'=>'missingValue');
      }
  }

  /**
   * Sortir et vérifier clairance créatinine patient
   * @return array array sur infos clairance créatinine patient
   */
   private function _checkClairanceCreatinine()
   {
       $data=new msObjet;
       $data->setToID($this->_toID);

       if ($data=$data->getLastObjetByTypeName('clairanceCreatinine')) {
           if (is_numeric($data['value'])) {
               $statut='ok';
           } else {
               $statut='incorectValue';
           }

           $rd=array(
          'statut'=>$statut,
          'date'=>$data['updateDate'],
          'from'=>$data['prenom'].' '.$data['nom'],
          'fromID'=>$data['fromID'],
          'value'=>$data['value']
        );

           return $rd;
       } else {
           return $rd=array('statut'=>'missingValue');
       }
   }

 /**
  * Sortir et vérifier allaitement patient
  * @return array array sur infos allaitement patient
  */
  private function _checkAllaitement()
  {
      if ($this->_patientAdminData['administrativeGenderCode']!='F') {
          return $rd=array('statut'=>'notConcerned');
      } else {
          $data=new msObjet;
          $data->setToID($this->_toID);
      }
  }

  /**
   * Sortir et vérifier DDR patient
   * @return array array sur infos DDR patient
   */
   private function _checkGrossesse()
   {
       global $p;
       if ($this->_patientAdminData['administrativeGenderCode']!='F') {
           return $rd=array('statut'=>'notConcerned');
       } else {

         //chercher une grossesse en cours (cad si pas de type 245 associé)
         $name2typeID=new msData;
         $name2typeID = $name2typeID->getTypeIDsFromName(['groFermetureSuivi', 'nouvelleGrossesse']);
         if ($findGro=msSQL::sqlUnique("select pd.id as idGro, eg.id as idFin
         from objets_data as pd
         left join objets_data as eg on pd.id=eg.instance and eg.typeID='".$name2typeID['groFermetureSuivi']."' and eg.outdated='' and eg.deleted=''
         where pd.toID='".$this->_toID."' and pd.typeID='".$name2typeID['nouvelleGrossesse']."' and pd.outdated='' and pd.deleted='' order by pd.creationDate desc
         limit 1")) {
             if (!$findGro['idFin']) {

                 $objet=new msObjet;
                 $objet->setToID($this->_toID);

                 //$moduleClass="msMod".ucfirst($p['user']['module'])."CalcMed";
                 $moduleClass="msModGynobsCalcMed";

                 if ($data=$objet->getLastObjetByTypeName('ddgReel', $findGro['idGro'])) {
                   $rd['ddg']=$data['value'];
                   $rd['basedOn']='ddgReel';
                 } elseif ($data=$objet->getLastObjetByTypeName('DDR', $findGro['idGro'])) {
                   $rd['ddr']=$data['value'];
                   $rd['ddg']=$moduleClass::ddr2ddg($data['value']);
                   $rd['basedOn']='DDR';
                 } else {
                     return $rd=array('statut'=>'missingValue');
                 }
                 $rd['terme']=$moduleClass::ddg2terme($rd['ddg'], date('d/m/Y'));
                 $rd['termeMath']=$moduleClass::ddg2termeMath($rd['ddg'], date('d/m/Y'));

                 if($rd['termeMath']>46) {
                   $rd['statut']='termeDepasse46SA';
                 } else {
                   $rd['statut']='grossesseEnCours';
                 }
                 $rd['date']=$data['updateDate'];
                 $rd['from']=$data['prenom'].' '.$data['nom'];
                 $rd['fromID']=$data['fromID'];

                 return $rd;
             } else {
               return $rd=array('statut'=>'absenceGrossesse');
             }
         } else {
           return $rd=array('statut'=>'absenceGrossesse');
         }
     }
   }

   private function _prepareData($data) {
     if(is_object($data)) {
       $data=msTools::object2objectToArray($data);
       $rd=$data['item'];
     } else {
       $rd=$data;
     }
     return $rd;
   }
}
