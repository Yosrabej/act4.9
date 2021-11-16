# act4.9
Activité 4.9.1 : e0:Sur la route, toute la sainte journée
Dossier de rendu	ex00/
Fichiers à rendre	Tous les fichiers de l’application.
Description	
Créez une entité représentant un article de presse (titre, contenu, auteur, date de publication).

En utilisant l’annotation @Route, réalisez un route /articles pour récupérer tous les articles dans une JsonResponse.

Codez aussi une route /article/{id} pour récupérer l’article {id}. Si l’article avec l’ID demandé n’existe pas, la réponse aura un code 404.


Activité 4.9.2 : Exercice 01 : Get out the way
Dossier de rendu	ex01/
Fichiers à rendre	Tous les fichiers de l’application.
Description	Après avoir installé FOSRestBundle, recodez les routes précédemment créées avec l’annotation @Get au lieu de @Route.
Activité 4.9.3 : Exercice 02 : Washington post
Dossier de rendu	ex02/
Fichiers à rendre	Tous les fichiers de l’application.
Description	
Créez une route /article qui insèrera un nouvel article conforme à celui passé via le body de la requête en base. La route sera accessible via POST.


Activité 4.9.4 : Exercice 03 : Put your hands up
Dossier de rendu	ex03/
Fichiers à rendre	Tous les fichiers de l’application.
Remarques	Intéressez-vous à la différence entre $em->persist() et $em->merge().
Description	Créez une route /article qui insèrera ou modifiera un article conforme à celui passé via le body de la requête en base. La route sera accessible via PUT.
Activité 4.9.5 : Exercice 04 : Get back
Dossier de rendu	ex04/
Fichiers à rendre	Tous les fichiers de l’application.
Description	Créez une route /article qui récupèrera les 3 derniers articles. La route sera accessible via GET.
Activité 4.9.6 : Exercice 05 : Are you sure ?
Dossier de rendu	ex05/
Fichiers à rendre	Tous les fichiers de l’application.
Description	Créez une route /article/{id} qui supprimera l’article ID. La route sera accessible via DELETE.
Activité 4.9.7 : Exercice 06 : Le blog
Dossier de rendu	ex06/
Fichiers à rendre	Tous les fichiers de l’application.
Description	Modifiez votre projet d’hier afin d’utiliser l’API que vous venez de créer !
