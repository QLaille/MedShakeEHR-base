UPDATE `forms` SET `yamlStructure`='structure:\r\n  row1:                              \r\n    col1:                              \r\n      head: \'Etat civil\'             \r\n      size: 4\r\n      bloc:                          \r\n        - administrativeGenderCode                 		#14   Sexe\n        - birthname,required,autocomplete,data-acTypeID=2:1 		#1    Nom de naissance\n        - lastname,autocomplete,data-acTypeID=2:1  		#2    Nom d usage\n        - firstname,required,autocomplete,data-acTypeID=3:22:230:235:241 		#3    Prénom\n        - birthdate,class=pick-year               		#8    Date de naissance\n    col2:\r\n      head: \'Contact\'\r\n      size: 4\r\n      bloc:\r\n        - personalEmail                            		#4    Email personnelle\n        - mobilePhone                              		#7    Téléphone mobile\n        - homePhone                                		#10   Téléphone domicile\n    col3:\r\n      head: \'Adresse personnelle\'\r\n      size: 4\r\n      bloc: \r\n        - streetNumber                             		#9    Numéro\n        - street,autocomplete,data-acTypeID=11:55  		#11   Rue\n        - postalCodePerso                          		#13   Code postal\n        - city,autocomplete,data-acTypeID=12:56    		#12   Ville\n        - deathdate                                		#508  Date de décès\n  row2:\r\n    col1:\r\n      size: 12\r\n      bloc:\r\n        - notes,rows=5                             		#21   Notes', `yamlStructureDefaut`='structure:\r\n  row1:                              \r\n    col1:                              \r\n      head: \'Etat civil\'             \r\n      size: 4\r\n      bloc:                          \r\n        - administrativeGenderCode                 		#14   Sexe\n        - birthname,required,autocomplete,data-acTypeID=2:1 		#1    Nom de naissance\n        - lastname,autocomplete,data-acTypeID=2:1  		#2    Nom d usage\n        - firstname,required,autocomplete,data-acTypeID=3:22:230:235:241 		#3    Prénom\n        - birthdate,class=pick-year               		#8    Date de naissance\n    col2:\r\n      head: \'Contact\'\r\n      size: 4\r\n      bloc:\r\n        - personalEmail                            		#4    Email personnelle\n        - mobilePhone                              		#7    Téléphone mobile\n        - homePhone                                		#10   Téléphone domicile\n    col3:\r\n      head: \'Adresse personnelle\'\r\n      size: 4\r\n      bloc: \r\n        - streetNumber                             		#9    Numéro\n        - street,autocomplete,data-acTypeID=11:55  		#11   Rue\n        - postalCodePerso                          		#13   Code postal\n        - city,autocomplete,data-acTypeID=12:56    		#12   Ville\n        - deathdate                                		#508  Date de décès\n  row2:\r\n    col1:\r\n      size: 12\r\n      bloc:\r\n        - notes,rows=5                             		#21   Notes' WHERE `internalName`='baseNewPatient';

UPDATE `forms` SET `yamlStructure`='col1:\r\n    head: "Date de naissance" \r\n    bloc: \r\n        - birthdate                                		#8    Date de naissance\ncol2:\r\n    head: "Tel" \r\n    blocseparator: " - "\r\n    bloc: \r\n        - mobilePhone                              		#7    Téléphone mobile\n        - homePhone                                		#10   Téléphone domicile\ncol3:\r\n    head: "Email"\r\n    bloc:\r\n        - personalEmail                            		#4    Email personnelle\ncol4:\r\n    head: "Ville"\r\n    bloc:\r\n        - city,text-uppercase                      		#12   Ville', `yamlStructureDefaut`='col1:\r\n    head: "Date de naissance" \r\n    bloc: \r\n        - birthdate                                		#8    Date de naissance\ncol2:\r\n    head: "Tel" \r\n    blocseparator: " - "\r\n    bloc: \r\n        - mobilePhone                              		#7    Téléphone mobile\n        - homePhone                                		#10   Téléphone domicile\ncol3:\r\n    head: "Email"\r\n    bloc:\r\n        - personalEmail                            		#4    Email personnelle\ncol4:\r\n    head: "Ville"\r\n    bloc:\r\n        - city,text-uppercase                      		#12   Ville' WHERE `internalName`='baseListingPatients';

UPDATE `forms` SET `yamlStructure`='structure:\r\n row1:\r\n  col1: \r\n    size: 3\r\n    bloc: \r\n      - regleSituationPatient,class=regleSituationPatient                      		#197  Situation du patient\n  col2: \r\n    size: 3\r\n    bloc: \r\n      - regleTarifCejour,required,readonly,plus={€},class=regleTarifCejour       		#198  Tarif SS\n  col3: \r\n    size: 3\r\n    bloc: \r\n      - regleDepaCejour,plus={€},class=regleDepaCejour                 		#199  Dépassement\n  col4: \r\n    size: 3\r\n    bloc: \r\n      - regleFacture,readonly,plus={€},class=regleFacture           		#196  Facturé\n row2:\r\n  col1: \r\n    size: 3\r\n    bloc: \r\n      - regleCB,plus={€},class=regleCB                         		#194  CB\n  col2: \r\n    size: 3\r\n    bloc: \r\n      - regleCheque,plus={€},class=regleCheque                     		#193  Chèque\n  col3: \r\n    size: 3\r\n    bloc: \r\n      - regleEspeces,plus={€},class=regleEspeces                    		#195  Espèces\n  col4: \r\n    size: 3\r\n    bloc: \r\n      - regleTiersPayeur,plus={€},class=regleTiersPayeur                		#200  Tiers\n row3:\r\n  col1: \r\n    size: 6\r\n    bloc: \r\n      - regleIdentiteCheque,class=regleIdentiteCheque                        		#205  Identité payeur', `yamlStructureDefaut`='structure:\r\n row1:\r\n  col1: \r\n    size: 3\r\n    bloc: \r\n      - regleSituationPatient,class=regleSituationPatient                      		#197  Situation du patient\n  col2: \r\n    size: 3\r\n    bloc: \r\n      - regleTarifCejour,required,readonly,plus={€},class=regleTarifCejour       		#198  Tarif SS\n  col3: \r\n    size: 3\r\n    bloc: \r\n      - regleDepaCejour,plus={€},class=regleDepaCejour                 		#199  Dépassement\n  col4: \r\n    size: 3\r\n    bloc: \r\n      - regleFacture,readonly,plus={€},class=regleFacture           		#196  Facturé\n row2:\r\n  col1: \r\n    size: 3\r\n    bloc: \r\n      - regleCB,plus={€},class=regleCB                         		#194  CB\n  col2: \r\n    size: 3\r\n    bloc: \r\n      - regleCheque,plus={€},class=regleCheque                     		#193  Chèque\n  col3: \r\n    size: 3\r\n    bloc: \r\n      - regleEspeces,plus={€},class=regleEspeces                    		#195  Espèces\n  col4: \r\n    size: 3\r\n    bloc: \r\n      - regleTiersPayeur,plus={€},class=regleTiersPayeur                		#200  Tiers\n row3:\r\n  col1: \r\n    size: 6\r\n    bloc: \r\n      - regleIdentiteCheque,class=regleIdentiteCheque                        		#205  Identité payeur' WHERE internalName='baseReglement';

UPDATE `forms` SET `yamlStructure`='col1:\r\n    head: "Activité pro" \r\n    bloc: \r\n        - job                                      		#19   Activité professionnelle\ncol2:\r\n    head: "Tel" \r\n    bloc: \r\n        - telPro                                   		#57   Téléphone professionnel\ncol3:\r\n    head: "Fax" \r\n    bloc: \r\n        - faxPro                                   		#58   Fax professionnel\ncol4:\r\n    head: "Email"\r\n    bloc-separator: " - "\r\n    bloc:\r\n        - emailApicrypt                            		#59   Email apicrypt\n        - personalEmail                            		#4    Email personnelle\ncol5:\r\n    head: "Ville"\r\n    bloc:\r\n        - villeAdressePro,text-uppercase           		#56   Ville', `yamlStructureDefaut`='col1:\r\n    head: "Activité pro" \r\n    bloc: \r\n        - job                                      		#19   Activité professionnelle\ncol2:\r\n    head: "Tel" \r\n    bloc: \r\n        - telPro                                   		#57   Téléphone professionnel\ncol3:\r\n    head: "Fax" \r\n    bloc: \r\n        - faxPro                                   		#58   Fax professionnel\ncol4:\r\n    head: "Email"\r\n    bloc-separator: " - "\r\n    bloc:\r\n        - emailApicrypt                            		#59   Email apicrypt\n        - personalEmail                            		#4    Email personnelle\ncol5:\r\n    head: "Ville"\r\n    bloc:\r\n        - villeAdressePro,text-uppercase           		#56   Ville' WHERE `internalName`='baseListingPro'; 

UPDATE `forms` SET `yamlStructure`='structure:\r\n  row1: \r\n    col1: \r\n      size: 12 col-12 col-sm-4 col-lg-4\r\n      bloc: \r\n        - poids,plus={<i class="fa fa-clone duplicate"></i>} #34   Poids\r\n    col2: \r\n      size: 12 col-12 col-sm-4 col-lg-4\r\n      bloc: \r\n       - taillePatient,plus={<i class="fa fa-clone duplicate"></i>} #35   Taille\r\n    col3: \r\n      size: 12 col-12 col-sm-4 col-lg-4\r\n      bloc: \r\n       - imc,readonly,plus={<i class="fa fa-chart-line graph"></i>} #43   IMC\r\n  row2: \r\n   col1: \r\n     size: 12\r\n     bloc: \r\n       - job                                       		#19   Activité professionnelle\r\n       - allergies,rows=2                          		#66   Allergies\r\n       - toxiques                                  		#42   Toxiques\r\n  row3: \r\n    col1: \r\n     size: 12\r\n     bloc: \r\n       - atcdMedicChir,rows=6                      		#41   Antécédents médico-chirugicaux\r\n       - atcdFamiliaux,rows=6                      		#38   Antécédents familiaux', `yamlStructureDefaut`='structure:\r\n  row1: \r\n    col1: \r\n      size: 12 col-12 col-sm-4 col-lg-4\r\n      bloc: \r\n        - poids,plus={<i class="fa fa-clone duplicate"></i>} #34   Poids\r\n    col2: \r\n      size: 12 col-12 col-sm-4 col-lg-4\r\n      bloc: \r\n       - taillePatient,plus={<i class="fa fa-clone duplicate"></i>} #35   Taille\r\n    col3: \r\n      size: 12 col-12 col-sm-4 col-lg-4\r\n      bloc: \r\n       - imc,readonly,plus={<i class="fa fa-chart-line graph"></i>} #43   IMC\r\n  row2: \r\n   col1: \r\n     size: 12\r\n     bloc: \r\n       - job                                       		#19   Activité professionnelle\r\n       - allergies,rows=2                          		#66   Allergies\r\n       - toxiques                                  		#42   Toxiques\r\n  row3: \r\n    col1: \r\n     size: 12\r\n     bloc: \r\n       - atcdMedicChir,rows=6                      		#41   Antécédents médico-chirugicaux\r\n       - atcdFamiliaux,rows=6                      		#38   Antécédents familiaux' WHERE `internalName`='baseATCD';

UPDATE `forms` SET `yamlStructure`='global:\r\n  formClass: \'form-signin\' \r\nstructure:\r\n row1:\r\n  col1: \r\n    size: 12\r\n    bloc: \r\n      - username,required,nolabel                            		#1    Identifiant\n      - password,required,nolabel                          		#2    Mot de passe\n      - submit,Connexion,class=btn-primary,class=btn-block                                     		#3    Valider', `yamlStructureDefaut`='global:\r\n  formClass: \'form-signin\' \r\nstructure:\r\n row1:\r\n  col1: \r\n    size: 12\r\n    bloc: \r\n      - username,required,nolabel                            		#1    Identifiant\n      - password,required,nolabel                          		#2    Mot de passe\n      - submit,Connexion,class=btn-primary,class=btn-block                                     		#3    Valider' WHERE `internalName`='baseLogin';

INSERT IGNORE INTO `forms` (`module`, `internalName`, `name`, `description`, `dataset`, `groupe`, `formMethod`, `formAction`, `cat`, `type`, `yamlStructure`, `yamlStructureDefaut`, `printModel`) VALUES
('base', 'baseModalNewPatient', 'Formulaire nouveau patient pour modal', 'formulaire d\'enregistrement d\'un nouveau patient dans fenêtre modale', 'data_types', 'admin', 'post', '', 1, 'public', 'structure:\r\n  row1:\r\n    class: \'my-0\'\r\n    col1:\r\n      size: 12\r\n      bloc:                          \r\n        - administrativeGenderCode,nolabel      		#14   Sexe\r\n  row2:\r\n    class: \'my-0\'\r\n    col1:\r\n      size: 6\r\n      bloc:                          \r\n        - birthname,required,nolabel,autocomplete,data-acTypeID=2:1 #1    Nom de naissance\r\n    col2:\r\n      size: 6\r\n      bloc:                          \r\n        - lastname,nolabel,autocomplete,data-acTypeID=2:1  		#2    Nom d usage\r\n  row3:\r\n    class: \'my-0\'\r\n    col1:\r\n      size: 12\r\n      bloc:                          \r\n        - firstname,nolabel,required,autocomplete,data-acTypeID=3:22:230:235:241 		#3    Prénom\r\n        - birthdate,nolabel,required,class=pick-year                   		#8    Date de naissance\r\n        - personalEmail,nolabel                            		#4    Email personnelle\r\n  row4:\r\n    class: \'my-0\'\r\n    col1:\r\n      size: 6\r\n      bloc:                          \r\n        - mobilePhone,nolabel                              		#7    Téléphone mobile\r\n    col2:\r\n      size: 6\r\n      bloc:                          \r\n        - homePhone,nolabel                                		#10   Téléphone domicile\r\n\r\n  row5:\r\n    class: \'my-0\'\r\n    col1:\r\n      size: 4\r\n      bloc: \r\n        - streetNumber,nolabel                             		#9    Numéro\r\n        - postalCodePerso,nolabel                          		#13   Code postal\r\n    col2:\r\n      size: 8\r\n      bloc: \r\n        - street,nolabel,autocomplete,data-acTypeID=11:55  		#11   Rue\r\n        - city,nolabel,autocomplete,data-acTypeID=12:56    		#12   Ville\r\n  row6:\r\n    class: \'my-0\'\r\n    col1:\r\n      size: 12\r\n      bloc:\r\n        - notes,nolabel,rows=5                             		#21   Notes', 'structure:\r\n  row1:\r\n    class: \'input-group-sm my-0\'\r\n    col1:\r\n      size: 12\r\n      bloc:                          \r\n        - administrativeGenderCode,nolabel      		#14   Sexe\r\n  row2:\r\n    class: \'input-group-sm my-0\'\r\n    col1:\r\n      size: 6\r\n      bloc:                          \r\n        - birthname,required,nolabel,autocomplete,data-acTypeID=2:1 #1    Nom de naissance\r\n    col2:\r\n      size: 6\r\n      bloc:                          \r\n        - lastname,nolabel,autocomplete,data-acTypeID=2:1  		#2    Nom d usage\r\n  row3:\r\n    class: \'input-group-sm my-0\'\r\n    col1:\r\n      size: 12\r\n      bloc:                          \r\n        - firstname,nolabel,required,autocomplete,data-acTypeID=3:22:230:235:241 		#3    Prénom\r\n        - birthdate,nolabel,class=pick-year                   		#8    Date de naissance\r\n        - personalEmail,nolabel                            		#4    Email personnelle\r\n  row4:\r\n    class: \'input-group-sm my-0\'\r\n    col1:\r\n      size: 6\r\n      bloc:                          \r\n        - mobilePhone,nolabel                              		#7    Téléphone mobile\r\n    col2:\r\n      size: 6\r\n      bloc:                          \r\n        - homePhone,nolabel                                		#10   Téléphone domicile\r\n\r\n  row5:\r\n    class: \'input-group-sm my-0\'\r\n    col1:\r\n      size: 4\r\n      bloc: \r\n        - streetNumber,nolabel                             		#9    Numéro\r\n        - postalCodePerso,nolabel                          		#13   Code postal\r\n    col2:\r\n      size: 8\r\n      bloc: \r\n        - street,nolabel,autocomplete,data-acTypeID=11:55  		#11   Rue\r\n        - city,nolabel,autocomplete,data-acTypeID=12:56    		#12   Ville\r\n  row6:\r\n    class: \'input-group-sm my-0\'\r\n    col1:\r\n      size: 12\r\n      bloc:\r\n        - notes,nolabel,rows=5                             		#21   Notes', '');

UPDATE `system` SET `value`='v3.2.0' WHERE `name`='base' and `groupe`='module';

CREATE TABLE IF NOT EXISTS `configuration` (
  `id` smallint(4) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `level` enum('default', 'module', 'user') DEFAULT 'default',
  `service` enum('propre', 'tiers') DEFAULT 'propre',
  `toID` int(11) UNSIGNED DEFAULT NULL,
  `module` varchar(20) DEFAULT NULL,
  `cat` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `value` text DEFAULT NULL,
  UNIQUE KEY `nameLevel` (`name`,`level`),
  KEY `toIDmodule` (`toID`, `module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `configuration`(`name`, `service`, `cat`, `level`, `type`, `description`, `value`) VALUES
('PraticienPeutEtrePatient', 'propre', 'Options', 'default', 'true/false', 'si false, le praticien peut toujours avoir une fiche patient séparée', 'true'),
('VoirRouletteObstetricale', 'propre', 'Options', 'default', 'true/false', '', 'true'),
('administratifSecteurHonoraires', 'propre', 'Options', 'default', 'vide/1/2', 'vide si non conventionné', '1'),
('administratifPeutAvoirFacturesTypes', 'propre', 'Options', 'default', 'true/false', '', 'false'),
('administratifPeutAvoirPrescriptionsTypes', 'propre', 'Options', 'default', 'true/false', '', 'false'),
('administratifPeutAvoirAgenda', 'propre', 'Options', 'default', 'true/false', '', 'true'),
('administratifPeutAvoirRecettes', 'propre', 'Options', 'default', 'true/false', '', 'true'),
('administratifComptaPeutVoirRecettesDe', 'propre', 'Options', 'default', 'nombre(s)', 'ID des utilisateurs, séparés par des virgules (sans espace)', ''),
('templatesPdfFolder', 'propre', 'Modèles de documents', 'default', 'dossier', '', ''),
('templateDefautPage', 'propre', 'Modèles de documents', 'default', 'fichier', '', 'base-page-headAndFoot.html.twig'),
('templateOrdoHeadAndFoot', 'propre', 'Modèles de documents', 'default', 'fichier', '', 'base-page-headAndFoot.html.twig'),
('templateOrdoBody', 'propre', 'Modèles de documents', 'default', 'fichier', '', 'ordonnanceBody.html.twig'),
('templateOrdoALD', 'propre', 'Modèles de documents', 'default', 'fichier', '', 'ordonnanceALD.html.twig'),
('templateCrHeadAndFoot', 'propre', 'Modèles de documents', 'default', 'fichier', '', 'base-page-headAndNoFoot.html.twig'),
('templateCourrierHeadAndFoot', 'propre', 'Modèles de documents', 'default', 'fichier', '', 'base-page-headAndNoFoot.html.twig'),
('smtpTracking', 'tiers', 'Mail', 'default', 'chaîne', '', ''),
('smtpFrom', 'tiers', 'Mail', 'default', 'chaîne', '', 'user@domain.net'),
('smtpFromName', 'tiers', 'Mail', 'default', 'chaîne', '', ''),
('smtpHost', 'tiers', 'Mail', 'default', 'url/ip', '', ''),
('smtpPort', 'tiers', 'Mail', 'default', 'nombre', '', '587'),
('smtpSecureType', 'tiers', 'Mail', 'default', 'chaîne', '', 'tls'),
('smtpOptions', 'tiers', 'Mail', 'default', 'chaîne', '', 'off'),
('smtpUsername', 'tiers', 'Mail', 'default', 'chaîne', '', 'smtpuserlogin'),
('smtpPassword', 'tiers', 'Mail', 'default', 'chaîne', '', 'smtppassword'),
('smtpDefautSujet', 'tiers', 'Mail', 'default', 'chaîne', '', 'Document vous concernant'),
('apicryptCheminInbox', 'tiers', 'Rappels mail', 'default', 'dossier', '', ''),
('apicryptCheminArchivesInbox', 'tiers', 'Apicrypt', 'default', 'dossier', '', ''),
('apicryptCheminFichierNC', 'tiers', 'Apicrypt', 'default', 'dossier', '', ''),
('apicryptCheminFichierC', 'tiers', 'Apicrypt', 'default', 'dossier', '', ''),
('apicryptCheminVersClefs', 'tiers', 'Apicrypt', 'default', 'dossier', '', ''),
('apicryptCheminVersBinaires', 'tiers', 'Apicrypt', 'default', 'dossier', '', ''),
('apicryptInboxMailForUserID', 'tiers', 'Apicrypt', 'default', 'nombre', '', '0'),
('apicryptUtilisateur', 'tiers', 'Apicrypt', 'default', 'chaîne', '', 'prenom.NOM'),
('apicryptAdresse', 'tiers', 'Apicrypt', 'default', 'chaîne', '', 'prenom.NOM@medicalXX.apicrypt.org'),
('apicryptSmtpHost', 'tiers', 'Apicrypt', 'default', 'url/ip', '', ''),
('apicryptSmtpPort', 'tiers', 'Apicrypt', 'default', 'nombre', '', '25'),
('apicryptPopHost', 'tiers', 'Apicrypt', 'default', 'url/ip', '', ''),
('apicryptPopPort', 'tiers', 'Apicrypt', 'default', 'nombre', '', '110'),
('apicryptPopUser', 'tiers', 'Apicrypt', 'default', 'chaîne', '', 'prenom.NOM'),
('apicryptPopPass', 'tiers', 'Apicrypt', 'default', 'chaîne', '', 'passwordapicrypt'),
('apicryptDefautSujet', 'tiers', 'Apicrypt', 'default', 'chaîne', '', 'Document concernant votre patient'),
('faxService', 'tiers', 'Fax', 'default', 'url/ip', 'ex: ecofaxOVH', ''),
('ecofaxMyNumber', 'tiers', 'Fax', 'default', 'nombre', '', '0900000000'),
('ecofaxPass', 'tiers', 'Fax', 'default', 'chaîne', '', 'password'),
('dicomHost', 'tiers', 'Fax', 'default', 'url/ip', '', ''),
('dicomPrefixIdPatient', 'tiers', 'DICOM', 'default', 'chaîne', '', '1.100.100'),
('dicomAutoSendPatient2Echo', 'tiers', 'DICOM', 'default', 'true/false', '', 'false'),
('dicomDiscoverNewTags', 'tiers', 'DICOM', 'default', 'true/false', '', 'true'),
('dicomWorkListDirectory', 'tiers', 'DICOM', 'default', 'dossier', '', ''),
('dicomWorkingDirectory', 'tiers', 'DICOM', 'default', 'dossier', '', ''),
('phonecaptureFingerprint', 'propre', 'Phonecapture', 'default', 'chaîne', '', 'phonecapture'),
('phonecaptureCookieDuration', 'propre', 'Phonecapture', 'default', 'nombre', '', '31104000'),
('phonecaptureResolutionWidth', 'propre', 'Phonecapture', 'default', 'nombre', '', '1920'),
('phonecaptureResolutionHeight', 'propre', 'Phonecapture', 'default', 'nombre', '', '1080'),
('agendaService', 'propre', 'Agenda', 'default', 'vide/clicRDV', '', ''),
('agendaDistantLink', 'tiers', 'Agenda', 'default', 'url', 'si agendaService est configuré, alors agendaDistantLink doit être vide', ''),
('agendaDistantPatientsOfTheDay', 'tiers', 'Agenda', 'default', 'url', '', ''),
('agendaLocalPatientsOfTheDay', 'tiers', 'Agenda', 'default', 'fichier', '', 'patientsOfTheDay.json'),
('agendaNumberForPatientsOfTheDay', 'propre', 'Agenda', 'default', 'nombre', '', '0'),
('mailRappelLogCampaignDirectory', 'tiers', 'Rappels mail', 'default', 'dossier', '', ''),
('mailRappelDaysBeforeRDV', 'tiers', 'Rappels mail', 'default', 'nombre', '', '3'),
('smsProvider', 'tiers', 'Rappels SMS', 'default', 'url/ip', '', ''),
('smsLogCampaignDirectory', 'tiers', 'Rappels SMS', 'default', 'dossier', '', ''),
('smsDaysBeforeRDV', 'tiers', 'Rappels SMS', 'default', 'nombre', '', '3'),
('smsCreditsFile', 'tiers', 'Rappels SMS', 'default', 'fichier', '', 'creditsSMS.txt'),
('smsSeuilCreditsAlerte', 'tiers', 'Rappels SMS', 'default', 'nombre', '', '150'),
('smsTpoa', 'tiers', 'Rappels SMS', 'default', 'chaîne', '', 'Dr ....'),
('clicRdvApiKey', 'tiers', 'clicRDV', 'default', 'chaîne', '', ''),
('clicRdvUserId', 'tiers', 'clicRDV', 'default', 'chaîne', '', ''),
('clicRdvPassword', 'tiers', 'clicRDV', 'default', 'chaîne', '', ''),
('clicRdvGroupId', 'tiers', 'clicRDV', 'default', 'nombre', '', ''),
('clicRdvCalId', 'tiers', 'clicRDV', 'default', 'nombre', '', ''),
('clicRdvConsultId', 'tiers', 'clicRDV', 'default', 'JSON', '', '');

INSERT IGNORE INTO configuration (`name`, `level`, `toID`, `value`) 
SELECT dt.name, 'user', od.toID, od.value FROM objets_data AS od
LEFT JOIN data_types AS dt ON dt.id=od.typeID
WHERE od.deleted='' and od.outdated='' and dt.groupe='user';
