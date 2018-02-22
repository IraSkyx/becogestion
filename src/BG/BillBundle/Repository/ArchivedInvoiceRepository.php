<?php

namespace BG\BillBundle\Repository;

/**
 * ArchivedInvoiceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArchivedInvoiceRepository extends \Doctrine\ORM\EntityRepository
{
  public function findAllByStatus(array $status)
  {
    $query = $this->_em->createQuery('SELECT q FROM BGBillBundle:ArchivedInvoice q, BGCoreBundle:Status s WHERE q.status = s.id AND s.message IN (:status)');
    $query->setParameter('status', $status);
    return $query->getResult();
  }
}
