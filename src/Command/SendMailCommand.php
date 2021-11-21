<?php

namespace App\Command;

use App\Entity\News;
use App\Entity\Subscriber;
use DateTime;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Twig\Environment;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\TwigBundle\TwigBundle;

#[AsCommand(
    name: 'send:mail',
    description: 'Add a short description for your command',
)]
class SendMailCommand extends Command
{
    private $mailer;
    private $entityManagerInterface;
    private $twig;
    public function __construct(string $name = null, MailerInterface $mailer, EntityManagerInterface $entityManagerInterface,Environment $twig)
    {
        $this->mailer = $mailer;
        parent::__construct($name);
        $this->entityManagerInterface = $entityManagerInterface;
        $this->twig = $twig;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $date = new DateTime('now');
        $d = $date->modify('-7 Day');
        $news = $this->entityManagerInterface->getRepository(News::class)->getLastWeekNews($d);
        $subs = $this->entityManagerInterface->getRepository(Subscriber::class)->findAll();
        $tmpl = $this->twig->render('news.html.twig',['news'=>$news]);


        foreach($subs as $sub){
            $users[]=$sub->getEmail();
        }
        $email = (new TemplatedEmail())
            ->from('hello@example.com')
            ->addBcc(...$users)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html($tmpl);

        $this->mailer->send($email);
        return Command::SUCCESS;
    }
}
