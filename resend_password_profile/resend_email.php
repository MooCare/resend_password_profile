<?php
require_once(__DIR__ . '/../../config.php'); // Charger la configuration Moodle
require_once($CFG->libdir . '/moodlelib.php'); // Inclure les bibliothèques nécessaires
require_once($CFG->libdir . '/authlib.php'); // Inclure les bibliothèques d'authentification

require_login(); // Vérifier que l'utilisateur est connecté
require_capability('moodle/user:create', context_system::instance()); // Vérifier les permissions

// Configuration de la page
$PAGE->set_url('/local/resend_password_profile/resend_email.php');
$PAGE->set_context(context_system::instance());

// Récupérer l'ID de l'utilisateur à qui envoyer l'email
$userid = required_param('userid', PARAM_INT);

// Charger les informations de l'utilisateur
$user = $DB->get_record('user', array('id' => $userid), '*', MUST_EXIST);

// Vérifier que l'utilisateur n'est pas supprimé
if ($user->deleted) {
    print_error('invaliduser'); // Affiche une erreur si l'utilisateur est supprimé
}

// Générer un nouveau mot de passe
$newpassword = generate_password(8); // Générer un mot de passe aléatoire de 8 caractères

// Hacher et mettre à jour le mot de passe de l'utilisateur
$hashedpassword = hash_internal_user_password($newpassword);
$DB->set_field('user', 'password', $hashedpassword, ['id' => $user->id]);

// Récupérer le nom complet du site
$sitename = format_string($SITE->fullname);

// Créer le contenu de l'email avec le nom d'utilisateur
$subject = "Votre nouveau compte sur {$sitename}";
$message = "
Bonjour {$user->firstname} {$user->lastname},

Un nouveau compte a été créé pour vous sur le site « {$sitename} » et un mot de passe temporaire vous a été délivré.

Les informations nécessaires à votre connexion sont maintenant :
nom d’utilisateur : {$user->username}
mot de passe : {$newpassword}

Vous devrez changer votre mot de passe lors de votre première connexion.

Pour commencer à travailler sur « {$sitename} », veuillez vous connecter en cliquant sur le lien ci-dessous :
{$CFG->wwwroot}/login/?lang=fr

Dans la plupart des logiciels de courriel, cette adresse devrait apparaître comme un lien de couleur bleue qu’il vous suffit de cliquer. Si cela ne fonctionne pas, copiez ce lien et collez-le dans la barre d’adresse de votre navigateur web.

Si vous avez besoin d’aide, veuillez contacter l’administrateur du site « {$sitename} » en cliquant sur ce lien :
<a href='{$CFG->wwwroot}/user/contactsitesupport.php'>Contacter l’assistance du site</a>.

{$sitename}
";

// Envoyer l'email à l'utilisateur
if (email_to_user($user, get_admin(), $subject, $message)) {
    // Rediriger avec un message de succès si l'email est envoyé
    redirect(new moodle_url('/user/profile.php', ['id' => $userid]), get_string('emailresent', 'local_resend_password_profile'), 3);
} else {
    // Rediriger avec un message d'erreur si l'email n'est pas envoyé
    redirect(new moodle_url('/user/profile.php', ['id' => $userid]), get_string('emailnotresent', 'local_resend_password_profile'), 3);
}
