INSERT INTO csm_article (date_event, img_event, title, intro, description) VALUES
('2025-03-03', 'assets/images/articles/art-03-03-25bis.jpeg', 'Stage de Jujitsu Fighting organisé par le CSM Fight Team.', 'Eum nam excepturi exercitationem eos sapiente illum fuga amet.', 'Description de l\'article Eum nam excepturi exercitationem eos sapiente illum fuga amet.'),
('2025-03-03', 'assets/images/articles/art-03-03-25.jpeg', 'Le CSM Fight Team présent à l\'animation de Cabannes', 'Le samedi 1 er Mars avait lieu l\'animation de judo et jujitsu à Cabannes organisé par un club ami, le GOKAN. Nous avions 5 présents :', 'Description de l\'article Eum nam excepturi exercitationem eos sapiente illum fuga amet.'),
('2025-02-26', 'assets/images/articles/art-26-02-25.jpeg', 'Le CSM Fight team au championnat de France cadet et junior à Villebon sur Yvette', 'Le week end dernier (le 22 et 23 février) a eu lieu le Championnat de France cadet et junior à Villebon sur Yvette.', 'Description de l\'article Eum nam excepturi exercitationem eos sapiente illum fuga amet.'),
('2025-02-16', 'assets/images/articles/art-16-02-25.jpeg', 'Un stage sportif avec le sourire', 'Lors de cette première semaine de vacances, le CSM Fight Team a organisé un stage sportif pour ces adhérents. Au programme, du judo, du jujitsu, du basket, de l\'athlétisme et notre sortie du mercredi après midi, le cinéma !', 'Description de l\'article Eum nam excepturi exercitationem eos sapiente illum fuga amet.'),
('2025-02-04', 'assets/images/articles/art-04-02-25.jpeg', 'Stage jujitsu organisé par le CSM Fight Team', 'Ce dimanche 2 Février a eu lieu le 1er stage jujitsu organisé par le CSM Fight Team. Ce stage est une préparation pour le championnat de France Jujitsu Fighting cadet et Junior qui aura lieu le samedi 22 et dimanche 23 février prochain.', 'Description de l\'article Eum nam excepturi exercitationem eos sapiente illum fuga amet.'),
('2025-01-28', 'assets/images/articles/art-28-01-25.jpeg', 'Le CSM Fight Team à Vitrolles', 'Ce week end avait lieu deux compétitions à Vitrolles.', 'Description de l\'article Eum nam excepturi exercitationem eos sapiente illum fuga amet.'),
('2024-12-17', 'assets/images/articles/art-17-12-24.jpeg', 'Le CSM Fight Team à la coupe de Noël', 'Ce week end a eu lieu la traditionnelle coupe de Noël organisée par le club d\'Ensues. Pas moins de 15 jujitsukas du CSM ont répondu présent pour combattre ! Les résultats :', 'Description de l\'article CEum nam excepturi exercitationem eos sapiente illum fuga amet.'),
('2024-11-21', 'assets/images/articles/art-21-11-24.jpeg', 'Le CSM Fight Team représenté lors de la journée Pro League', 'Le mardi 12 novembre a eu lieu une journée de le Judo Pro League à Venelles.', 'Description de l\'article Eum nam excepturi exercitationem eos sapiente illum fuga amet.'),
('2024-10-26', 'assets/images/articles/art-26-10-24.jpeg', 'Un stage de la Toussaint au CSM Fight Team', 'Pas moins d\'une vingtaine de jeunes licenciés ont participés et se sont amusés au travers des différentes activités proposées.', 'Description de l\'article Eum nam excepturi exercitationem eos sapiente illum fuga amet.'),
('2024-10-07', 'assets/images/articles/art-07-10-24.jpeg', 'Le CSM en nombre au stage d\'arbitrage du département', 'Ce samedi s\'est tenu le stage départemental d\'arbitrage organisé par le comité 13 au CREPS d\'Aix. Il s\'est tenu de 9h à 12h.', 'Description de l\'article Eum nam excepturi exercitationem eos sapiente illum fuga amet.'),
('2024-09-16', 'assets/images/articles/art-16-09-24.jpeg', 'Le CSM présent en nombre au stage régional d\'arbitrage jujitsu', 'Le CSM présent en nombre avec pas moins de 8 adhérents au stage régional d\'arbitrage jujitsu.', 'Description de l\'article Eum nam excepturi exercitationem eos sapiente illum fuga amet.');

$_SESSION['user_id'] = $users['id'];

-------------------------
-- Insertion des tags

INSERT INTO csm_tag (tag) VALUES ("arbitrage"), ("competition"), ("judo"), ("jujitsu"), ("stage");

------------------------
-- insertion des tags associés aux articles deja inserés
INSERT INTO csm_article_tag (id_article, id_tag) VALUES (1, 4), (1,5),(2,2),(2,3),(2,4),(3,2),(3,4),(4,3),(4,4),(4,5),(5,4),(5,5),(6,1),(6,2),(6,3),(7,1),(7,4),(8,1),(8,3),(9,3),(9,4),(9,5),(10,1),(10,3),(10,5),(11,1),(11,4),(11,5);