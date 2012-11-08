<?php

namespace Zorbus\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Zorbus\PageBundle\Entity\Page;
use Zorbus\BlockBundle\Entity\Block;

class BlockController extends Controller
{

    public function pollAction(Block $block, Page $page, Request $request)
    {
        $parameters = json_decode($block->getParameters());
        $url = $parameters->url;
        $poll_id = $parameters->poll_id;

        if ($request->isMethod('post') && $request->query->has('poll'))
        {
            $option = $this->getDoctrine()->getRepository('ZorbusPollBundle:Option')->findOneBy(array('id' => $request->request->get('poll_option')));

            if (!$option)
            {
                return new Response('Invalid poll.');
            }
            else
            {
                $em = $this->getDoctrine()->getManager();
                $poll = $option->getPoll();
                $poll->setVotes($poll->getVotes()+1);
                $option->setVotes($option->getVotes()+1);
                $em->persist($poll);
                $em->persist($option);
                $em->flush();

                $page->setRedirect($url . '?poll=' . $poll->getToken());

                return new Response('Redirecting');
            }
        }

        if ($request->query->get('poll', false))
        {
            $poll = $this->getDoctrine()->getRepository('ZorbusPollBundle:Poll')->findOneBy(array('token' => $request->query->get('poll')));

            if (!$poll)
            {
                return new Response('Invalid poll.');
            }
            else
            {
                return $this->render('ZorbusPollBundle:Block:pollResult.html.twig', array(
                            'block' => $block, 'poll' => $poll, 'options' => $poll->getOptions()
                        ));
            }
        }
        else
        {
            $poll = $this->getDoctrine()->getEntityManager()->getRepository('ZorbusPollBundle:Poll')->find($poll_id);

            return $this->render('ZorbusPollBundle:Block:poll.html.twig', array(
                        'block' => $block, 'url' => $url, 'poll' => $poll
                    ));
        }
    }

}
