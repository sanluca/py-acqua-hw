<?php
/*
= LuxCal event calendar admin interface language file =

La traduction française a été réalisée par Fabiou. Mis à jour et complété par Gérard.

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LAI","4.3.0");

/* -- Admin Interface texts -- */

$ax = array(

//general
"none" => "Aucun",
"all" => "Tous",
"back" => "Retour",
"close" => "Fermer",
"always" => "Toujours",
"at_time" => "à", //date and time separator (e.g. 10-04-2016 @ 10:45)
"year" => "Année",
"month" => "Mois",
"week_day" => "Semaine/Jour",
"upcoming" => "A venir",
"id" => "ID",

//settings.php - En-tête de paragraphe + general
"set_general_settings" => "Calendrier",
"set_navbar_settings" => "Barre de navigation",
"set_event_settings" => "Événements",
"set_user_settings" => "Utilisateurs",
"set_email_settings" => "Paramètres email",
"set_perfun_settings" => "Fonctions périodiques (applicables uniquement si cron actif)",
"set_minical_settings" => "Mini Calendrier (applicable uniquement si utilisé)",
"set_sidebar_settings" => "Barre latérale autonome (applicable uniquement si utilisée)",
"set_view_settings" => "Vues",
"set_dt_settings" => "Dates et Heures",
"set_save_settings" => "Enregistrer les paramètres",
"set_test_mail" => "Test Mail",
"set_mail_sent_to" => "Test mail envoyé à",
"set_mail_sent_from" => "This test mail was sent from your calendar's Settings page",
"set_missing_invalid" => "Paramètres manquants ou invalides (fond accentué)",
"set_settings_saved" => "Paramètres enregistrés",
"set_save_error" => "Erreur Base de données - L’enregistrement des paramètres du calendrier a échoué",
"hover_for_details" => "Survoler le texte pour avoir les descriptions complètes",
"default" => "défaut",
"enabled" => "actif",
"disabled" => "inactif",
"no" => "non",
"yes" => "oui",
"or" => "ou",
"minutes" => "minutes",
"pixels" => "pixels",
"no_way" => "Vous n’avez pas les droits d’accès pour effectuer cette commande",

//settings.php - general Settings. Les apostrophes dans les traductions ..._text ci-dessous doivent être échappées par un antislash (\')
"calVersionDb_label" => "Version du Calendrier - Base de donnée",
"calVersionDb_text" => "Version installée du logiciel de calendrier et le folder/name of the currently used SQLite database file.",
"calTitle_label" => "Titre du calendrier",
"calTitle_text" => "Affiché dans la barre du haut et utilisé dans les notifications d’email.",
"calUrl_label" => "URL du calendrier",
"calUrl_text" => "Adresse du calendrier de votre site Web. Ex.: http://www.monsite.com/LuxCal/.",
"calEmail_label" => "Adresse email du calendrier",
"calEmail_text" => "Cette adresse email est utilisée pour transmettre et recevoir les emails de notification.<br>Format&nbsp;: “adresse mail” ou “nom&#8249;adresse mail&#8250;”. Le “nom” peut être celui du calendrier.",
"backLinkUrl_label" => "Lien vers la page parent",
"backLinkUrl_text" => "URL de la page parent. Si spécifié, un bouton Retour sera affiché à gauche de la barre de navigation et pointera sur cette URL.<br>Par exemple, pour retourner à la page qui a lancé le calendrier.",
"timeZone_label" => "Fuseau horaire",
"timeZone_text" => "Fuseau horaire du calendrier, utilisé pour calculer l’heure courante.",
"see" => "voir",
"notifSender_label" => "Expéditeur des emails de notification",
"notifSender_text" => "Quand les emails de rappel sont envoyés, l’adresse email d’expéditeur peut être celle du calendrier ou celle de l’utilisateur qui a créé l’événement.",
"rssFeed_label" => "Lien flux RSS",
"rssFeed_text" => "Si activé : pour les utilisateurs ayant au moins le droit de visibilité, un lien de flux RSS sera visible dans le pied de page du calendrier et sera ajouté dans l’entête des pages HTML du calendrier.",
"calendar" => "calendrier",
"user" => "utilisateur",
"php_mail" => "courriel PHP",
"smtp_mail" => "courriel SMTP",

//settings.php - navigation bar settings. Les apostrophes dans les traductions ..._text ci-dessous doivent être échappées par un antislash (\')
"navButText_label" => "Texte sur boutons de navigation",
"navButText_text" => "Si activé : les boutons de la barre de navigation seront affichés avec texte. Si désactivé, les boutons seront affichés sous forme d’icônes.",
"sideLists_label" => "To Approve / Todo / Upcoming buttons",
"sideLists_text" => "Si activé: Un bouton [A faire] / [A venir] sera affiché sur la barre de navigation, et permettra d’ouvrir la liste des événements [A faire] / [A venir].",
"navToapList_label" => "To approve button",
"navTodoList_label" => "Bouton [A faire]",
"navUpcoList_label" => "Bouton [A venir]",
"optionsPanel_label" => "Options panel menus",
"optionsPanel_text" => "Affichage des menus dans le menu Options.<br>• Le menu calendrier sert à selectioner un des calendriers installées. (applicable uniquement si plusieurs calendriers sont installées))<br>• Le menu groupes sert à afficher seulement les événements créés par les utilisateurs d'un ou plusieurs groupes.<br>• Le menu utilisateurs sert à afficher seulement les événements créés par un ou plusieurs utilisateurs.<br>• Le menu catégorie sert à afficher seulement les événements appartenant à une ou plusieurs catégories.<br>• Le menu langue sert à sélectionner la langue de l’utilisateur. (applicable uniquement si plusieurs langues sont installées)",
"calMenu_label" => "calendrier",
"groupMenu_label" => "groups",
"userMenu_label" => "utilisateur",
"catMenu_label" => "catégorie",
"langMenu_label" => "langue",
"defaultView_label" => "Vue par défaut au démarrage",
"defaultView_text" => "Choix possible:<br>• Année<br>• Mois<br><br>• Mois de travail (Jours ouvrés)<br>• Semaine<br><br>• Semaine de travail (Jours ouvrés)<br>• Jour<br>• Prochain(s) événement(s)<br>• Modifications<br>Choix recommandé: Mois ou Prochain(s) événement(s).",
"language_label" => "Langue par défaut",
"language_text" => "Les fichiers ai-{langue}.php, ui-{langue}.php, ug-{langue}.php et ug-layout.png doivent être présents dans le répertoire lang/. {langue} = nom de la langue à utiliser. Les noms des fichiers doivent être en minuscules !",

//settings.php - event settings. Les apostrophes dans les traductions ..._text ci-dessous doivent être échappées par un antislash (\')
"ownerTitle_label" => "Show event owner in front of event title",
"ownerTitle_text" => "In the various calendar views, show the event owner name in front of the calendar title.",
"privEvents_label" => "Utiliser les événements privés",
"privEvents_text" => "Les événements privés sont seulement visibles à l’utilisateur qui a créé l’événement.<br>• Actif&nbsp;: Les utilisateurs peuvent créer des événements privés.<br>• Défaut&nbsp;: lors de l’ajout d’événements, la case à cocher “Privé” dans la fenêtre Événements sera cochée par défaut.<br>• Toujours&nbsp;: lors de l’ajout d’événements, ils seront systématiquement privés, la case à cocher “Privé” dans la fenêtre événement ne sera pas affichée.",
"details4All_label" => "Afficher le détail des événements aux utilisateurs",
"details4All_text" => "• Inactif&nbsp;: le détail de l’événement est seulement visible par le créateur et les utilisateurs ayant un droit d’accès “Ajouter/Editer/Supprimer tous”.<br>• Actif&nbsp;: le détail de l’événement est visible par le créateur et les autres utilisateurs.<br>• Connecté&nbsp;: le détail de l’événement est visible par le créateur et les utilisateurs qui sont connectés.",
"evtDelButton_label" => "Voir le bouton [Supprimer] dans la fenêtre événement",
"evtDelButton_text" => "• DInactif&nbsp;: le bouton [Supprimer] dans la fenêtre événement ne sera pas visible. Les utilisateurs avec un droit d’édition ne pourront pas effacer les événements.<br>• Actif&nbsp;: le bouton [Supprimer] dans la fenêtre événement sera visible à tous les utilisateurs.<br>• Gestionnaire&nbsp;: le bouton [Supprimer] dans la fenêtre événement ne sera visible qu’aux utilisateurs ayant un droit “Gestionnaire”.",
"eventColor_label" => "Couleur de l’événement basé sur",
"eventColor_text" => "Chaque événement, affiché dans les différentes vues, peut être associé à la couleur du groupe de son créateur ou à la couleur de la catégorie de l’événement.",
"xField1_label" => "Champ optionnel 1",
"xField2_label" => "Champ optionnel 2",
"xFieldx_text" => "Champ optionnel de texte. Si ce champ est inclus dans le panneau d’événement ci-dessous, le champ sera ajouté comme champ de texte de format libre dans le formulaire d’événement et dans les événements affichés dans toutes les vues et les pages du calendrier.<br>Nom du champ: nom du champ optionel (max. 15 caractères de long). Ex.: “Adresse email”, “Site Web”, “N° de téléphone”.<br>• public: when checked, the field will be visible to all users; otherwise the field will only be visible to logged in users",
"xField_label" => "nom du champs",
"xField_public" => "public",
"logged_in" => "connecté",
"manager_only" => "gestionnaire",
"user_group" => "le group du créateur",
"event_cat" => "la catégorie d'événement",

//settings.php - user account settings. Les apostrophes dans les traductions ..._text ci-dessous doivent être échappées par un antislash (\')
"selfReg_label" => "Inscription",
"selfReg_text" => "Permet aux utilisateurs de s’inscrire eux-mêmes et d’accéder au calendrier.",
"selfRegGrp_label" => "Droits d’auto-inscription",
"selfRegGrp_text" => "User group to which self-registered users will be assigned.",
"selfRegNot_label" => "Notification d’auto-inscription",
"selfRegNot_text" => "Envoi d’une notification à l’adresse email du calendrier pour prévenir qu’un nouvel utilisateur s’est inscrit.",
"restLastSel_label" => "Restaurer les dernières sélections de l’utilisateur",
"restLastSel_text" => "Les dernières selections utilisateur (les paramètres du panneau Option) sera enregistrée et, quand l’utilisateur revisitera le calendrier plus tard, les valeurs seront restaurées.",
"cookieExp_label" => "“Se souvenir de moi”, expiration du cookie en nombre de jours",
"cookieExp_text" => "Nombre de jours avant qu’expire le cookie lié à l’option “Se souvenir de moi” (au moment de la connexion).",
"view" => "consulter",
"post_own" => "ajouter/éditer",
"post_all" => "ajouter/éditer tout",
"manager" => "ajouter/gérer",

//settings.php - Paramètres des vues. Les apostrophes dans les traductions ..._text ci-dessous doivent être échappées par un antislash (\')
"evtTemplGen_label" => "Panneau d’événement — Vues générales",
"evtTemplGen_text" => "On spécifie les champs d’événements à afficher dans les diverses vues du calendrier au moyen d’une suite de chiffres.<br>Si un chiffre est spécifié, le champ correspondant sera affiché.",
"evtTemplUpc_label" => "Panneau d’événement — Vue À venir",
"evtTemplUpc_text" => "On spécifie les champs d’événements à afficher dans les vues des événements à venir au moyen d’une suite de chiffres.<br>Si un chiffre est spécifié, le champ correspondant sera affiché.",
"popBoxFields_label" => "Champs pour les info-bulles d’événements",
"popBoxFields_text" => "On spécifie les champs d’événements à afficher dans les info-bulles d’événements au moyen d’une suite de chiffres.<br>Si un chiffre est spécifié, le champ correspondant sera affiché.<br>Si aucun champ n’est spécifié, les info-bulles ne seront pas affichées.",
"templFields_text" => "Signification des chiffres&nbsp;:<br>1 = Champ lieu<br>2 = Champ catégorie<br>3 = Champ description<br>4 = Champ optionnel 1 (voir ci-dessous)<br>5 = Champ optionnel 2 (voir ci-dessous)<br>6 = Email de notification (seulement si une notification a été requise)<br>7 = Date/heure d’ajout/modification et le ou les utilisateurs associés.<br>— L’ordre des chiffres détermine l’ordre d’affichage des champs.",
"popBoxShow_label" => "Info-bulle avec ces détails d’événement",
"popBoxShow_text" => "Si c’est permis, une info-bulle sera affichée quand le curseur survolera un événement dans les vues sélectionnées. Aucun affichage si aucun champ d’info-bulle (voir ci-dessus) n’a été spécifié.",
"yearStart_label" => "Mois de début dans la vue Année",
"yearStart_text" => "L’affichage de la vue Année commencera toujours par le mois dont la valeur aura été choisie (1 - 12) et le nombre de mois affiché dépendra toujours de la valeur saisie dans le nombre de colonnes et de rangées. Le changement d’affichage se fera lors du passage du 1er jour du mois choisi de l’année suivante.<br>La valeur 0 a une fonction particulière: le mois débutant l’année sera fonction de la date du jour et tombera dans la première rangée des mois.",
"colsToShow_label" => "Colonnes affichées dans la vue Année",
"colsToShow_text" => "Nombre de mois affiché dans chaque rangée dans la vue Année.<br>Choix recommandé: 3 ou 4.",
"rowsToShow_label" => "Rangées affichées dans la vue Année",
"rowsToShow_text" => "Nombre de rangées de 4 mois affichée sur une année.<br>Choix recommandé : 4, ce qui permet d’afficher 16 mois d’affilée.",
"weeksToShow_label" => "Semaines affichées dans la vue Mois",
"weeksToShow_text" => "Nombre de semaine affichée par mois.<br>Choix recommandé: 10, ce qui affiche 2 mois 1/2.<br>Les valeurs 0 et 1 ont un sens spécial : 0 = afficher un mois exactement - les jours précédents et suivants restent en blanc.<br>1 = afficher un mois exactement - afficher les événements des jours précédents et suivants.",
"workWeekDays_label" => "Jours ouvrables de la semaine",
"workWeekDays_text" => "Affichage des jours ouvrables de la semaine dans les vues “Mois jours ouvrables” et “Semaine jours ouvrables”.<br>Indiquer le numéro de chaque jour qui doit être visible. Numéros valides :<br>1 = Lundi<br>2 = Mardi<br>....<br>7 = Dimanche<br>Ex.: 12345 = de Lundi à Vendredi",
"lookaheadDays_label" => "Jours affichés des prochains événements",
"lookaheadDays_text" => "Nombre de jour à afficher dans la vue Prochain(s) événement(s), dans la liste “A Faire” et dans les RSS feeds.",
"dwStartHour_label" => "Heure de début dans les vues Jour et Semaine",
"dwStartHour_text" => "Choix de l’heure du début d’une journée d’événements.<br>La valeur par défaut est de 6 pour un début de journée à 6h, ce qui évite de perdre de la place entre minuit et 6 heures.<br>La fenêtre de saisie d’heure commencera elle aussi à cette heure-là.",
"dwEndHour_label" => "Heure de fin dans les vues Jour et Semaine",
"dwEndHour_text" => "Choix de l’heure de la fin d’une journée d’événements.<br>Par exemple, mettre 18 comme valeur évitera de perdre de la place entre 18 heures et minuit.<br>La fenêtre de saisie d’heure finira elle aussi à cette heure-là.",
"dwTimeSlot_label" => "Tranche horaire dans les vues Jour et Semaine",
"dwTimeSlot_text" => "Nombre de minutes dans la tranche horaire pour les vues Jour et Semaine. Cette valeur, ainsi que l’heure de début et l’heure de fin (voir ci-dessus) déterminera le nombre de lignes affichées dans les vues Jour et Semaine.",
"dwTsHeight_label" => "Hauteur de ligne de la tranche horaire",
"dwTsHeight_text" => "Hauteur d’affichage, en pixels, de la tranche horaire dans les vues Jour et Semaine.",
"showInMView_label" => "Afficher dans la vue Mois",
"showInMView_text" => "Enabled/disable the display in Month view of the following items:<br>• URLs in one of the event description fields (will be displayed as hyperlink)<br>• images in one of the event description fields",
"urls" => "URL links",
"images" => "images",
"monthInDCell_label" => "Mois dans chaque cellule jour",
"monthInDCell_text" => "Dans la vue Mois, affiche pour chaque jour les 3 ou 4 premières lettres du mois.",

//settings.php - Paramètres des dates/heures. Les apostrophes dans les traductions ..._text ci-dessous doivent être échappées par un antislash (\')
"dateFormat_label" => "Format de date (jj mm aaaa)",
"dateFormat_text" => "Format des dates d’événements dans les vues du calendrier et les champs de saisie.<br>Caractères possibles : y = année, m = mois et d = jour.<br>Un caractère non alphabétique peut servir de séparateur et sera inséré tel quel.<br>Exemples :<br>y-m-d: 2013-10-31<br>m.d.y: 10.31.2013<br>d/m/y: 31/10/2013",
"dateFormat_expl" => "par exemple y.m.d = 2013.10.31",
"MdFormat_label" => "Format de date (jj mois)",
"MdFormat_text" => "Format des dates composées du mois et du jour.<br>Caractères possibles : M = mois en lettres, d = jour en chiffres.<br>Un caractère non alphabétique peut servir de séparateur et sera inséré tel quel.<br>Exemples :<br>d M = 12 Avril<br>M, d = Juillet, 14",
"MdFormat_expl" => "Exemple : d M = 12 avril",
"MdyFormat_label" => "Format de date (dd mois aaaa)",
"MdyFormat_text" => "Format des dates composées de jour, mois et année.<br>Caractères possibles : d = jour en chiffres, M = mois en lettres, y = année en chiffres.<br>Un caractère non alphabétique peut servir de séparateur et sera inséré tel quel.<br>Exemples :<br>d M y: 12 Avril 2013<br>M d, y: Juillet 8, 2013",
"MdyFormat_expl" => "Exemple : d M y: 12 Avril 2013",
"MyFormat_label" => "Format de date (mois aaaa)",
"MyFormat_text" => "Format des dates composées de mois et année.<br>Caractères possibles : M = mois en lettres, y = année en chiffres.<br>Un caractère non alphabétique peut servir de séparateur et sera inséré tel quel.<br>Exemples :<br>M y = Avril 2013<br>y - M: 2013 - Juillet",
"MyFormat_expl" => "Exemple : M y = Avril 2013",
"DMdFormat_label" => "Format de date (jour jj mois)",
"DMdFormat_text" => "Format des dates composées du jour de semaine, du jour et du mois.<br>Caractères possibles : WD = jour de semaine en lettres, d = jour du mois en chiffres, M = mois en lettres.<br>Un caractère non alphabétique peut servir de séparateur et sera inséré tel quel.<br>Exemples :<br>WD d M: Vendredi 12 Avril<br>WD, M d: Lundi, Juillet 14",
"DMdFormat_expl" => "Exemple : WD, d M: Mardi, 6 avril",
"DMdyFormat_label" => "Format de date (jour dd mois yyyy)",
"DMdyFormat_text" => "Format des dates composées du jour de semaine, du jour, du mois et de l’année.<br>Caractères possibles : WD = jour de semaine en lettres, d = jour du mois en chiffres, M = mois en lettres, y = année en chiffres.<br>Un caractère non alphabétique peut servir de séparateur et sera inséré tel quel.<br>Exemples :<br>WD d M y = Vendredi 13 Avril 2013<br>WD - M d, y = Lundi - Juillet 16, 2013",
"DMdyFormat_expl" => "Exemple : WD, d M y = Vendredi, 13 Avril 2013",
"timeFormat_label" => "Format de l’heure (hh mm)",
"timeFormat_text" => "Format de l’heure des événements dans les vues du calendrier et les champs de saisie.<br>Caractères possibles : h = heures, H = heures avec zéro initial, m = minutes, a = am/pm (optionnel), A = AM/PM (optionnel).<br>Un caractère non alphabétique peut servir de séparateur et sera inséré tel quel.<br>Exemples :<br>h:m: 18:35<br>h.m a: 6.35 pm<br>H:mA: 06:35PM",
"timeFormat_expl" => "Exemple : h:m: 22:35 and h:mA: 10:35PM",
"weekStart_label" => "Premier jour de la semaine",
"weekStart_text" => "Jour qui débute la semaine.",
"weekNumber_label" => "Afficher les n° des semaines",
"weekNumber_text" => "Permet d’afficher ou non les numéros des semaines dans les vues Année, Mois et Semaine",
"time_format_us" => "12 heures AM/PM",
"time_format_eu" => "24 heures",
"sunday" => "Dimanche",
"monday" => "Lundi",
"time_zones" => "FUSEAUX HORAIRES",
"dd_mm_yyyy" => "jj-mm-aaaa",
"mm_dd_yyyy" => "mm-jj-aaaa",
"yyyy_mm_dd" => "aaaa-mm-jj",

//settings.php - email settings. Les apostrophes dans les traductions ..._text ci-dessous doivent être échappées par un antislash (\')
"mailServer_label" => "Serveur mail",
"mailServer_text" => "Le mail par convient pour des mails non authentifiés en petit nombre. Pour un plus grand nombre de mails, ou quand l’authentification est requise, le mail SMTP s’impose.<br>L’usage de SMTP demande un serveur mail SMTP. On doit ensuite spécifier les paramètres de configuration à utiliser avec le serveur SMTP. Si le mail est désactivé, la section Envoi mail de la fenêtre des événements sera supprimée.",
"smtpServer_label" => "Nom du serveur SMTP",
"smtpServer_text" => "Si le mail par SMTP est sélectionné, le nom du serveur SMTP doit être spécifié ici. Par exemple, pour le serveur SMTP de gmail&nbsp;: smtp.gmail.com.",
"smtpPort_label" => "Numéro de port SMTP",
"smtpPort_text" => "Si le mail par SMTP est sélectionné, le numéro de port SMTP doit être spécifié ici, par exemple 25, 465 ou 587. Gmail, lui, utilise le port 465.",
"smtpSsl_label" => "SSL (Secure Sockets Layer)",
"smtpSsl_text" => "Si le mail par SMTP est sélectionné, signaler ici si le “secure sockets layer” (SSL) doit être activé. Pour gmail&nbsp;: activé",
"smtpAuth_label" => "Authentification SMTP",
"smtpAuth_text" => "Si l’authentification SMTP est sélectionnée, le nom d’utilisateur et le mot de passe spécifiés plus loin serviront à authentifier le mail SMTP.",
"smtpUser_label" => "Nom d’utilisateur SMTP",
"smtpUser_text" => "Si le mail par SMTP est sélectionné, spécifier ici le nom de l’utilisateur SMTP. Pour gmail, c’est la partie de votre adresse email avant l’ @.",
"smtpPass_label" => "Mot de passe SMTP",
"smtpPass_text" => "Si le mail par SMTP est sélectionné, spécifier ici le mot de passe SMTP.",

//settings.php - periodic function settings. Les apostrophes dans les traductions ..._text ci-dessous doivent être échappées par un antislash (\')
"cronSummary_label" => "Résumé du job cron à l’Administrateur",
"cronSummary_text" => "Envoyer un résumé du job cron à l’administrateur du calendrier.<br>L’activation est utile seulement si un job cron est activé pour le calendrier.",
"chgEmailList_label" => "Adresse email pour les modifications",
"chgEmailList_text" => "Adresse email pour recevoir les modifications faites aux événements.<br>Séparer les adresses email par des points-virgules.",
"chgNofDays_label" => "Jours précédents pour les modifications",
"chgNofDays_text" => "Nombre de jours précédents à afficher pour les événements modifiés.<br>Si la valeur est à 0, aucun e-mail reprenant les modifications ne sera envoyé.",
"icsExport_label" => "Exportation journalière des événements iCal",
"icsExport_text" => "Si activé&nbsp;: Tous les événements dans la fourchette -1 semaine jusqu’à +1 an seront exportés au format iCalendar dans un fichier .ics dans le dossier “files”.<br>Le nom du fichier sera le nom du calendrier avec les blancs remplacés par des tirets bas. Les anciens fichiers seront écrasés par les nouveaux.",
"eventExp_label" => "Expiration des événements, en jours",
"eventExp_text" => "Nombre de jours après la date d’expiration de l’événement avant qu’ìl soit effacé automatiquement.<br>Si zéro ou si pas de tâche cron active, aucun événement ne sera automatiquement effacé.",
"maxNoLogin_label" => "Nombre de jour maxi entre 2 connexions",
"maxNoLogin_text" => "Si un utilisateur ne s’est pas connecté dans l’intervalle du nombre de jours indiqués, le compte de l’utilisateur sera automatiquement supprimé sauf si la valeur est à 0.",

//settings.php - mini calendar / side bar settings. Les apostrophes dans les traductions ..._text ci-dessous doivent être échappées par un antislash (\')
"miniCalView_label" => "Vue du mini-calendrier",
"miniCalView_text" => "Les vues possibles pour le mini-calendrier sont&nbsp;:<br>• Mois complet<br>• Mois de travail *<br>• Semaine complète<br>• Semaine de travail *<br>* Pour les jours ouvrables de la semaine, voir cette page&nbsp;: Vues - Jours ouvrables de la semaine",
"miniCalPost_label" => "Ajouter dans le mini-calendrier",
"miniCalPost_text" => "Seulement si le mini-calendrier est utilisé&nbsp;!<br>Si activé, les utilisateurs peuvent&nbsp;:<br>• ajouter un nouvel événement en cliquant sur le jour du calendrier<br>• éditer/supprimer un événement en cliquant sur l’événement<br>Note&nbsp;: Les droits d’accès de l’utilisateur public seront applicables.",
"popFieldsMcal_label" => "Champs événements - info-bulle du mini-calendrier",
"popFieldsMcal_text" => "Les champs d’événement à afficher dans une info-bulle quand on survole un événement du mini-calendrier se spécifient au moyen d’une suite de chiffres.<br>Si aucun champ n’est spécifié, aucune info-bulle ne sera affichée.",
"mCalUrlFull_label" => "URL du mini-calendrier vers le calendrier complet",
"mCalUrlFull_text" => "Quand on clique sur le mois en haut du mini-calendrier pour aller vers le calendrier complet, on sera dirigé vers cet URL.<br>Si rien n’est spécifié, le calendrier complet s’ouvrira dans une nouvelle fenêtre.<br>Cet URL est particulièrement utile quand le calendrier complet est intégré dans une page existante de l’utilisateur.",
"popFieldsSbar_label" => "Champs événement - info-bulle de la barre latérale",
"popFieldsSbar_text" => "Les champs d’événement à afficher dans une info-bulle quand on survole un événement de la barre latérale autonome se spécifient au moyen d’une suite de chiffres.<br>Si aucun champ n’est spécifié, aucune info-bulle ne sera affichée.",
"showLinkInSB_label" => "Montrer les liens dans la barre latérale",
"showLinkInSB_text" => "Afficher les URL à partir de la description d’un événement comme hyperlien dans la prochaine barre d’événements",
"sideBarDays_label" => "Jours à reculer dans la barre latérale",
"sideBarDays_text" => "Nombre de jours à reculer pour les événements de la barre latérale.",

//login.php
"log_log_in" => "Connexion",
"log_remember_me" => "Connexion auto",
"log_register" => "Inscription",
"log_change_my_data" => "Modifier mes données",
"log_change" => "Modifier",
"log_un_or_em" => "Nom d’utilisateur ou adresse email",
"log_un" => "Nom d’utilisateur",
"log_em" => "Adresse email",
"log_pw" => "Mot de passe",
"log_new_un" => "Nouveau nom d’utilisateur",
"log_new_em" => "Nouvel email",
"log_new_pw" => "Nouveau mot de passe",
"log_pw_msg" => "Voici votre détails pour vous connecter à",
"log_pw_subject" => "Votre mot de passe de %%", //%% will be replaced by calendar name
"log_npw_subject" => "Votre nouveau mot de passe de %%", //%% will be replaced by calendar name
"log_npw_sent" => "Votre nouveau mot de passe a été envoyé",
"log_registered" => "Inscription réussie - Votre mot de passe a été envoyé par email",
"log_not_registered" => "L’inscription a échoué",
"log_un_exists" => "Nom d’utilisateur existe déjà",
"log_em_exists" => "Adresse email existe déjà",
"log_un_invalid" => "Nom d’utilisateur non valide (minimum 2 caractères : A-Z, a-z, 0-9, et _-.) ",
"log_em_invalid" => "Adresse email non valide",
"log_un_em_invalid" => "Nom d’utilisateur/adresse email non valide",
"log_un_em_pw_invalid" => "Nom d’utilisateur/adresse email ou mot de passe non valide",
"log_no_un_em" => "Entrez votre nom d’utilisateur/adresse email",
"log_no_un" => "Entrez votre nom d’utilisateur",
"log_no_em" => "Entrez votre adresse email",
"log_no_pw" => "Entrez votre mot de passe",
"log_no_rights" => "Connexion refusée&nbsp;: Vous n’avez pas les droits d’accès - Contacter l’Adminitrateur.",
"log_send_new_pw" => "Envoyer nouveau mot de passe",
"log_if_changing" => "Uniquement en cas de modification",
"log_no_new_data" => "Aucune donnée à modifier",
"log_invalid_new_un" => "Nouveau nom d’utilisateur non valide (minimum 2 caractères : A-Z, a-z, 0-9, et _-.) ",
"log_new_un_exists" => "Nouveau nom d’utilisateur existe déjà",
"log_invalid_new_em" => "Nouvelle adresse email non valide",
"log_new_em_exists" => "Nouvelle adresse email existe déjà",
"log_ui_language" => "Langue de l’utilisateur",
"log_new_reg" => "Inscription de nouvel utilisateur",
"log_date_time" => "Date / heure",
"log_time_out" => "Time out",

//categories.php
"cat_list" => "Liste des Catégories",
"cat_edit" => "Editer",
"cat_delete" => "Supprimer",
"cat_add_new" => "Ajouter une nouvelle catégorie",
"cat_add" => "Ajouter",
"cat_edit_cat" => "Editer la catégorie ",
"cat_sort" => "Sort On Name",
"cat_name" => "Nom de la catégorie",
"cat_sequence" => "Ordre d’affichage",
"cat_in_menu" => "dans le menu",
"cat_text_color" => "Couleur du texte",
"cat_background" => "Couleur du fond",
"cat_select_color" => "Choix de la couleur",
"cat_save" => "Enregistrer les modifications",
"cat_added" => "Catégorie ajoutée",
"cat_updated" => "Catégorie mise à jour",
"cat_deleted" => "Catégorie supprimée",
"cat_invalid_color" => "Format de couleur non valide (#XXXXXX - X=valeur-HEX)",
"cat_not_added" => "Catégorie non ajoutée",
"cat_not_updated" => "Catégorie non mise à jour",
"cat_not_deleted" => "Catégorie non supprimée",
"cat_nr" => "#",
"cat_repeat" => "Périodicité",
"cat_every_day" => "chaque jour",
"cat_every_week" => "chaque semaine",
"cat_every_month" => "chaque mois",
"cat_every_year" => "chaque année",
"cat_overlap" => "Overlap allowed",
"cat_no_overlap" => "No overlap allowed",
"cat_ol_error_text" => "error text, if overlap",
"cat_no_ol_note" => "Note that already existing events are not checked and consequently may overlap",
"cat_ol_error_msg" => "event overlap; select an other time",
"cat_time_slot" => "Time slot",
"cat_def_slot" => "Default time slot (if no end time specified)",
"cat_ts_no_etime" => "minutes (0: none)",
"cat_tslot_missing" => "Default time slot is missing",
"cat_tslot_invalid" => "Invalid time slot",
"cat_day_color" => "Day color",
"cat_approve" => "Les événements nécessitent une approbation",
"cat_check_mark" => "Case à cocher",
"cat_label" => "étiquette",
"cat_mark" => "texte",
"cat_name_missing" => "Le nom de la catégorie est manquant",
"cat_mark_label_missing" => "Etiquette manquante",

//users.php
"usr_list_of_users" => "Liste des utilisateurs",
"usr_name" => "Nom d’utilisateur",
"usr_email" => "Adresse email",
"usr_group" => "Group",
"usr_password" => "Mot de passe",
"usr_edit_user" => "Edition du profil",
"usr_add" => "Ajout nouvel utilisateur",
"usr_edit" => "Editer",
"usr_delete" => "Supprimer",
"usr_login_0" => "Premier login",
"usr_login_1" => "Dernier login",
"usr_login_cnt" => "Connexions",
"usr_add_profile" => "Ajouter",
"usr_upd_profile" => "Enregistrer le profil",
"usr_if_changing_pw" => "A préciser seulement si vous voulez changer de mot de passe",
"usr_pw_not_updated" => "Mot de passe pas mis à jour",
"usr_added" => "Utilisateur ajouté",
"usr_updated" => "Utilisateur mis à jour",
"usr_deleted" => "Utilisateur supprimé",
"usr_not_added" => "Utilisateur non ajouté",
"usr_not_updated" => "Utilisateur non mis à jour",
"usr_not_deleted" => "Utilisateur non supprimé",
"usr_cred_required" => "Nom d’utilisateur/adresse email et mot de passe obligatoire",
"usr_name_exists" => "Nom d’utilisateur déjà existant",
"usr_email_exists" => "Adresse email existe déjà",
"usr_un_invalid" => "Nom d’utilisateur non valide (minimum 2 caractères : A-Z, a-z, 0-9, et _-.) ",
"usr_em_invalid" => "Adresse email non valide",
"usr_cant_delete_yourself" => "Vous ne pouvez pas vous supprimer",
"usr_go_to_groups" => "Aller aux groupes",

//groups.php
"grp_list_of_groups" => "Liste des groupes d'utilisateurs",
"grp_name" => "Nom de groupe",
"grp_privs" => "Droits",
"grp_categories" => "Event categories",
"grp_all_cats" => "toutes",
"grp_rep_events" => "Repeating events",
"grp_m-d_events" => "Multi-day events",
"grp_priv_events" => "Private events",
"grp_may_post_revents" => "May post repeating events",
"grp_may_post_mevents" => "May post multi-day events",
"grp_may_post_pevents" => "May post private events",
"grp_no_overlap" => "no overlap allowed",
"grp_edit_group" => "Edition du groupe",
"grp_edit" => "Editer",
"grp_delete" => "Supprimer",
"grp_view" => "Voir le Calendrier",
"grp_post_own" => "Ajout/Editer",
"grp_post_all" => "Ajout/Editer Tous",
"grp_manager" => "Ajout/Editer + gestionnaire",
"grp_admin" => "Administrateur",
"grp_add_group" => "Ajouter Groupe",
"grp_upd_group" => "Enregistrer Groupe",
"grp_no_rights" => "Pas de droits d’accès",
"grp_added" => "Groupe ajouté",
"grp_updated" => "Groupe mis à jour",
"grp_deleted" => "Groupe supprimé",
"grp_not_added" => "Groupe non ajouté",
"grp_not_updated" => "Groupe non mis à jour",
"grp_not_deleted" => "Groupe non supprimé",
"grp_in_use" => "Groupe is in use",
"grp_cred_required" => "Nom de groupe, Droits et Categories obligatoire",
"grp_name_exists" => "Nom de groupe déjà existant",
"grp_name_invalid" => "Nom de groupe non valide (minimum 2 caractères : A-Z, a-z, 0-9, et _-.) ",
"grp_background" => "Couleur du Fond",
"grp_select_color" => "Sélectionner la Couleur",
"grp_invalid_color" => "Format de la couleur invalide (#XXXXXX - X = HEX-valeur)",
"grp_go_to_users" => "Aller aux utilisateurs",

//database.php
"mdb_dbm_functions" => "Choix des fonctions",
"mdb_noshow_tables" => "Pas d’accès aux tables",
"mdb_noshow_restore" => "Peux pas trouver le fichier de sauvegarde",
"mdb_file_not_sql" => "Source backup file should be an SQL file (extension '.sql')",
"mdb_compact" => "Compacter la base de données",
"mdb_compact_table" => "Compactage de la table",
"mdb_compact_error" => "Erreur",
"mdb_compact_done" => "Terminé",
"mdb_purge_done" => "Suppression définitive des événements effacés",
"mdb_backup" => "Sauvegarder la base de données",
"mdb_backup_table" => "Sauvegarde de la table",
"mdb_backup_file" => "Fichier de sauvegarde",
"mdb_backup_done" => "Terminé",
"mdb_records" => "enregistrements",
"mdb_restore" => "Restaurer la base de données",
"mdb_restore_table" => "Restaurer table",
"mdb_inserted" => "enregistrements insérés",
"mdb_db_restored" => "Base de données restaurée.",
"mdb_no_bup_match" => "Le fichier de sauvegarde ne correspond pas à la version du calendrier.<br>Base de données ne pas restaurée.",
"mdb_events" => "Événements",
"mdb_delete" => "supprimer",
"mdb_undelete" => "restaurer",
"mdb_between_dates" => "ayant lieu entre",
"mdb_deleted" => "Événements supprimés",
"mdb_undeleted" => "Événements restaurés",
"mdb_file_saved" => "Fichier sauvegardé.",
"mdb_file_name" => "Nom du fichier :",
"mdb_start" => "Démarrer",
"mdb_no_function_checked" => "Aucune fonction sélectionnée",
"mdb_write_error" => "Erreur d’écriture du fichier de sauvegarde.<br>Vérifier les permissions du répertoire “files”",

//import/export.php
"iex_file" => "Sélectionner un fichier",
"iex_file_name" => "Nom du fichier iCal",
"iex_file_description" => "Description du fichier iCal",
"iex_filters" => "Filtres",
"iex_upload_ics" => "Importer un fichier iCal",
"iex_create_ics" => "Créer le fichier iCal",
"iex_upload_csv" => "Importer un fichier CSV",
"iex_upload_file" => "Importer le fichier",
"iex_create_file" => "Exporter le fichier",
"iex_download_file" => "Charger le fichier",
"iex_fields_sep_by" => "Champs séparés par",
"iex_birthday_cat_id" => "ID de la Catégorie",
"iex_default_cat_id" => "ID de la Catégorie par défaut",
"iex_if_no_cat" => "Laisser vide si la catégorie n’existe pas",
"iex_import_events_from_date" => "Importer les événements à partir du",
"iex_see_insert" => "voir liste à droite",
"iex_no_file_name" => "Nom de fichier manquant",
"iex_inval_field_sep" => "Séparateur de champs invalide ou inexistant",
"iex_no_begin_tag" => "Fichier iCal invalide (étiquette BEGIN manquante)",
"iex_date_format" => "Format date événement",
"iex_time_format" => "Format heure événement",
"iex_number_of_errors" => "Nombre d’erreurs dans la liste",
"iex_bgnd_highlighted" => "fond surligné",
"iex_verify_event_list" => "Vérifier la liste des événements, corriger les erreurs et cliquer",
"iex_add_events" => "Ajouter les événements dans la base de données",
"iex_select_ignore_birthday" => "Cocher les cases “ID Anniversaire” et “Supprimer” comme demandé",
"iex_select_ignore" => "Cocher la case “Supprimer” pour ignorer un événement",
"iex_title" => "Titre",
"iex_venue" => "Lieu",
"iex_owner" => "Utilisateur",
"iex_category" => "Catégorie",
"iex_date" => "Date début",
"iex_end_date" => "Date fin",
"iex_start_time" => "Heure début",
"iex_end_time" => "Heure fin",
"iex_description" => "Description",
"iex_repeat" => "Répéter",
"iex_birthday" => "ID Anniversaire",
"iex_ignore" => "Supprimer",
"iex_events_added" => "Événements ajoutés",
"iex_events_dropped" => "Événements sautés (déjà présents)",
"iex_db_error" => "Erreur de base de données",
"iex_csv_file_error_on_line" => "Erreur fichier CSV ligne",
"iex_ics_file_error_on_line" => "Erreur fichier iCal ligne",
"iex_between_dates" => "Occurence entre",
"iex_changed_between" => "Ajouté/modifié entre",
"iex_select_date" => "Sélectionner la date",
"iex_select_start_date" => "Sélectionner la date du début",
"iex_select_end_date" => "Sélectionner la date de fin",
"iex_all_cats" => "toutes",
"iex_all_users" => "tous",
"iex_no_events_found" => "Pas d’événement trouvé",
"iex_file_created" => "Fichier créé",
"iex_write error" => "Erreur d’écriture du fichier d’export.<br>Vérifier les permissions du répertoire “files”",

//lcalcron.php
"cro_sum_header" => "RÉSUMÉ DU JOB CRON",
"cro_sum_trailer" => "FIN DU RESUMÉ",
"cro_evc_sum_title" => "ÉVÉNEMENTS PÉRIMÉS",
"cro_nr_evts_deleted" => "Nombre d’événements supprimés",
"cro_not_sum_title" => "RAPPELS D’EMAIL",
"cro_not_sent_to" => "Rappels envoyés à",
"cro_no_not_dates_due" => "Pas de dates de notification attendues",
"cro_all_day" => "Toute la journée",
"cro_mailer" => "Notification",
"cro_subject" => "Sujet",
"cro_event_due_in" => "L’événement suivant est attendu dans",
"cro_event_due_today" => "L’événement suivant est attendu aujourd’hui",
"cro_due_in" => "attendu dans",
"cro_due_today" => "Attendu aujourd’hui",
"cro_days" => "Jour(s)",
"cro_date_time" => "Date / heure",
"cro_title" => "Titre",
"cro_venue" => "Lieu",
"cro_description" => "Description",
"cro_category" => "Catégorie",
"cro_status" => "Statut",
"cro_open_calendar" => "Ouvrir calendrier",
"cro_chg_sum_title" => "MODIFICATION DANS LE CALENDRIER",
"cro_nr_changes_last" => "Nombre de modifications",
"cro_report_sent_to" => "Rapport envoyé à",
"cro_no_report_sent" => "Pas de rapport envoyé",
"cro_usc_sum_title" => "COMPTES UTILISATEURS EXPIRÉS",
"cro_nr_accounts_deleted" => "Nombre de comptes utilisateurs supprimés",
"cro_no_accounts_deleted" => "Pas de compte utilisateur supprimé",
"cro_ice_sum_title" => "ÉVÉNEMENTS EXPORTÉS",
"cro_nr_events_exported" => "Nombre d’événements exportés au format iCalendar dans le fichier",

//explanations
"xpl_manage_db" =>
"<h4>Instructions pour gérer la Base de données</h4>
<p>Sur cette page, on peut choisir les fonctions suivantes&nbsp;:</p>
<h5>Compacter la base de données</h5>
<p>Lorsqu’un utilisateur efface un événement, il est marqué comme “effacé”, mais il
n’est pas supprimé de la base de données. La fonction “Compacter la base de données”
le supprime physiquement et libére l’espace qu’il occupait.</p>
<h5>Sauvegarder la base de données</h5>
<p>Cette fonction permet de créer une sauvegarde de toute la base de données (tables,
structures et données) dans un format “.sql”. La sauvegarde est enregistrée dans le
répertoire <strong>files/</strong> avec comme nom&nbsp;:
<kbd>cal-dump-aaammjj-hhmmss.sql</kbd> (dans lequel “aaaammjj” = année, mois, et
jour, et “hhmmss” = heure, minutes et secondes.</p>
<p>Ce fichier de sauvegarde peut être utilisé pour recréer les tables, les structures et les données
de la base de données, grâce à la fontion de restauration décrite ci-dessous ou en utilisant par exemple l’outil
<strong>phpMyAdmin</strong>, qui est fourni par la plupart des hôtes web.</p>
<h5>Restaurer la base de données</h5>
<p>La fonction Restaurer will restore the calendar database with the contents of 
the uploaded backup file (file type .sql).</p>
<p>Quand on restaure la base de données, TOUTES LES DONNÉES PRÉSENTES SERONT PERDUES&nbsp;!</p>
<h5>Événements</h5>
<p>Cette fonction supprimera ou restaurera les événements ayant lieu entre les
dates spécifiées. Si une date est laissée en blanc, il n’y a pas de limite&nbsp;; donc si les deux dates sont
laissées en blanc, TOUS LES ÉVÉNEMENTS SERONT SUPPRIMÉS&nbsp;!</p><br>
<p>IMPORTANT&nbsp;: quand on compacte une base de données (voir ci-dessus), les événements sont
définitivement retirés de la base et on ne peut plus du tout les restaurer&nbsp;!</p>",

"xpl_import_csv" =>
"<h4>Instructions pour importer un fichier CSV</h4>
<p>Ce formulaire est utilisé pour importer dans votre calendrier LuxCal un fichier
<strong>CSV</strong> (Comma Separated Values, valeurs séparées par des virgules) contenant des
événements créés par un autre calendrier comme par ex. MS Outlook.</p>
<p>L’ordre des colonnes dans le fichier CSV doit être impérativement comme suit&nbsp;:
titre, lieu, ID catégorie (voir ci-dessous), date début, date fin, heure début,
heure fin et description. La 1ère ligne du fichier CSV, utilisée par le nom des
colonnes, est ignorée.</p>
<h5>Exemples de fichier CSV</h5>
<p>Des exemples de fichier CSV se trouvent dans le répertoire “files” de LuxCal.</p>
<h5>Format de date et heure</h5>
<p>Le format de la date et de l’heure de l’événement côté gauche doit être le même
que le format de la date et de l’heure du fichier CSV.</p>
<h5>Liste des Catégories</h5>
<p>Le calendrier utilise un numéro d’identification (ID) spécifique à chaque
catégorie. Les ID des catégories dans le fichier CSV doivent correspondre aux
catégories utilisées dans le calendrier LuxCal ou à défaut être vides.</p>
<p>Si dans la prochaine étape, vous voulez affecter des événements en tant
qu’“anniversaire”, la catégorie <strong>ID Anniversaire</strong> doit être
identique à l’ID de la catégorie ci-dessous.</p>
<p class='hilight'>Attention&nbsp;: n’importez pas plus de 100 événements à la fois&nbsp;!</p>
<p>Voici les catégories actuellement définies dans votre calendrier&nbsp;:</p>",

"xpl_import_ical" =>
"<h4>Instructions pour importer un fichier iCalendar</h4>
<p>Ce formulaire est utilisé pour importer dans votre calendrier LuxCal un fichier
<strong>iCalendar</strong> contenant des événements.</p>
<p>Le contenu du fichier à importer doit rencontrer le standard de l’Internet
Engineering Task Force
[<u><a href='http://tools.ietf.org/html/rfc5545' target='_blank'>RFC5545 standard</a></u>].</p>
<p>Seuls les événements sont importés; les autres composants iCal (A faire,
Jounal, Libre/Occupé, Alarme et zone de temps) sont ignorés.</p>
<h5>Exemples de fichier iCal</h5>
<p>Des exemples de fichier iCalendar se trouvent dans le répertoire “files/” de
LuxCal.</p>
<h5>Liste des Catégories</h5>
<p>Le calendrier utilise un numéro d’identification (ID) spécifique à chaque
catégorie. Les ID des catégories dans le fichier iCalendar doivent correspondre
aux catégories utilisées dans le calendrier LuxCal ou à défaut être vides.</p>
<p class='hilight'>Attention&nbsp;: n’importez pas plus de 100 événements à la fois&nbsp;!</p>
<p>Voici les catégories actuellement définies dans votre calendrier&nbsp;:</p>",

"xpl_export_ical" =>
"<h4>Instructions pour exporter vers un fichier iCalendar</h4>
<p>Ce formulaire est utilisé pour extraire et exporter les événements du calendrier
LuxCal dans un fichier <strong>iCalendar</strong>.</p>
<p>Le <b>nom du fichier iCal</b> (sans extension) est facultatif. Le fichier créé est sauvegardé
dans le répertoire “files/” du serveur avec un nom de fichier spécifique
ou avec le nom du calendrier. L’extension du fichier sera <b>.ics</b>.
Si un fichier existe déjà dans le répertoire “files/” du serveur avec le même nom, il sera
écrasé par le nouveau fichier.</p>
<p>La <b>description du fichier iCal</b> (ex.: “Réunions 2013”) est facultative.
Si elle existe, elle sera ajoutée à l’en-tête du fichier iCal exporté.</p>
<p><b>Filtres&nbsp;:</b>Les événements à extraire peuvent être filtrés par&nbsp;:</p>
<ul>
<li>Propriétaire</li>
<li>Catégorie</li>
<li>Date début</li>
<li>Date d’ajout/modification</li>
</ul>
<p>Chaque filtre est facultatif. Une date vide = aucun filtre</p>
<br>
<p>Le contenu du fichier à exporter doit rencontrer le standard de l’Internet
Engineering Task Force
[<u><a href='http://tools.ietf.org/html/rfc5545' target='_blank'>RFC5545 standard</a></u>]</p>.
<p>Lorsqu’on <b>télécharge</b> le fichier ical exporté, la date et l’heure sont ajoutées au nom
du fichier téléchargé.</p>
<h5>Exemples de fichier iCal</h5>
<p>Des exemples de fichier iCalendar se trouvent dans le répertoire “files/” de
LuxCal.</p>"
);
?>
