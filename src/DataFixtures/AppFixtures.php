<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Auteur;
use App\Entity\Post;
use App\Entity\Commentaire;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
      // Création des auteurs.generation des données
        $listAuthor = [];
        for ($i = 0; $i < 10; $i++) {
            // Création de l'auteur lui-même.
            $author = new Auteur();
            $author->setNom("Prénom " . $i);
            $author->setPrenom("Nom " . $i);
            $author->setEmail("Nom " . $i);
            $manager->persist($author);

            // On sauvegarde l'auteur créé dans un tableau.
            $listAuthor[] = $author;
        }
        $listPost = [];
      // Création des postes.generation des données
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setTitle("post " . $i);
            $post->setContent("Contenu du poste " . $i);
            $id_auteur=$listAuthor[array_rand($listAuthor)];
            $post->setAuthor($id_auteur);
            $manager->persist($post);
            $listPost []=$post;
        }
        // Création des commentaires.generation des données
        for ($k = 0; $k < 5; $k++) {
            $comment = new Commentaire();
            $comment->setContent("Commentaire " . $k . " pour le post " . $k);
            $post=$listPost[array_rand($listPost)];
            $comment->setPost($post);
            $manager->persist($comment);
        }
        $manager->flush();
    }
}
