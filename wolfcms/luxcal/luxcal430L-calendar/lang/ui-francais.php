<?php
/*
= LuxCal event calendar language file =

La traduction française a été réalisée par Fabiou. Mis à jour et complété par Gérard.

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LUI","4.3.0");
define("ISOCODE","fr");

/* -- Titles on the Header of the Calendar -- */

$months = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
$months_m = array("Janv","Fév","Mars","Avr","Mai","Juin","Juil","Aoû","Sept","Oct","Nov","Déc");
$wkDays = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
$wkDays_l = array("Dim","Lun","Mar","Mer","Jeu","Ven","Sam","Dim");
$wkDays_m = array("Di","Lu","Ma","Me","Je","Ve","Sa","Di");
$wkDays_s = array("D","L","M","m","J","V","S","D");


/* -- User Interface texts -- */

$xx = array(

//general
"submit" => "Soumettre",
"none" => "Aucun.",
"back" => "Retour",
"by" => "par",
"of" => "de",
"done" => "Terminé",
"at_time" => "à", //date and time separator (e.g. 10-04-2016 @ 10:45)
"no_way" => "Vous n’êtes pas autorisé à exécuter cette action",

//index.php
"title_log_in" => "Connexion",
"title_upcoming" => "Prochains événements",
"title_event" => "Événement",
"title_add_event" => "Ajouter un Événement",
"title_check_event" => "Cocher l’Événement",
"title_search" => "Rechercher du texte",
"title_user_guide" => "Guide de l'utilisateur",
"title_settings" => "Gestion des paramètres",
"title_edit_cats" => "Gestion des catégories",
"title_edit_users" => "Gestion des utilisateurs",
"title_edit_groups" => "Edit User Groups",
"title_manage_db" => "Gérer la base de données",
"title_changes" => "Événements Ajoutés / Modifiés / Supprimés",
"title_csv_import" => "Importer un fichier CSV",
"title_ics_import" => "Importer un fichier iCalendar",
"title_ics_export" => "Exporter un fichier iCalendar",
"idx_public_name" => "Accès Public",

//header.php
"hdr_button_back" => "Retour sur la page parent",
"hdr_button_options" => "Options",
"hdr_options_submit" => "Faites votre choix puis appuyer sur “Terminé”",
"hdr_options_panel" => "Menu Options",
"hdr_select_date" => "Aller à la date",
"hdr_calendar" => "Calendrier",
"hdr_view" => "Vue",
"hdr_lang" => "Langue",
"hdr_all_cats" => "Catégories : Toutes",
"hdr_all_groups" => "All Groups",
"hdr_all_users" => "Utilisateurs : Tous",
"hdr_year" => "Année",
"hdr_month_full" => "Mois (7j)",
"hdr_month_work" => "Mois de travail ",
"hdr_week_full" => "Semaine (7j)",
"hdr_week_work" => "Semaine de travail",
"hdr_day" => "Jour",
"hdr_upcoming" => "A venir",
"hdr_changes" => "Modifications",
"hdr_select_admin_functions" => "Choisir une fonction Administrateur",
"hdr_admin" => "Administration",
"hdr_settings" => "Paramètres",
"hdr_categories" => "Catégories",
"hdr_users" => "Utilisateurs",
"hdr_groups" => "User groups",
"hdr_database" => "Base de données",
"hdr_import_csv" => "Import CSV",
"hdr_import_ics" => "Import iCal",
"hdr_export_ics" => "Export iCal",
"hdr_back_to_cal" => "Retour sur la vue Calendrier",
"hdr_button_print" => "Imprimer",
"hdr_print_page" => "Imprimez cette page",
"hdr_button_toap" => "Approve",
"hdr_toap_list" => "Events to be approved",
"hdr_button_todo" => "A faire",
"hdr_todo_list" => "Liste des “à faire”",
"hdr_button_upco" => "Prochains",
"hdr_upco_list" => "Prochains événements",
"hdr_button_search" => "Rechercher",
"hdr_search" => "Rechercher texte",
"hdr_button_add" => "Ajouter",
"hdr_add_event" => "Ajouter un événement",
"hdr_button_help" => "Aide",
"hdr_help" => "Manuel d’utilisation",
"hdr_log_in" => "Connexion",
"hdr_button_log_in" => "Connexion",
"hdr_button_log_out" => "Déconnexion",
"hdr_today" => "Aujourd’hui", //dtpicker.js
"hdr_clear" => "Effacer", //dtpicker.js

//event.php
"evt_no_title" => "Titre manquant",
"evt_no_start_date" => "Date de début manquante",
"evt_bad_date" => "Mauvaise date",
"evt_bad_rdate" => "Mauvaise date de fin de répétition",
"evt_no_start_time" => "Heure du début manquante",
"evt_bad_time" => "Mauvaise heure",
"evt_end_before_start_time" => "Heure de fin précède heure de début",
"evt_end_before_start_date" => "Date de fin précède date de début",
"evt_until_before_start_date" => "Fin de répétition précède date de début",
"evt_no_recur_if_overlay" => "Categorie with overlap check; recurring events not allowed",
"evt_private_no_ovl_check" => "Categorie with overlap check; no check for private events",
"evt_approved" => "événement approuvé",
"evt_apd_locked" => "événement approuvé et verrouillé",
"evt_title" => "Titre",
"evt_venue" => "Lieu",
"evt_category" => "Catégorie",
"evt_description" => "Description",
"evt_date_time" => "Date / heure",
"evt_mailer" => "notification",
"evt_private" => "Privé",
"evt_start_date" => "Date début",
"evt_end_date" => "Date fin",
"evt_select_date" => "Choisir la date",
"evt_select_time" => "Choisir l’heure",
"evt_all_day" => "Journée entière",
"evt_change" => "Modifier",
"evt_set_repeat" => "Périodicité",
"evt_set" => "OK",
"evt_help" => "aide",
"evt_repeat_not_supported" => "Périodicité non supportée",
"evt_no_repeat" => "Périodicité&nbsp;: néant",
"evt_repeat_on" => "Répéter tous les",
"evt_until" => "jusqu’au",
"evt_blank_no_end" => "vide: illimité",
"evt_each_month" => "tous les mois",
"evt_interval2_1" => "premiers",
"evt_interval2_2" => "deuxièmes",
"evt_interval2_3" => "troisièmes",
"evt_interval2_4" => "quatrièmes",
"evt_interval2_5" => "derniers",
"evt_period1_1" => "jours",
"evt_period1_2" => "semaines",
"evt_period1_3" => "mois",
"evt_period1_4" => "ans",
"evt_rpt_value_invalid" => "Repetition value invalid",
"evt_notify" => "Notification",
"evt_now_and_or" => "maintenant et/ou",
"evt_event_added" => "Événement ajouté",
"evt_event_edited" => "Événement modifié",
"evt_event_deleted" => "Événement supprimé",
"evt_days_before_event" => " jour(s) avant l'événement à :",
"evt_mail_help" => "Les rappels par mail peuvent être envoyés directement - maintenant - ou un nombre spécifié de jours avant le début de l’événement. Dans le champ ci-dessous, on peut spécifier des adresses email de destinataires et/ou des noms de fichiers contenant des adresse email de destinataires. Chaque addresse ou nom de fichier doit être séparé par un point-virgule. Longueur du champ : 255 caractères maxi. Les fichiers d’adresses avec une adresse par ligne doivent se trouver dans le dossier “emlists”.<br>En cas d’omission, l’extension par défaut d’un fichier d’adresses est .txt.",
"evt_eml_list_too_long" => "La liste des adresses email a trop de caractère.",
"evt_eml_list_missing" => "Adresse(s) email manquante(s)",
"evt_not_in_past" => "Date de notification dépassée",
"evt_not_days_invalid" => "Jour de notification invalide",
"evt_status" => "Statut",
"evt_descr_help" => "On peut utiliser les éléments suivants dans le champ Description&nbsp;:<br>• Les balises HTML &lt;b&gt;, &lt;i&gt;, &lt;u&gt; et &lt;s&gt; pour du texte en gras, italique, souligné et barré.<br>• de petites images (vignettes) au format suivant&nbsp;: dossier/nom_d_image.ext ou nom_d_image.ext. En cas d’omission, le dossier par défaut est “thumbnails”. Le dossier doit être un sous-dossier du calendrier et l’extension doit être .gif, .jpg ou .png. Les fichier vignettes (images) sont à télécharger par FTP.<br>• des liens URL au format suivant&nbsp;: url ou url [nom], dans lequel “nom” sera le titre du lien. Par exemple, www.google.com [recherche].<br>Les liens URL peuvent aussi s’utiliser dans les champs supplémentaires s’il y en a.",
"evt_confirm_added" => "événement ajouté",
"evt_confirm_saved" => "événement enregistré",
"evt_confirm_deleted" => "événement supprimé",
"evt_add_close" => "Ajouter et fermer",
"evt_add" => "Ajouter",
"evt_edit" => "Modifier",
"evt_save_close" => "Enregistrer et fermer",
"evt_save" => "Enregistrer",
"evt_clone" => "Dupliquer",
"evt_delete" => "Supprimer",
"evt_close" => "Fermer",
"evt_open_calendar" => "Ouvrir calendrier",
"evt_added" => "Ajouté",
"evt_edited" => "Edité",
"evt_is_repeating" => "est un événement répété.",
"evt_is_multiday" => "est un événement multi-jours.",
"evt_edit_series_or_occurrence" => "Voulez-vous éditer la série ou cette occurrence ?",
"evt_edit_series" => "Editer la série",
"evt_edit_occurrence" => "Editer l’occurrence",

//views
"vws_add_event" => "Ajout de nouvel événement",
"vws_view_month" => "Vue Mois",
"vws_view_week" => "Vue Semaine",
"vws_view_day" => "Vue Jour",
"vws_click_for_full" => "Cliquer sur le mois pour afficher le calendrier",
"vws_view_full" => "Voir le calendrier complet",
"vws_prev_month" => "Mois précédent",
"vws_next_month" => "Mois suivant",
"vws_today" => "Aujourd’hui",
"vws_back_to_today" => "Retour au mois courant",
"vws_week" => "Semaine",
"vws_wk" => "Sem",
"vws_time" => "Heure",
"vws_events" => "Événements",
"vws_all_day" => "Journée entière",
"vws_earlier" => "Plus tôt",
"vws_later" => "Plus tard",
"vws_venue" => "Lieu",
"vws_events_for_next" => "Événements pour les prochains",
"vws_days" => "jours",
"vws_added" => "Ajouté",
"vws_edited" => "Modifié",
"vws_notify" => "Envoi d’une notification",
"vws_check_mark" => "Check mark",
"vws_none_due_in" => "Pas d’événements pour les prochains",
"vws_download" => "Télécharger",
"vws_download_title" => "Télécharger un fichier texte avec ces événements",

//changes.php
"chg_from_date" => "A partir de",
"chg_select_date" => "Choisir date de début",
"chg_notify" => "Notification",
"chg_days" => "jour(s)",
"chg_added" => "Ajouté",
"chg_edited" => "Modifié",
"chg_deleted" => "Supprimé",
"chg_changed_on" => "Modifié le",
"chg_changes" => "Modifications",
"chg_no_changes" => "Aucune modification.",

//search.php
"sch_define_search" => "Texte à rechercher",
"sch_search_text" => "Rechercher texte",
"sch_event_fields" => "Champs de l'événement",
"sch_all_fields" => "Tous les champs",
"sch_title" => "Titre",
"sch_description" => "Description",
"sch_venue" => "Lieu",
"sch_user_group" => "User group",
"sch_event_cat" => "Catégorie de l'événement",
"sch_all_groups" => "All Groups",
"sch_all_cats" => "Toutes les catégories",
"sch_occurring_between" => "Occurrence entre",
"sch_select_start_date" => "Sélectionner la date de début",
"sch_select_end_date" => "Sélectionner la date de fin",
"sch_search" => "Recherche",
"sch_invalid_search_text" => "Texte à rechercher invalide ou trop court",
"sch_bad_start_date" => "Mauvaise date de début",
"sch_bad_end_date" => "Mauvaise date de fin",
"sch_no_results" => "Pas de résultat pour la recherche",
"sch_new_search" => "Nouvelle recherche",
"sch_calendar" => "Retour au calendrier",
"sch_extra_field1" => "Champ supplé- mentaire 1",
"sch_extra_field2" => "Champ supplé- mentaire 2",
"sch_instructions" =>
"<h4>Instructions pour rechercher du texte</h4>
<p>La base de données du calendrier peut être utilisée pour rechercher un texte spécifique.</p>
<br><p><b>Rechercher du texte&nbsp;:</b> Le texte sera recherché dans tous les champs sélectionnés
(voir ci-dessous). La recherche est insensible à la casse (majuscules ou miniscules).</p>
<p>Deux caractères spéciaux peuvent être utilisés&nbsp;:</p>
<ul>
<li>Le caractère Soulignement (_) permet de remplacer un ou deux caractère(s) dans le texte à rechercher.
Le résultat comportera le nombre de lettres exact dans le texte avec des nuances en fonction de l’emplacement
du (_).<br>
Ex.&nbsp;: “_e_t” enverra le résultat “vert”, “cent”, “peut”.</li>
<li>Le caractère “et commercial” (&amp;) permet de remplacer une série de caractère dans le texte.<br>
Ex.: 'dé&amp;r' enverra le résultat “Décembre”, “dépendre”, “développer”.</li>
</ul>
<p>A blank search text field, or just an ampersand, will match any text and therefore all events.</p>
<br><p><b>Champs de l'événement&nbsp;:</b>La recherche s’effectue uniquement dans les champs sélectionnés.</p>
<br><p><b>Catégorie de l'événement&nbsp;:</b>La recherche s'effectue uniquement sur la catégorie sélectionnée.</p>
<br><p><b>Occurrence entre&nbsp;:</b>La date de début et la date de fin sont facultatives. Si la date de début est vide,
la recherche s'effectuera sur un an précédant la date du jour. Si la date de fin est vide, la recherche s'effectuera
sur un an après la date du jour.</p>
<br><p>L'affichage du résultat de la recherche sera en ordre chronologique.</p>",

//stand-alone sidebar (lcsbar.php)
"ssb_upco_events" => "Prochains événements",
"ssb_all_day" => "Journée entière",
"ssb_none" => "Pas d'événements."
);
?>
