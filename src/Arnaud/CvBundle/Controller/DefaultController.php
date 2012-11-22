<?php

namespace Arnaud\CvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Arnaud\CvBundle\Entity\Job;
use Arnaud\CvBundle\Entity\Company;
use Arnaud\CvBundle\Entity\Task;

use Arnaud\CvBundle\Form\CompanyType;
use Arnaud\CvBundle\Form\JobType;

use JMS\SecurityExtraBundle\Annotation\Secure;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        return $this->render('ArnaudCvBundle:Cv:index.html.twig', array('name' => $name));

        $repository=$this->getDoctrine()->getEntityManager()->getRepository('ArnaudCvBundle:Job');

        $jobs=$repository->findAllOrdered();

        //var_dump($jobs);


        return $this->render('ArnaudCvBundle:Cv:index.html.twig', array('jobs'=>$jobs));
    }


    /**
     * @Secure(roles="ROLE_ADMIN")
     */    
    public function addJobAction()
    {

        $job=new Job();
        $form=$this->createForm(new JobType, $job);

        $request = $this->get('request');
        // if request method is POST 
        if( $request->getMethod() == 'POST' )
        {
            $form->bindRequest($request);

            // if data supplied are valid
            if( $form->isValid() )
            {
                // save datas in database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($job);
                $em->flush();

                // redirect to cv index page
                return $this->redirect($this->generateUrl('arnaud_cv_index'));
            }
        }

        // if request method is 'GET' or 'POST' but with invalid datas, display the form
        return $this->render('ArnaudCvBundle:Cv:form.html.twig', array('form'=>$form->createView()
                                                                )
        );

    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */    
    public function updateJobAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $job=$em->getRepository('ArnaudCvBundle:Job')
                ->find($id); 
       

        $form=$this->createForm(new JobType, $job);


        $originalTasks = array();

        // Create an array of the current Tag objects in the database
        foreach ($job->getTasks() as $task) 
            $originalTasks[] = $task;

        $request = $this->get('request');
        // if request method is POST 
        if( $request->getMethod() == 'POST' )
        {
            $form->bindRequest($request);

            // if data supplied are valid
            if( $form->isValid() )
            {
                $job=$form->getData();
                // filter $originalTags to contain tags no longer present
                foreach ($job->getTasks() as $task) {
                    foreach ($originalTasks as $key => $toDel) {
                        if ($toDel->getId() === $task->getId()) {
                            unset($originalTasks[$key]);
                        }
                    }
                }

                // remove the relationship between the tag and the Task
                foreach ($originalTasks as $task) {
                    $em->remove($task); 
                }

                // save datas in database
                $em->persist($job);
                $em->flush();

                // redirect to cv index page
                return $this->redirect($this->generateUrl('arnaud_cv_index'));
            }
        }

        // if request method is 'GET' or 'POST' but with invalid datas, display the form
        return $this->render('ArnaudCvBundle:Cv:form.html.twig', array('form'=>$form->createView()));

    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */    
    public function deleteJobAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $job=$em->getRepository('ArnaudCvBundle:Job')
                ->find($id); 
       
        // delete job
        $em->remove($job);
        $em->flush();

        // redirect to cv index page
        return $this->redirect($this->generateUrl('arnaud_cv_index'));
                        

    }
}
