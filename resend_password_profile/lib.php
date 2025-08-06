<?php
defined('MOODLE_INTERNAL') || die();

function local_resend_password_profile_myprofile_navigation($tree, $user, $iscurrentuser, $course) {
    // Crée une nouvelle catégorie dans le profil utilisateur.
    $category = new core_user\output\myprofile\category('mycustomcategory', get_string('mycustomcategory', 'local_resend_password_profile'), null);

    // Crée le formulaire avec le bouton
    $buttonhtml = '
        <form action="' . new moodle_url('/local/resend_password_profile/resend_email.php') . '" method="post">
            <input type="hidden" name="userid" value="' . $user->id . '">
            <button type="submit" class="btn btn-primary">Renvoyer</button>
        </form>';

    // Crée un nouveau nœud avec le bouton HTML.
    $node = new core_user\output\myprofile\node('mycustomcategory', 'buttonnode', $buttonhtml, null, null);

    // Ajoute le nœud à la catégorie.
    $category->add_node($node);

    // Ajoute la catégorie au profil.
    $tree->add_category($category);
}
