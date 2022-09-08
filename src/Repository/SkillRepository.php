<?php

namespace App\Repository;

use App\Entity\Skill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Skill>
 *
 * @method Skill|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skill|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skill[]    findAll()
 * @method Skill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skill::class);
    }

    public function add(Skill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Skill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getBaseSkill() {
        return $this->createQueryBuilder('s')
            ->where('s.isBase = true')
            ->andWhere('s.isPassive = false')
            ->getQuery()->execute();
    }

    public function getOtherSkill() {
        return $this->createQueryBuilder('s')
            ->where('s.isBase = false')
            ->andWhere('s.isPassive = false')
            ->getQuery()->execute();
    }

    public function getPassiveSkill() {
        return $this->createQueryBuilder('s')
            ->andWhere('s.isPassive = true')
            ->getQuery()->execute();
    }

    public function getSkillTable(): array
    {
        $baseSkills = $this->getBaseSkill();
        $otherSkills = $this->getOtherSkill();

        $table = [];
        foreach ($baseSkills as $skill) {
            $table[$skill->getName()] = [];
        }
        foreach ($otherSkills as $skill) {
            $table[$skill->getParent()->getName()][] = $skill;
        }

        return $table;
    }

//    /**
//     * @return Skill[] Returns an array of Skill objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Skill
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
