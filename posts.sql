-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 03 Février 2018 à 17:34
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `p5`
--

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author_first_name` varchar(25) NOT NULL,
  `author_last_name` varchar(40) NOT NULL,
  `title` varchar(50) NOT NULL,
  `intro` text NOT NULL,
  `content` text NOT NULL,
  `last_update_date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `author_first_name`, `author_last_name`, `title`, `intro`, `content`, `last_update_date`) VALUES
(1, 'Eric', 'Codron', 'Démarrage du blog !', 'Je pose aujourd\'hui la première pierre de ce qui sera mon lien régulier entre vous et moi, et puisqu\'il faut commencer par le commencement, je me présente...', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\r\n\r\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2017-11-27 09:27:45'),
(2, 'Eric', 'Codron', 'De l\'intérêt de la POO', 'Pour celles et ceux qui douteraient encore des avantages de la programmation orientée objet, voici un rapide tour d\'horizon.', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', '2017-11-28 18:51:27'),
(3, 'Eric', 'Codron', 'Twig, un moteur de template moderne', '<p>Twig est le moteur de template PHP utilisé par Symfony mais il est tout à fait possible de l\'utiliser en dehors du Framework pour l\'intégrer dans son propre code (avec ou <strong>sans framework</strong>).</p>', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>', '2018-01-14 20:05:48'),
(4, 'Eric', 'Codron', 'MySQL ou MariaDB ?', '<p>MySQL, le plus populaire des gestionnaires de bases de données relationnelles est installé sur des millions de serveurs. Cela inclut Youtube, Flickr, Yahoo!, Facebook (à coté de Hadoop), <strong>Twitter</strong>.</p>', '<p>MySQL s\'utilise aussi bien pour de très grands sites que pour de petites bases de données. Le site Tumblr supporte 60 milliards de lignes sous MySQL ce qui requiert 200 serveurs dédiés concurrents et un outil special, Jetpants, mais on peut l\'utiliser pour une simple table avec deux colonnes. MySQL, le destin de Delphes?</p>\r\n<p>MySQL est créé en 1995 par David Axmark, Allan Larsson et Michael Widenius qui fondent la société MySQL AB pour le commercialiser. En juin 2000 il passe sous licence GPL mais il conserve une double licence, on peut choisir une licence payante, notamment pour l\'intégrer à d\'autres logiciels incompatible avec GPL. La société est acquise par Sun le 26 février 2008.Quand elle-même est acquise par Oracle le 20 avril 2009, MySQL a un nouveau propriétaire (et des utilisateurs inquiets, voir plus loin).</p>\r\n<p>La popularité de MySQL décline depuis 2012, car le logiciel tend à être remplacé par MariaDB (du même auteur), plus performant et avec des mainteneurs plus réactifs. Le créateur a donné au logiciel le nom de sa seconde fille, Maria, tandis que MySQL vient de My qui est celui de la première (cela est la source d\'une confusion qui a fait que de nombreux produits ont voulu imiter MySQL en se donnant le préfix My, qui signifie "mien", en anglais). En mai 2017, la Commission Européenne a débloqué 25 millions d\'euro pour le développement et la promotion de MariaDB. Cela lui permettra d\'agrandir son équipe et accélérer son développement.</p>', '2017-12-30 20:49:59'),
(38, 'Eric', 'Codron', 'Une première "issue" clôturée :)', '<p>Suite au <em>merge</em> d\'une branche créée spécifiquement, la gestion des paramètres de connexion à la base de données a été améliorée.</p>', '<p>Suite à la création de la "issue" Git ayant pour titre <strong>"DB connection parameters must be stored in a dedicated config file"</strong>, la branche de développement "db-params" a été spécialement créée.</p>\r\n<p>Les paramètres de connexion à la base de données sont maintenant stockées dans un fichier de configuration exclus du dépôt Git.</p>', '2018-02-03 17:14:00'),
(39, 'Eric', 'Codron', 'Création de la page de visualisation d\'un billet', '<p>L\'incontournable fonctionnalité de visualisation d\'un billet est enfin disponible !</p>', '<p>La base de tout blog est bien évidemment la possibilité de <strong>lire un billet</strong>.</p>\r\n<p>C\'est maintenant chose possible sur ce blog avec la création de page correspondante :)</p>\r\n<p>Alors usez-en et abusez-en, car cette fonctionnalité est là pour vous !</p>', '2018-02-03 17:22:46'),
(40, 'Eric', 'Codron', 'Une page d\'accueil toute neuve !', '<p>Ca y est ! Elle est enfin là !<br />Notre page d\'accueil a été relookée et a été agrémenté de quelques nouveauvés...</p>', '<p>Vous qui êtes des habitués de ce blog, vous avez tout de suite remarqué quelques changements cosmétiques sur la page d\'accueil.</p>\r\n<p>Mais nous vous invtions à essayer sans plus attendre les nouvelles fonctionnalités :</p>\r\n<p style="padding-left:30px;">Le lien permettant de <strong>télécharger mon CV</strong></p>\r\n<p style="padding-left:30px;">Le <strong>formulaire de contact</strong> qui sera notre lien entre vous et moi</p>', '2018-02-03 17:27:52');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
