# projet_sortir

Pour qu'il y ait moins de soucis lors des pull/push, nous allons utiliser les branches, ça ne complique pas grand chose et 
ça évitera d'écraser le travail des autres et les conflits.

Réunion d'équipe tous les matins : définition des tâches et du temps estimé pour chacun.

Pour le mardi 19, je propose :
  - faire à 100% les 3 premiers points de l'itération 1, soit la gestion des utilisateurs.
  - Manu termine le côté database avec la création des entities (sans oublier les relations !)
  - Hervé, création du formulaire d'enregistrement (registration) :
  
                      AuthenticationGuardClass
                1. Create the User security entity then add more fields
                bin/console make:user
                bin/console make:entity
                2. Play migrations
                bin/console d:d:c
                bin/console make:migration
                bin/console d:m:m
                3. Create AuthenticatorClass, SecurityController and the login form
                bin/console make:auth
                4. Create registration form
                bin/console make:registration-form

  - Mise en place des faker pour tester la bdd (tout ets déjà installé, y a plus qu'a faire les fonctions) :
  
                1. create fixtures
                bin/console make:fixtures
                2. template code
                in the new fixtures file :

                class UserFixtures extends Fixture
                {
                    public function load(ObjectManager $manager)
                    {

                        // creation du faker
                        $faker = \Faker\Factory::create('fr_FR');

                        // on boucle pour hydrater des User a partir du faker
                        for ($i = 0; $i < 50; $i++)
                        {
                            $user = new User();
                            $user->setName($faker->firstName);
                            $user->setLastname($faker->lastName);
                            $user->setAdress($faker->address);
                            $manager->persist($user);
                        }
                        $manager->flush();
                    }
                }
                3. create fake datas and save them
                bin/console doctrine:fixtures:load
                
  - Loïc, gestion de la partie admin avec Sonata + démo aux team mates      
