<?php

return [
    'mailing-settings' => [
        'title' => 'Réglages Mailing',
        'navigation_title' => 'Réglages Mailing',
        'form' => [
            'label' => [
                'provider' => 'Service d\'emailing',
                'api_key' => 'Clé API',
                'api_secret' => 'Clé API secrète',
                'list_id_main' => 'ID de la liste principale (défaut)',
                'subscription_newsletter' => 'Afficher l\'inscription à la newsletter dans le formulaire (champs Toggle)',
                'token_expiration_days' => 'Durée de validité du lien (en jours)',
                'list_id_newsletter' => 'ID de la liste newsletter',
                'mail_from_address' => 'Email de l\'expéditeur',
                'mail_from_name' => 'Nom de l\'expéditeur',
                'template_id_confirm_mail' => 'ID du modèle d\'email de confirmation',
                'btn_active' => 'Afficher le bouton',
                'btn_outlined' => 'Style contour (outline)',
                'btn_label' => 'Texte (label)',
                'btn_url' => 'Adresse URL',
                'btn_color' => 'Couleur',
                'text_confirmed' => [
                    'content' => 'Message après inscription à la newsletter',
                ],
                'text_newsletter_form' => [
                    'title' => 'Titre de la page',
                    'content' => 'Texte de présentation',
                    'submitted' => 'Message de confirmation',
                    'consent' => 'Texte de consentement RGPD',
                ],
                'fieldsets' => [
                    'buttons' => [
                        'label' => 'Boutons',
                        'submit' => 'Bouton Principal (submit)',
                        'secondary' => 'Bouton Secondaire',
                    ],
                ],
            ],
            'helper' => [
                'list_id_newsletter' => 'Identifiant de la liste dans votre service d\'emailing',
                'token_expiration_days' => 'Durée pendant laquelle l\'utilisateur peut confirmer son inscription',
                'template_id_confirm_mail' => 'Template utilisé pour l\'email de double opt-in',
                'btn_url' => 'Page vers laquelle l\'utilisateur est redirigé',
                'text_newsletter_form' => [
                    'content' => 'Affiché au-dessus du formulaire d\'inscription',
                    'submitted' => 'Affiché après une inscription réussie',
                    'consent' => 'Texte affiché sous le formulaire pour le consentement utilisateur',
                ],
            ],
            'tabs' => [
                'general' => 'Général',
                'newsletter' => 'Inscription Newsletter',
                'subscription_page' => 'Page d\'inscription',
            ],
            'blocks' => [
                'button' => 'Bouton',
                'button_heading' => 'Insérer un bouton',
                'button_label' => 'Texte du bouton',
                'button_url' => 'URL',
                'button_color' => 'Couleur',
                'button_outlined' => 'Style encadré ?',
                'button_align' => 'Alignement',
                'align_left' => 'Gauche',
                'align_center' => 'Centre',
                'align_right' => 'Droite',
                'button_default_label' => 'Cliquez ici',
            ],
        ],
    ],

    'pending-subscriber' => [
        'singular' => 'Demande d\'inscription à la newsletter',
        'plural' => 'Demandes d\'inscription à la newsletter',

        'pages' => [
            'list' => [
                'title' => 'Liste des demandes d\'inscription à la newsletter',
            ],
        ],

        'table' => [
            'empty_state' => [
                'heading' => 'Aucune inscription',
                'description' => '',
            ],
            'label' => [
                'email' => 'Email',
                'firstname' => 'Prénom',
                'name' => 'Nom',
                'confirmed_at' => 'Statut',
                'created_at' => 'Etat du Token',
            ],
            'states' => [
                'pending' => 'En attente',
                'confirmed' => 'Confirmé',
                'expired' => 'Expiré',
                'valid' => 'Valide',
            ],
            'filter' => [
                'pending' => 'En attente',
                'confirmed' => 'Confirmés',
            ],
        ],

        'actions' => [
            'resend' => [
                'label' => [
                    'button' => 'Renvoyer l\'email',
                ],
                'notification' => [
                    'success' => 'Email de confirmation envoyé avec succès',
                    'fail' => [
                        'title' => 'Une erreur s\'est produite avec l\'API',
                        'body' => 'Impossible d\'envoyer l\'email de confirmation',
                    ],
                ],
            ],
            'confirm' => [
                'label' => [
                    'button' => 'Forcer la confirmation',
                ],
                'notification' => [
                    'success' => 'Adresse email confirmée et ajoutée à la liste d\'emailing avec succès',
                    'warning' => 'L\'adresse email a déjà été confirmée',
                    'fail' => [
                        'api' => [
                            'title' => 'Une erreur s\'est produite avec l\'API',
                            'body' => 'Le provider d\'emailing ne répond pas',
                        ],
                        'general' => [
                            'title' => 'Une erreur s\'est produite',
                            'body' => 'Impossible de confirmer cette adresse email',
                        ],
                    ],
                ],
            ],

            'delete' => [
                'modal' => [
                    'heading' => 'Supprimer l\'adresse email :email des demandes d\'inscription',
                    'description' => 'Êtes-vous sûr de vouloir faire cela ?',
                ],
                'label' => [
                    'button' => 'Supprimer',
                ],
            ],
        ],
    ],

    'subscription_newsletter' => [
        'form' => [
            'section' => [
                'heading' => 'Bientot',
                'description' => 'Bientot...',
            ],
            'label' => [
                'name' => 'Nom',
                'firstname' => 'Prénom',
                'email' => 'Adresse email',
                'phone' => 'Téléphone',
                'postal_code' => 'Code postal',
                'city' => 'Ville',
                'consent' => 'Consentement',
            ],
            'placeholder' => [
                'name' => 'Dupond',
                'firstname' => 'Marc',
                'email' => 'd.marc@orange.fr',
                'phone' => '06 12 34 56 78',
                'postal_code' => '75001',
                'city' => 'Paris',
                'consent' => 'J\'accepte les conditions d\'inscription',
            ],
            'actions' => [
                'submit' => 'S\'inscrire',
                'back' => 'Retour',
            ],
        ],
    ],

    'subscription_newsletter_toggle' => [
        'label' => 'Je m\'abonne à la newsletter',
    ],

    'confirm_subscription_page' => [
        'confirmed' => [
            'title' => 'Votre inscription à la newsletter a bien été prise en compte',
        ],
        'already_confirmed' => [
            'title' => 'Adresse email déjà confirmée',
            'content' => 'Votre inscription à la newsletter est déjà confirmée.
Vous recevrez prochainement nos actualités par email.',
        ],
        'token_expired' => [
            'title' => 'Lien de confirmation expiré',
            'content' => 'Ce lien de confirmation n\'est plus valide.
Pour finaliser votre inscription, merci de renouveller votre demande via le formulaire d\'inscription.',
        ],
        'api_error' => [
            'title' => 'Une erreur est survenue',
            'content' => 'Une erreur technique est survenue lors de la validation de votre inscription.
Veuillez réessayer dans quelques instants. Si le problème persiste, contactez-nous.',
        ],
        'any_error' => [
            'title' => 'Impossible de confirmer votre inscription',
            'content' => 'Nous n\'avons pas pu finaliser votre inscription à la newsletter.
Merci de réessayer ou de nous contacter si le problème persiste.',
        ],
    ],
];
