INSERT INTO `auteur` (`photo_auteur`, `nom`, `prenom`, `date_de_naissance`, `date_de_mort`, `nationalite`, `biographie`) VALUES
('default.jpg', 'NomAuteur1', 'PrenomAuteur1', '2000-12-03', '2023-10-15', 'Français', 'Biographie très cool'),
('default.jpg', NULL, 'PrenomAuteur2', NULL, NULL, NULL, NULL),
('default.jpg', 'Movie', 'Bee', '1998-07-08', NULL, 'Espagnol', 'Selon toutes les lois connues de l''aviation, il n''existe aucun moyen une abeille devrait être capable de voler. Ses ailes sont trop petites pour que son gros corps disparaisse. L''abeille bien sûr, vole de toute façon parce que les abeilles ne se soucient pas ce que les humains pensent est impossible. Jaune, noir. Jaune, noir. Jaune, noir. Ooh, noir et jaune! Secouons-le un peu. Barry! Le petit déjeuner est prêt! Ooming! Attends une seconde. Bonjour? Barry? -Adam? Pouvez-vous croire que cela se passe? - Je ne peux pas. Je te récupérerai. Regarder précisément. Utilisez les escaliers. Votre père a payé de l''argent pour ceux-là. Pardon. Je suis surexcité. Voici le diplômé. Nous sommes très fiers de toi, mon fils. Une carte de rapport parfaite, tous les B''s. Très fier. Ma! J''ai une chose qui se passe ici. - Tu as de la peluche sur ton peluche. Ow! C''est moi! - Viens nous voir! Nous serons dans la rangée 118,00. -Au revoir! Barry, je t''ai dit d''arrêter de voler dans la maison! -Hey Adam. -Hey Barry. - C''est du gel? -Un peu. Journée spéciale, graduation. Jamais pensé que je le ferais. 3 jours d''école primaire, 3 jours d''école secondaire. C''était maladroit. 3 jours collège. Je suis content d''avoir pris une journée et fait de l''auto-stop dans la ruche. Vous êtes revenu autrement. -Hi Barry. -Artie, en train de pousser une moustache? Cela semble bon. - Pourquoi Frankie? -Ouais. - Tu vas aux funérailles? - Non, je ne vais pas. Tout le monde sait, piquer quelqu''un, vous mourez. Ne le perdez pas sur un écureuil. Une telle tête brûlante. Je suppose qu''il aurait pu juste sortir de la route. J''adore cette incorporation d''un parc d''attractions dans notre journée. C''est pourquoi nous n''avons pas besoin de vacances. Garçon, assez pompeux ... dans les circonstances. -Bien Adam, aujourd''hui nous sommes des hommes. -Nous sommes! -Bee-hommes. -Amen! Alléluia! Étudiants, professeurs, abeilles distinguées, s''il vous plaît la bienvenue Dean Buzzwell. Bienvenue, New Hive City diplômé classe de ... ... 9: 15. Cela conclut nos cérémonies. Et commence votre carrière chez Honex Industries! Choisirons-nous notre travail aujourd''hui? J''ai entendu dire que c''était juste une orientation. La tête haute! Et c''est parti. Gardez vos mains et antennes à l''intérieur du tramway et en tout temps. - Qu''il sera comme ça? -Un peu effrayant. Bienvenue chez Honex, une division de Honesco et une partie du groupe Hexagon. C''est ça! Sensationnel. Sensationnel. Nous savons que vous, comme une abeille, avez travaillé toute votre vie pour arriver au point où vous pouvez travailler pour toute votre vie. Le miel commence quand nos braves jumeaux de Pollen apportent le nectar à la ruche. Notre formule top secret est automatiquement corrigée de la couleur, parfum ajustée et bulle-contourné dans ce sirop doux apaisant avec sa lueur dorée distinctive que vous connaissez comme ... miel! - Cette fille était chaude. -C''est ma cousine! -Elle est? - Oui, nous sommes tous cousins. -Droite. Tu as raison. -A Honex nous nous efforçons constamment d''améliorer tous les aspects de l''existence de l''abeille. Ces abeilles testent une nouvelle technologie de casque. - Que pensez-vous qu''il fait? - Pas assez - Voici notre dernier avancement, le Krelman. - Qu''est-ce que ça fait? -Patches ce petit brin de miel qui pend après vous le verser. Nous sauve des millions. Quelqu''un peut-il travailler sur le Krelman? Bien sûr. La plupart des emplois d''abeilles sont de petite taille. Mais les abeilles savent que chaque petit travail, s''il est bien fait, signifie beaucoup. Mais choisissez attentivement parce que vous restez dans le travail que vous choisissez pour le reste de votre vie. Le même travail pour le reste de votre vie? Je ne le savais pas. Quelle est la différence? Vous serez heureux de savoir que les abeilles, en tant qu''espèce, n''ont pas eu un jour de congé en 27 millions d''années. Alors tu vas travailler avec nous ŕ mort? Nous allons essayer. Hou la la! Qui a soufflé mon esprit! ""Quelle est la différence?"" Comment peux-tu dire ça? Un emploi pour toujours? C''est un choix fou d''avoir à faire. Je suis soulagé. Maintenant, nous n''avons qu''à prendre une décision dans la vie. Mais, Adam, comment n''auraient-ils jamais pu nous le dire? Pourquoi ne poseriez-vous aucune question? Nous sommes des abeilles. Nous sommes la société la plus parfaitement en fonction sur la terre. '),
('Lemony_Snicket.png', 'Snicket', 'Lemony', NULL, NULL, 'Américain', 'Ici, le monde est paisible.'),
('baudelaire.jpg', 'Baudelaire', 'Charles', '1821-04-09', '1867-08-31', 'Français', ''),
('default.jpg', 'Masashi', 'Kishimoto', NULL, NULL, 'Japonais', ''),
('default.jpg', 'King', 'Stephen', NULL, NULL, 'Américain', '');

INSERT INTO `genre` (`libelle`) VALUES
('Romance'),
('Horreur'),
('Comédie'),
('Fantaisie'),
('Thriller'),
('Poésie'),
('Historique'),
('Action');

INSERT INTO `editeur` (`nom_editeur`, `date_creation`) VALUES
('NomEditeur1', '2012-05-05'),
('NomEditeur2', NULL),
('NomEditeur3', '2005-02-01'),
('Nathan Jeunesse', '1881-01-01'),
('Editions Tanos', NULL),
('Shueisha', NULL),
('Le Livre de Poche', NULL);

INSERT INTO `livre` (`id_genre_id`, `id_editeur_id`, `couverture`, `titre`, `nb_pages`, `valide`, `maj_couverture`) VALUES
(1, 1, 'default.jpg', 'TitreLivre1', 5, 1, NULL),
(2, 3, 'default.jpg', 'TitreLivre2', 265, 1, NULL),
(3, 3, 'default.jpg', 'TitreLivre3', 204, 0, NULL),
(3, 4, 'les-desastreuses-aventures-des-orphelins-baudelaire-tome-1-tout-commence-mal.jpg', 'Les désastreuses aventures des orphelins Baudelaire - Tome 1', 176, 1, NULL),
(6, 5, 'fleurs_du_mal.jpg', 'Les fleurs du mal', 170, 1, NULL),
(8, 6, 'naruto.jpg', 'Naruto - Tome 1', 187, 1, NULL),
(2, 7, 'shining.jpg', 'Shining', 576, 1, NULL);

INSERT INTO `livre_auteur` (`auteur_id`, `livre_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7);

#UtilisateurTest, mdp : motdepasse
#Admin, mdp : motdepasse
#Ils ont tous le mdp : motdepasse
INSERT INTO `utilisateur` (`pseudo`, `roles`, `password`, `id_auteur_id`, `photo_profil`, `mail`, `is_verified`) VALUES
('UtilisateurTest', '["ROLE_USER"]', '$2y$13$CFRlhsEojimxUfXVhL3oruu/sul8zxRyPiCGpbXTJ.8U0MbUg8fL.', NULL, 'default.jpg', 'adresse@mail.com', 0),
('Admin', '["ROLE_ADMIN"]', '$2y$13$CFRlhsEojimxUfXVhL3oruu/sul8zxRyPiCGpbXTJ.8U0MbUg8fL.', NULL, 'chat.jpg', 'leguayemerance@outlook.fr', 1),
('Owen', '["ROLE_USER"]', '$2y$13$Y0N.O/JMge87siwbHm/19uz5YyqQRALSn2gVx9eImdf.0AetS/naK', NULL, 'owen.png', 'owen@adressemail.com', 0),
('LecteurMéprisant', '["ROLE_USER"]', '$2y$13$NI/IMtvJkTEfE7Lr2Y0I5.F4VHpVFmGJOCeTL29lE3eGPJcXLPH.S', NULL, 'mepris.jpg', 'mailTest@gmail.com', 0);

INSERT INTO `critique` (`id_utilisateur_id`, `id_livre_id`, `note`, `commentaire`) VALUES
(1, 5, 2, 'Un classique de littérature française.'),
(2, 4, 5, 'Le tome 1 de ma série de livres préférée. Un style d''écriture très original, et une histoire promettant de nombreux mystères et une série d''évènements désastreux'),
(4, 1, 1, 'Peut mieux faire.'),
(4, 4, 2, 'Qui ferait lire ça à ses enfants ?'),
(4, 6, 4, 'Bien.');

INSERT INTO `liste` (`id_utilisateur_id`, `nom_liste`) VALUES
(2, 'Favoris'),
(2, 'A lire'),
(4, 'A critiquer'),
(1, 'Lecture du dimanche'),
(1, 'Monde fantastique'),
(1, 'Inspiration');

INSERT INTO `liste_livre` (`liste_id`, `livre_id`) VALUES
(1, 4),
(1, 5),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5);

INSERT INTO `demandes_contact` (`mail`, `nom`, `objet_demande`, `message`) VALUES
('addressemail@mail.com', 'Géraldine', 'Devenir auteur', 'Bonjour, je vous contacte car je souhaiterais posséder le statut d''auteur.');