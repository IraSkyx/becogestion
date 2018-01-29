<?php

namespace BG\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BG\CoreBundle\Entity\Quote;
use BG\CoreBundle\Entity\Customer;
use BG\CoreBundle\Entity\Advancement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use BG\CoreBundle\Form\AdvancementType;

class CoreController extends Controller
{
  public function homeAction()
  {
    return $this->render('@BGCore/Core/home.html.twig', array(
      "quotes" => $this->getDoctrine()->getManager()->getRepository('BGCoreBundle:Quote')->findAllByStatus(array("En attente", "En cours"))
    ));
  }

  public function archivesAction()
  {
    return $this->render('@BGCore/Core/home.html.twig', array(
      'quotes' => $this->getDoctrine()->getManager()->getRepository('BGCoreBundle:Quote')->findAllByStatus(array("Terminé", "Annulé"))
    ));
  }

  public function billStackAction()
  {
    return $this->render('@BGCore/Core/billstack.html.twig', array(
      'bills' => $this->getDoctrine()->getManager()->getRepository('BGCoreBundle:StackedBill')->findAll()
    ));
  }

  public function newQuoteAction()
  {
    return $this->render('@BGCore/Core/newQuote.html.twig');
  }

  public function customersAction()
  {
    return $this->render('@BGCore/Core/customers.html.twig', array(
      'customers' => array()
    ));
  }

  public function plansAction()
  {
    return $this->render('@BGCore/Core/plans.html.twig', array(
      'plans' => array()
    ));
  }

  public function settingsAction()
  {
    return $this->render('@BGCore/Core/settings.html.twig', array(
      'settings' => array()
    ));
  }

  public function addStateAction(int $id, int $sid)
  {
    $adv = new Advancement();
    $this->getDoctrine()->getManager()->getRepository('BGCoreBundle:Service')->find($sid)->addState(
      $adv->setValue($this->getDoctrine()->getManager()->getRepository('BGCoreBundle:Service')->findMaxAdvancement($sid)->getValue())
    );
    $this->getDoctrine()->getManager()->flush();
    return $this->redirectToRoute('BG_CoreBundle_service', array('id' => $id, 'sid' => $sid));
  }

  public function removeStateAction(int $id, int $sid, int $aid)
  {
    $this->getDoctrine()->getManager()->getRepository('BGCoreBundle:Service')->find($sid)->removeState(
      $this->getDoctrine()->getManager()->getRepository('BGCoreBundle:Advancement')->find($aid)
    );
    $this->getDoctrine()->getManager()->flush();
    return $this->redirectToRoute('BG_CoreBundle_service', array('id' => $id, 'sid' => $sid));
  }

  public function viewAction(int $id)
  {
    return $this->render('@BGCore/Core/view.html.twig', array(
      'quote' => $this->getDoctrine()->getManager()->getRepository('BGCoreBundle:Quote')->find($id)
    ));
  }

  public function serviceAction(int $id, int $sid, Request $request)
  {
    $max = $this->getDoctrine()->getManager()->getRepository('BGCoreBundle:Service')->findMaxAdvancement($sid);

    $form = $this->get('form.factory')->create(AdvancementType::class, $max);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($max);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Avancement bien enregistrée.');

      return $this->redirectToRoute('BG_CoreBundle_service', array('id' => $id, 'sid' => $sid));
    }

    return $this->render('BGCoreBundle:Core:service.html.twig', array(
      'form' => $form->createView(),
      'id' => $id,
      'max' => $max,
      'service' => $this->getDoctrine()->getManager()->getRepository('BGCoreBundle:Service')->find($sid)
    ));
  }

  public function changeStatusAction(int $id, string $status)
  {
    $this->getDoctrine()->getManager()->getRepository('BGCoreBundle:Quote')->changeStatus($id, $status);
    return $this->redirectToRoute('BG_CoreBundle_view', array('id' => $id));
  }
}