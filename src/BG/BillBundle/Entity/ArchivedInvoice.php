<?php

namespace BG\BillBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivedInvoice
 *
 * @ORM\Entity(repositoryClass="BG\BillBundle\Repository\ArchivedInvoiceRepository")
 */
class ArchivedInvoice
{

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var int
   *
   * @ORM\Column(name="ref", type="integer")
   */
  private $ref;

  /**
   * @var string
   *
   * @ORM\Column(name="name", type="string", length=255)
   */
  private $name;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="creation_date", type="datetime")
   */
  private $creationDate;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="payement_date", type="datetime")
   */
  private $payementDate;

  /**
   * @var float
   *
   * @ORM\Column(name="eng_rate", type="float")
   */
  private $engRate;

  /**
   * @var float
   *
   * @ORM\Column(name="draw_rate", type="float")
   */
  private $drawRate;

  /**
   * @var float
   *
   * @ORM\Column(name="vat", type="float")
   */
  private $vat;

  /**
   * @var Status
   *
   * @ORM\OneToOne(targetEntity="BG\CoreBundle\Entity\Status" , cascade={"persist", "remove"})
   * @ORM\JoinColumn(name="status", referencedColumnName="id", onDelete="CASCADE")
   */
  private $status;

  /**
   * @var Customer
   *
   * @ORM\ManyToOne(targetEntity="BG\CoreBundle\Entity\Customer" , cascade={"persist", "remove"})
   */
  private $customer;

  /**
   * @var Service
   *
   * @ORM\ManyToMany(targetEntity="BG\CoreBundle\Entity\Service", cascade={"persist", "remove"})
   */
  private $services;

  /**
   * Constructor
   */
  public function __construct(Invoice $invoice)
  {
    $this->ref = $invoice->getRef();
    $this->name = $invoice->getName();
    $this->creationDate = $invoice->getCreationDate();
    $this->payementDate = $invoice->getPayementDate();
    $this->engRate = $invoice->getEngRate();
    $this->drawRate = $invoice->getDrawRate();
    $this->vat = $invoice->getVat();
    $this->status = $invoice->getStatus();
    $this->customer = $invoice->getCustomer();
    $this->services = $invoice->getServices();
  }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ref.
     *
     * @param int $ref
     *
     * @return ArchivedInvoice
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref.
     *
     * @return int
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return ArchivedInvoice
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set creation date.
     *
     * @param \DateTime $creationDate
     *
     * @return ArchivedInvoice
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creation date.
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set payement date.
     *
     * @param \DateTime $payementDate
     *
     * @return ArchivedInvoice
     */
    public function setPayementDate($payementDate)
    {
        $this->payementDate = $payementDate;

        return $this;
    }

    /**
     * Get payement date.
     *
     * @return \DateTime
     */
    public function getPayementDate()
    {
        return $this->payementDate;
    }

    /**
     * Set engRate.
     *
     * @param float $engRate
     *
     * @return ArchivedInvoice
     */
    public function setEngRate($engRate)
    {
        $this->engRate = $engRate;

        return $this;
    }

    /**
     * Get engRate.
     *
     * @return float
     */
    public function getEngRate()
    {
        return $this->engRate;
    }

    /**
     * Set drawRate.
     *
     * @param float $drawRate
     *
     * @return ArchivedInvoice
     */
    public function setDrawRate($drawRate)
    {
        $this->drawRate = $drawRate;

        return $this;
    }

    /**
     * Get drawRate.
     *
     * @return float
     */
    public function getDrawRate()
    {
        return $this->drawRate;
    }

    /**
     * Set vat.
     *
     * @param float $vat
     *
     * @return ArchivedInvoice
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat.
     *
     * @return float
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set status.
     *
     * @param \BG\CoreBundle\Entity\Status|null $status
     *
     * @return ArchivedInvoice
     */
    public function setStatus(\BG\CoreBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return \BG\CoreBundle\Entity\Status|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set customer.
     *
     * @param \BG\CoreBundle\Entity\Customer|null $customer
     *
     * @return ArchivedInvoice
     */
    public function setCustomer(\BG\CoreBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer.
     *
     * @return \BG\CoreBundle\Entity\Customer|null
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Add service.
     *
     * @param \BG\CoreBundle\Entity\Service $service
     *
     * @return ArchivedInvoice
     */
    public function addService(\BG\CoreBundle\Entity\Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service.
     *
     * @param \BG\CoreBundle\Entity\Service $service
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeService(\BG\CoreBundle\Entity\Service $service)
    {
        return $this->services->removeElement($service);
    }

    /**
     * Get services.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }

    public function getTotalEt() {
      $sum = 0;
      foreach($this->getServices() as $service)
        $sum += $service->getBilled();
      return $sum;
    }
}
