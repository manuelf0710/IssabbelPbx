��    5      �  G   l      �  �  �       
   !     ,     >     P     _     o  7   �     �  	   �     �     W     p     �  $   �  '   �     �     �     �  .   �     +  
   1     <     K     Z  
   _     j     ~  &   �  	   �  0   �     �  -   �     	  o   	  �   �	     
  1   
  �  N
     �     �            :   #     ^     m  &   v  	   �     �     �     �  I  �  �    &   �          2     P     k  "   �     �  >   �     �       �   -  (   �     �     �  )     =   :     x     }     �  8   �     �     �     �                     .     F  8   I     �  9   �     �  ;   �       �     �   �  
   9  3   D  !  x     �     �     �     �  `   �     B     ^  <   g     �  	   �     �  	   �     0                        %   4   ,            )   +               '         *   "         !                    5      &              3       2                           1   
   	      /   (              #      .         -                           $    A Lookup Source let you specify a source for resolving numeric CallerIDs of incoming calls, you can then link an Inbound route to a specific CID source. This way you will have more detailed CDR reports with information taken directly from your CRM. You can also install the phonebook module to have a small number <-> name association. Pay attention, name lookup may slow down your PBX Add CID Lookup Source Add Source CID Lookup Source CID Lookup source Cache results: CallerID Lookup CallerID Lookup Sources Checking for cidlookup field in core's incoming table.. Database name Database: Decide whether or not cache the results to astDB; it will overwrite present values. It does not affect Internal source behavior Delete CID Lookup source ERROR: failed:  Edit Source Enter a description for this source. FATAL: failed to transform old routes:  HTTP Host name or IP address Host: Migrating channel routing to Zap DID routing.. MySQL MySQL Host MySQL Password MySQL Username None Not Needed Not yet implemented OK Password to use in HTTP authentication Password: Path of the file to GET<br/>e.g.: /cidlookup.php Path: Port HTTP server is listening at (default 80) Port: Query string, special token '[NUMBER]' will be replaced with caller number<br/>e.g.: number=[NUMBER]&source=crm Query, special token '[NUMBER]' will be replaced with caller number<br/>e.g.: SELECT name FROM phonebook WHERE number LIKE '%[NUMBER]%' Query: Removing deprecated channel field from incoming.. Select the source type, you can choose between:<ul><li>Internal: use astdb as lookup source, use phonebook module to populate it</li><li>ENUM: Use DNS to lookup caller names, it uses ENUM lookup zones as configured in enum.conf</li><li>HTTP: It executes an HTTP GET passing the caller number as argument to retrieve the correct name</li><li>MySQL: It queries a MySQL database to retrieve caller name</li></ul> Source Source Description: Source type: Source: %s (id %s) Sources can be added in Caller Name Lookup Sources section Submit Changes SugarCRM Username to use in HTTP authentication Username: deleted not present removed Project-Id-Version: PACKAGE VERSION
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2011-09-23 09:52+0000
PO-Revision-Date: 2011-04-14 00:00+0100
Last-Translator: Séverine GUTIERREZ <severine@medialsace.fr>
Language-Team: Français <LL@li.org>
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
 Une Source de Consultation vous permet de spécifier une source pour résoudre les IDs numériques des appelants parmi les appels entrants. Vous pouvez ensuite lier une route entrante a une source CID spécifique. De cette façon vous aurez des rapports CDR plus détaillés avec des informations prises directement de votre CRM. Vous pouvez également installer le module d'annuaire pour avoir une association numéro court <-> nom. Attention, la consultation de nom peu ralentir votre PBX Ajouter une Source de Consultation CID Ajouter une Source Source de Consultation de CID Source de Consultation CID Résulats du Cache : Consultation de l'ID de l'appelant Sources Consult. ID Appelant Contôle du champ cidlookup dans la table entrants du coeur... Nom de la Base de Données Base de Données : Décide de mettre en cache ou non les résultats dans astDB; cela écrasera les valeurs actuelles. N'affectera pas le comportement de source Interne Supprimer une Source de Consultation CID ERREUR : échoué : Editer la Source Entrez une description pour cette source. FATAL : n'a pas réussi à transformer les anciennes routes : HTTP Nom de l'hôte ou adresse IP Hôte : Migration du routage de canal vers le routage Zap DID... MySQL Hôte MySQL Mot de Passe MySQL Nom d'utilisateur MySQL Aucun Pas Nécessaire Pas encore implémenté OK Mot de Passe à utiliser lors de l'authentification HTTP Mot de Passe : Chemin du fichier à OBTENIR<br/>exemple : /cidlookup.php Chemin : Le port HTTP du serveur est en écoute sur (80 par défaut) Port : Chaîne de Requête, le signe spécial '[NUMBER]' sera remplacé par le numéro de l'appelant<br/>exemple : numéro=[NUMBER]&source=crm Requête, le signe spécial '[NUMBER]' sera remplacé par le numéro de l'appelant<br/>exemple : SELECT nom FROM annuaire WHERE numéro LIKE '%[NUMBER]%' Requête : Suppression du champ canal obsolète de entrants... Sélectionnez le type de source. Vous pouvez choisir entre : <ul><li>Interne : utiliser astdb comme source de consultation, utiliser le module d'annuaire pour la peupler</li><li>ENUM : Utiliser le DNS pour consulter les noms des appelants. Utilise les zones de consultation ENUM tel que configurées dans la configuration enum.</li><li>HTTP : Exécute un HTTP GET en passant le numéro de l'appelant comme argument  pour récupérer le nom exact</li><li>MySQL : Requiert une Base de Données MySQL pour récupérer le nom de l'appelant</li></ul> Source Description de la Source : Type de Source :  Source: %s (id %s) Les sources peuvent être ajoutées dans la section Sources de Consultation du Nom de l'Appelant Appliquer les Modifications SugarCRM Nom d'utlisateur à utiliser lors de l'authentification HTTP Nom d'utilisateur : supprimé pas présent éliminé 