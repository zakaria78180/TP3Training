<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $userPassword;

    public function getGroups(): array
    {
        return ['main'];
    }

    public function __construct(UserPasswordHasherInterface $userPasswordHasher) {
        $this->userPassword= $userPasswordHasher;

    }

    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");
        $genres=["men","women"];    
        for ($i=0; $i < 20; $i++){ 
            $sexe=mt_rand(0,1);
            if ($sexe==0){
                $type ="men";
            }else {
                $type="women" ;  
            }  
           
            $user= new User();
            $user    ->setNom($faker->lastname())
                        ->setPrenom($faker->firstname())
                        ->setEmail($faker->email())
                        ->setSexe($sexe)
                        ->setAvatar('https://randomuser.me/api/portraits/'.$faker->randomElement($genres)."/".mt_rand(1,99).".jpg")     
                        ->setPassword( $this->userPassword->hashPassword( 
                            $user,
                            "test3421"  
                        ))
                        ;
            $manager->persist($user);

        }
        $admin= new User();
        $admin    ->setNom("admin")
                    ->setPrenom("idriss")
                    ->setEmail("admin@gmail.com")
                    ->setSexe(1)
                    ->setRoles(['ROLE_ADMIN'])
                    ->setAvatar('https://randomuser.me/api/portraits/women/2.jpg')     
                    ->setPassword( $this->userPassword->hashPassword( 
                        $admin,
                        "testadmin"  
                    ))
                    ;
        $manager->persist($admin);
        $manager->flush();
    }
}
