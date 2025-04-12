-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 12 avr. 2025 à 14:44
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mhwmaelunard`
--

-- --------------------------------------------------------

--
-- Structure de la table `armes_armures`
--

CREATE TABLE `armes_armures` (
	`ID_Arme_Armure` int(11) NOT NULL,
	`Nom` varchar(100) NOT NULL,
	`Type` varchar(50) NOT NULL,
	`Puissance` int(11) NOT NULL,
	`Defense` int(11) NOT NULL,
	`Niveau` int(11) NOT NULL,
	`ID_Monstre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `armes_armures`
--

INSERT INTO `armes_armures` (`ID_Arme_Armure`, `Nom`, `Type`, `Puissance`, `Defense`, `Niveau`, `ID_Monstre`) VALUES
(1, 'Rathalos Firesword', 'Épée longue', 210, 0, 5, 1),
(2, 'Rathalos Gunlance', 'Lancecanon', 190, 0, 5, 1),
(3, 'Armure Rathalos Alpha', 'Armure', 0, 58, 5, 1),
(4, 'Armure Rathalos Beta', 'Armure', 0, 54, 5, 1),
(5, 'Ruinous Eradicator', 'Épée longue', 300, 0, 8, 2),
(6, 'Destruction Vaal', 'Volto-hache', 320, 0, 8, 2),
(7, 'Armure Nergigante Alpha', 'Armure', 0, 76, 8, 2),
(8, 'Armure Nergigante Beta', 'Armure', 0, 70, 8, 2),
(9, 'Flame Lance Anja', 'Lance', 190, 0, 4, 3),
(10, 'Anja Boneblade', 'Grande épée', 200, 0, 4, 3),
(11, 'Armure Anjanath Alpha', 'Armure', 0, 42, 4, 3),
(12, 'Armure Anjanath Beta', 'Armure', 0, 39, 4, 3),
(13, 'Tigrex Jawblade', 'Grande épée', 260, 0, 7, 4),
(14, 'Tigrex Crusher', 'Marteau', 240, 0, 7, 4),
(15, 'Armure Tigrex Alpha', 'Armure', 0, 60, 7, 4),
(16, 'Armure Tigrex Beta', 'Armure', 0, 57, 7, 4),
(17, 'Bazel Bomber', 'Cor de chasse', 220, 0, 6, 5),
(18, 'Bazel Buster', 'Canon lourd', 230, 0, 6, 5),
(19, 'Armure Bazel Alpha', 'Armure', 0, 55, 6, 5),
(20, 'Armure Bazel Beta', 'Armure', 0, 52, 6, 5),
(21, 'Odogaron Duals', 'Lames doubles', 190, 0, 5, 6),
(22, 'Odogaron Spire', 'Fusarbalète léger', 180, 0, 5, 6),
(23, 'Armure Odogaron Alpha', 'Armure', 0, 50, 5, 6),
(24, 'Armure Odogaron Beta', 'Armure', 0, 47, 5, 6),
(25, 'Teostra Flamesword', 'Épée longue', 310, 0, 9, 7),
(26, 'Teostra Nova', 'Insectoglaive', 290, 0, 9, 7),
(27, 'Armure Teostra Alpha', 'Armure', 0, 80, 9, 7),
(28, 'Armure Teostra Beta', 'Armure', 0, 75, 9, 7),
(29, 'Kushala Blizzard', 'Lance', 280, 0, 9, 8),
(30, 'Daora’s Fang', 'Épée longue', 270, 0, 9, 8),
(31, 'Armure Kushala Alpha', 'Armure', 0, 78, 9, 8),
(32, 'Armure Kushala Beta', 'Armure', 0, 72, 9, 8),
(33, 'Deviljho Destructor', 'Marteau', 260, 0, 6, 9),
(34, 'Devil’s Fangblade', 'Épée longue', 250, 0, 6, 9),
(35, 'Armure Deviljho Alpha', 'Armure', 0, 63, 6, 9),
(36, 'Armure Deviljho Beta', 'Armure', 0, 60, 6, 9),
(37, 'Velkhana Frostblade', 'Épée longue', 310, 0, 9, 10),
(38, 'Velkhana Icicle', 'Volto-hache', 295, 0, 9, 10),
(39, 'Armure Velkhana Alpha', 'Armure', 0, 82, 9, 10),
(40, 'Armure Velkhana Beta', 'Armure', 0, 78, 9, 10);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
	`ID_Comm` int(11) NOT NULL,
	`Id_utilisateur` int(11) DEFAULT NULL,
	`Contenu_commentaire` text DEFAULT NULL,
	`ID_Monstre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`ID_Comm`, `Id_utilisateur`, `Contenu_commentaire`, `ID_Monstre`) VALUES
(1, 2, 'zerzre', 1);

-- --------------------------------------------------------

--
-- Structure de la table `lieux_vie`
--

CREATE TABLE `lieux_vie` (
	`ID_Lieu_vie` int(11) NOT NULL,
	`Nom_du_lieu` varchar(100) DEFAULT NULL,
	`Type_de_lieu` varchar(50) DEFAULT NULL,
	`Description` text DEFAULT NULL,
	`image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lieux_vie`
--

INSERT INTO `lieux_vie` (`ID_Lieu_vie`, `Nom_du_lieu`, `Type_de_lieu`, `Description`, `image`) VALUES
(1, 'Forêt Ancienne', 'Forêt tropicale', 'Un écosystème dense et varié avec une canopée luxuriante et de nombreux niveaux.', 'MHW-Ancient_Forest_Artwork_001.webp'),
(2, 'Desert des termites', 'Zone désertique et rocheuse', 'Un paysage rude mêlant déserts arides et canyons abrupts, habitat de nombreux monstres puissants.', 'MHW-Wildspire_Waste_Artwork_001.webp'),
(3, 'Val putride', 'Marais toxiques', 'Zone sombre et malsaine, couverte de brume toxique et de restes en décomposition.', 'MHW-Rotten_Vale_Screenshot_003.webp'),
(4, 'Dans toute les zone', 'Montagnes et plaines', 'Une vaste zone de reliefs escarpés et de champs ouverts, théâtre de batailles explosives.', 'carte-mhw.webp'),
(5, 'Terre des anciens', 'Sanctuaire ancien', 'Un ancien sanctuaire naturel où vivent les dragons anciens, enveloppé de mystères et de dangers.', 'MHW-Terre_des_anciens.webp'),
(6, 'Givre éternel', 'Terres gelées', 'Un paysage glacé, domaine du Velkhana, recouvert de pics enneigés et de glace éternelle.', 'MHW-Hoarfrost_Reach_Artwork_002.webp');

-- --------------------------------------------------------

--
-- Structure de la table `monstres`
--

CREATE TABLE `monstres` (
	`ID_Monstre` int(11) NOT NULL,
	`Nom_Monstre` varchar(100) NOT NULL,
	`Niveau` int(11) NOT NULL,
	`ID_Lieu_vie` int(11) NOT NULL,
	`Biographie` text NOT NULL,
	`Image_Monstre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `monstres`
--

INSERT INTO `monstres` (`ID_Monstre`, `Nom_Monstre`, `Niveau`, `ID_Lieu_vie`, `Biographie`, `Image_Monstre`) VALUES
(1, 'Rathalos', 5, 1, 'Roi des cieux, Rathalos règne sur la Forêt Ancienne. Il attaque férocement avec son souffle enflammé.', 'MHW-Rathalos_Icon.webp'),
(2, 'Nergigante', 8, 2, 'Dragon ancien brutal qui se régénère en se blessant lui-même. Nergigante est l’un des plus grands défis du jeu.', 'MHW-Nergigante_Icon.webp'),
(3, 'Anjanath', 4, 1, 'Prédateur dominant de la Forêt Ancienne, capable de cracher des flammes. Un vrai tyran territorial.', 'MHN-Anjanath.webp'),
(4, 'Tigrex', 7, 3, 'Féroce Wyverne volante aux rugissements assourdissants. Sa vitesse et sa force sont redoutables.', 'MHWI-Tigrex_Icon.webp'),
(5, 'Bazelgeuse', 6, 4, 'Appelé la \"bomber volante\", Bazelgeuse largue des écailles explosives sur ses proies.', 'MHW-Bazelgeuse_Icon.webp'),
(6, 'Odogaron', 5, 3, 'Prédateur agile et cruel des terres putrides. Capable d’infliger des hémorragies.', 'MHW-Odogaron_Icon.webp'),
(7, 'Teostra', 9, 5, 'Un dragon ancien enflammé, Teostra enflamme l’air autour de lui, créant une zone dangereuse.', 'MHW-Teostra_Icon.webp'),
(8, 'Kushala Daora', 9, 5, 'Dragon ancien recouvert de métal, manipulant les vents avec une force dévastatrice.', 'MHW-Kushala_Daora_Icon.webp'),
(9, 'Deviljho', 6, 4, 'Un prédateur affamé et instable. Attaque tout ce qui bouge, y compris d’autres monstres.', 'MHN-Deviljho.webp'),
(10, 'Velkhana', 9, 6, 'Dragon ancien de glace, Velkhana gèle tout sur son passage avec une grâce mortelle.', 'MHWI-Velkhana_Icon.webp');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
	`Id_utilisateur` int(11) NOT NULL,
	`Pseudo` varchar(50) NOT NULL,
	`Email` varchar(100) NOT NULL,
	`Pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Id_utilisateur`, `Pseudo`, `Email`, `Pwd`) VALUES
(2, 'test', '1@1.1', '$2y$10$jcXaU3Hqz/9hz/POzWxxkuhTUh6Nssal1Ot7kg9vnEdaATTlGpZiu');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `armes_armures`
--
ALTER TABLE `armes_armures`
	ADD PRIMARY KEY (`ID_Arme_Armure`),
	ADD KEY `ID_Monstre` (`ID_Monstre`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
	ADD PRIMARY KEY (`ID_Comm`),
	ADD KEY `ID_Monstre` (`ID_Monstre`),
	ADD KEY `Id_utilisateur` (`Id_utilisateur`);

--
-- Index pour la table `lieux_vie`
--
ALTER TABLE `lieux_vie`
	ADD PRIMARY KEY (`ID_Lieu_vie`);

--
-- Index pour la table `monstres`
--
ALTER TABLE `monstres`
	ADD PRIMARY KEY (`ID_Monstre`),
	ADD KEY `ID_Lieu_vie` (`ID_Lieu_vie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
	ADD PRIMARY KEY (`Id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `armes_armures`
--
ALTER TABLE `armes_armures`
	MODIFY `ID_Arme_Armure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
	MODIFY `ID_Comm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `lieux_vie`
--
ALTER TABLE `lieux_vie`
	MODIFY `ID_Lieu_vie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `monstres`
--
ALTER TABLE `monstres`
	MODIFY `ID_Monstre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
	MODIFY `Id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `armes_armures`
--
ALTER TABLE `armes_armures`
	ADD CONSTRAINT `armes_armures_ibfk_1` FOREIGN KEY (`ID_Monstre`) REFERENCES `monstres` (`ID_Monstre`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
	ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`ID_Monstre`) REFERENCES `monstres` (`ID_Monstre`),
	ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`Id_utilisateur`) REFERENCES `utilisateur` (`Id_utilisateur`);

--
-- Contraintes pour la table `monstres`
--
ALTER TABLE `monstres`
	ADD CONSTRAINT `monstres_ibfk_1` FOREIGN KEY (`ID_Lieu_vie`) REFERENCES `lieux_vie` (`ID_Lieu_vie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
